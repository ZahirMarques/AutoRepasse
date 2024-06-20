<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Venda;
use App\Models\Veiculo;
use App\Models\Pessoa;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $veiculos = Veiculo::all();
        $pessoas = Pessoa::all();

        return view('venda.create', [
            'veiculos' => $veiculos,
            'pessoas' => $pessoas,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $venda = new Venda();
        
        $venda->tipo = $request->input('tipo');
        
        if ($request->input('financiamento') == '') {
            $venda->financiamento = 'não';
        } else{
            $venda->financiamento = 'sim';
        }
        
        $venda->veiculo_id = $request->veiculos;
        $venda->pessoa_id = $request->pessoas;
        
        $venda->save();

        return redirect(url('/index'));
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venda = Veiculo::findOrFail($id);

        return view('venda.show', ['venda' => $venda]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
