<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->roles[0]->permiso_clientes == TRUE) {
            $clientes = DB::table('clientes')
                        ->where('nombre', 'LIKE', '%' . $request->input('name') . '%')
                        ->paginate(10);
            return view('clientes.index', ['clientes' => $clientes]);
        }
        return back()->with('warning', 'Esta intentando acceder a una sección a la cual no tienes permiso.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->roles[0]->permiso_clientes == TRUE) {
            return view('clientes.create');
        }
        return back()->with('warning', 'Esta intentando acceder a una sección a la cual no tienes permiso.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->roles[0]->permiso_clientes == TRUE) {
            try {
                DB::table('clientes')->insert([
                    'nombre'    => $request->get('nombre'),
                    'documento' => $request->get('documento'),
                    'correo'    => $request->get('correo'),
                    'direccion' => $request->get('direccion')
                ]);
                return redirect()->route('clientes.index')->with('succes', 'Cliente registrado con exito!');
            } catch (\Illuminate\Database\QueryException $ex) {
                return back()->with('warning', $ex);
            }
        }
        return back()->with('warning', 'Esta intentando acceder a una sección a la cual no tienes permiso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = DB::table('clientes')->find($id);
        return view('clientes.partials.form-delete', ['cliente' => $cliente]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->roles[0]->permiso_clientes == TRUE) {
            $cliente = DB::table('clientes')->find($id);
            return view('clientes.edit', ['cliente' => $cliente]);
        }
        return back()->with('warning', 'Esta intentando acceder a una sección a la cual no tienes permiso.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->roles[0]->permiso_clientes == TRUE) {
            try {
                $affected = DB::table('clientes')->where('id', $id)
                        ->update([
                            'nombre'    => $request->input('nombre'),
                            'documento' => $request->input('documento'),
                            'correo'    => $request->input('correo'),
                            'direccion' => $request->input('direccion')
                        ]);
                return redirect()->route('clientes.index')->with('succes', 'Cliente actualizado con exito!');
            } catch (Exception $ex) {
                return back()->with('warning', $ex);
            }
        }
        return back()->with('warning', 'Esta intentando acceder a una sección a la cual no tienes permiso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->roles[0]->permiso_clientes == TRUE) {
            try {
                $affected = DB::table('clientes')->where('id', '=', $id)->delete();
                return back()->with('succes', 'Registro eliminado con exito!');
            } catch (Exception $ex) {
                return back()->with('warning', $ex);
            }
        }
        return back()->with('warning', 'Esta intentando acceder a una sección a la cual no tienes permiso.');
    }
}
