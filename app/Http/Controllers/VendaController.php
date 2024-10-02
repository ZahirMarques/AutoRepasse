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
        // Criar a venda
        $venda = Venda::create([
            'financiamento' => $request->has('financiamento'), // Verifica se o checkbox foi marcado
            'tipo' => $request->tipo,
            'pessoa_id' => $request->pessoas,
            'veiculo_id' => $request->veiculos,
        ]);
    
        // Atualizar o proprietário do veículo
        $veiculo = Veiculo::findOrFail($request->veiculos);
        $veiculo->proprietario_id = $request->pessoas; // Supondo que existe a coluna `proprietario_id` na tabela `veiculos`
        $veiculo->save();
    
        return redirect('/dashboard')->with('success', 'Venda cadastrada e proprietário do veículo atualizado com sucesso!');
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
