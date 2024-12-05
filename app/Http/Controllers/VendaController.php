<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Venda;
use App\Models\Veiculo;
use App\Models\Cliente;
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
        $clientes = Cliente::all();

        return view('vendas.create', [
            'veiculos' => $veiculos,
            'clientes' => $clientes,
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
            'cliente_id' => 'required', // Garantir que o comprador foi enviado
            'veiculo_id' => 'required|unique:vendas,veiculo_id', // Garantir que o veículo não foi vendido antes
        ], [
            'veiculo_id.unique' => 'Este carro já foi vendido.',
            'cliente_id.required' => 'O comprador é obrigatório.',
        ]);
        // Criar a venda
        $venda = Venda::create([
            'financiamento' => $request->has('financiamento'), // Checkbox do financiamento
            'tipo' => $request->tipo,
            'cliente_id' => $request->cliente_id, // Campo correto
            'veiculo_id' => $request->veiculo_id, // Campo correto
        ]);

        

        $veiculo = Veiculo::findOrFail($request->veiculo_id);
        $veiculo->proprietario_id = $request->cliente_id; 
        $veiculo->situacao = 'Vendido';
        $veiculo->save();
        // Recuperar todas as vendas para exibir na dashboard
        $vendas = Venda::with(['cliente', 'veiculo'])->get();
       
        // Redirecionar para o dashboard e exibir a venda criada
        return redirect('/vendas/dashboard')->with([
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
        $venda = Venda::with(['veiculo','cliente'])->FindOrFail($id);

        return view('vendas.show', compact('venda'));
    }

    public function dashboard()
    {
        // Recuperar todas as vendas com os relacionamentos (cliente e veiculo)
        $vendas = Venda::with(['cliente', 'veiculo'])->get();
        
        // Recuperar todos os veículos
        $veiculos = Veiculo::where('situacao', 'À venda')->get();
        
        // Recuperar todos os clientes
        $clientes = Cliente::all();
    
        // Retornar a view do dashboard com as variáveis
        return view('auth.dashboard', compact('vendas', 'veiculos', 'clientes'));
    }

    public function vendasdashboard()
    {
        // Recuperar todas as vendas com os relacionamentos (cliente e veiculo)
        $vendas = Venda::with(['cliente', 'veiculo'])->get();
        
        // Recuperar todos os veículos
        $veiculos = Veiculo::all();
        
        // Recuperar todos os clientes
        $clientes = Cliente::all();
    
        // Retornar a view do dashboard com as variáveis
        return view('vendas.dashboard', compact('vendas', 'veiculos', 'clientes'));
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
        Venda::findOrFail($id)->delete();

        $venda = Venda::findOrFail($id);
        $veiculo = Veiculo::findOrFail($venda->veiculo_id);
        $veiculo->situacao = 'em estoque';
        $veiculo->save();
        $venda->delete();

        return redirect('/vendas/dashboard');
    }
}
