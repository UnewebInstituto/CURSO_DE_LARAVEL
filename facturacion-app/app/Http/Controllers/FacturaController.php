<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetalleFactura;
use App\Models\Factura;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $facturas = Factura::with('cliente')
            ->orderByDesc('fecha')
            ->paginate(15);

        return view('facturas.index', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $clientes = Cliente::orderBy('nombre')->get();

        $productos = Producto::where('stock', '>', 0)->orderBy('nombre')->get();

        return view('facturas.create', compact('clientes', 'productos'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($validated) {

            $factura = Factura::create([
                'numero' => 'FAC-' . str_pad((Factura::max('id') + 1), 5, '0', STR_PAD_LEFT),
                'cliente_id' => $validated['cliente_id'],
                'fecha' => $validated['fecha'],
                'total' => 0,
                'estado' => 'pendiente',
            ]);

            $total = 0;

            foreach ($validated['productos'] as $linea) {
                $producto = Producto::findOrFail($linea['producto_id']);
                $subtotal = $producto->precio * $linea['cantidad'];

                DetalleFactura::create([
                    'factura_id' => $factura->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $linea['cantidad'],
                    'precio_unitario' => $producto->precio,
                    'subtotal' => $subtotal,
                ]);

                $producto->decrement('stock', $linea['cantidad']);
                $total += $subtotal;
            }

            $factura->update(['total' => $total]);
        });

        return redirect()->route('facturas.index')
            ->with('success', 'Factura creada correctamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        //
        $factura->load('cliente', 'detalles.producto');

        return view('facturas.show', compact('factura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        //
        $clientes = Cliente::orderBy('nombre')->get();
        $productos = Producto::orderBy('nombre')->get();
        $factura->load('detalles.producto');

        return view('facturas.edit', compact('factura', 'clientes', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factura $factura)
    {
        //
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'estado' => 'required|in:pendiente,pagada,anulada',
        ]);

        $factura->update($validated);

        return redirect()->route('facturas.index')
            ->with('success', 'Factura actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        //
        DB::transaction(function () use ($factura) {
            foreach ($factura->detalles as $detalle) {
                $detalle->producto->increment('stock', $detalle->cantidad);
            }
            $factura->delete();
        });

        return redirect()->route('facturas.index')
            ->with('success', 'Factura eliminada correctamente.');
    }
}
