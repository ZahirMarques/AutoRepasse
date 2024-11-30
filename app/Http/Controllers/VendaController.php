<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Venda;
use App\Models\Veiculo;
use App\Models\Pessoa;
use Illuminate\Validation\Rule;

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
        $request->validate([
            'financiamento' => 'nullable',
            'tipo' => 'nullable',
            'pessoa_id' => 'required', // Garantir que o comprador foi enviado
            'veiculo_id' => 'required|unique:vendas,veiculo_id', // Garantir que o veículo não foi vendido antes
        ], [
            'veiculo_id.unique' => 'Este carro já foi vendido.',
            'pessoa_id.required' => 'O comprador é obrigatório.',
        ]);
        // Criar a venda
        $venda = Venda::create([
            'financiamento' => $request->has('financiamento'), // Checkbox do financiamento
            'tipo' => $request->tipo,
            'pessoa_id' => $request->pessoa_id, // Campo correto
            'veiculo_id' => $request->veiculo_id, // Campo correto
        ]);

        

        $veiculo = Veiculo::findOrFail($request->veiculo_id);
        $veiculo->proprietario_id = $request->pessoa_id; 
        $veiculo->save();
        // Recuperar todas as vendas para exibir na dashboard
        $vendas = Venda::with(['pessoa', 'veiculo'])->get();
       
        // Redirecionar para o dashboard e exibir a venda criada
        return redirect('venda/create')->with([
        'success' => 'Venda cadastrada e proprietário do veículo atualizado com sucesso!', // Passa a venda para a sessão
        'error' => 'O veículo já foi vendido! ',
        'vendas' => $vendas,
        // Passa todas as vendas para a view
        ]);
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

    public function dashboard()
    {
        // Carregar todas as vendas com os relacionamentos (veículo e comprador)
        $vendas = Venda::with(['pessoa', 'veiculo'])->get;

        return view('dashboard', compact('vendas'));
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
