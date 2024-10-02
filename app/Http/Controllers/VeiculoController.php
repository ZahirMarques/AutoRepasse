<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Pessoa;
class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('veiculos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // Validação com mensagens personalizadas
    $validatedData = $request->validate([
        'veiculo' => 'required|string|max:45',
        'ano_modelo' => 'required|string|max:8',
        'placa' => 'required|string|max:7|unique:veiculos',
        'renavam' => 'required|string|max:11|unique:veiculos',
        'cor' => 'required|string|max:15',
        'chassi' => 'required|string|max:20|unique:veiculos',
        'cod_seg_crv' => 'required|string|max:20|unique:veiculos',
        'cod_seg_cla' => 'required|string|max:20|unique:veiculos',
        'crv' => 'required|string|max:20|unique:veiculos',
        'atpve' => 'required|string|max:20|unique:veiculos',
    ], [
        'veiculo.required' => 'O campo Veículo é obrigatório.',
        'ano_modelo.required' => 'O campo Ano/Modelo é obrigatório.',
        'placa.required' => 'O campo Placa é obrigatório.',
        'placa.unique' => 'Esta Placa já está cadastrada.',
        'renavam.required' => 'O campo Renavam é obrigatório.',
        'renavam.unique' => 'Este Renavam já está cadastrado.',
        'cor.required' => 'O campo Cor é obrigatório.',
        'chassi.required' => 'O campo Chassi é obrigatório.',
        'chassi.unique' => 'Este Chassi já está cadastrado.',
        'cod_seg_crv.required' => 'O campo Código de Segurança CRV é obrigatório.',
        'cod_seg_crv.unique' => 'Este Código de Segurança CRV já está cadastrado.',
        'cod_seg_cla.required' => 'O campo Código de Segurança CLA é obrigatório.',
        'cod_seg_cla.unique' => 'Este Código de Segurança CLA já está cadastrado.',
        'crv.required' => 'O campo CRV é obrigatório.',
        'crv.unique' => 'Este CRV já está cadastrado.',
        'atpve.required' => 'O campo ATPVE é obrigatório.',
        'atpve.unique' => 'Este ATPVE já está cadastrado.',
    ]);

        Veiculo::create($request->all());

        return redirect(url('/dashboard'));

    }

    public function dashboard(Request $request)
{
    $query = Veiculo::query();

    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        
        // Busca nos veículos
        $query->where(function($q) use ($search) {
            $q->where('veiculo', 'like', '%' . $search . '%')
              ->orWhere('placa', 'like', '%' . $search . '%')
              ->orWhere('cor', 'like', '%' . $search . '%')
              ->orWhere('ano_modelo', 'like', '%' . $search . '%');
        });

        $pessoas = Pessoa::where(function($q) use ($search) {
            $q->where('cpf', 'like', '%' . $search . '%')
              ->orWhere('cnpj', 'like', '%' . $search . '%');
        })->pluck('id');

        if ($pessoas->isNotEmpty()) {
            $query->orWhereIn('proprietario_id', $pessoas);
        }
    }

    $veiculo = $query->get();

    return view('auth.dashboard', compact('veiculo'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Veiculo::findOrFail($request->id)->update($request->all());

        return redirect('/veiculo/dashboard')->with('msg','Veiculo editado com sucesso');
    }

    public function edit($id)
    {
        $veiculo = Veiculo::findOrFail($id);

        return view('veiculos.edit', ['veiculo' => $veiculo]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Veiculo::findOrFail($id)->delete();

        return redirect(url('/auth.dashboard'))->with('msg','Veiculo excluido com sucesso');
    }

    public function show($id)
    {
        $veiculo = Veiculo::findOrFail($id);

        return view('veiculos.show', ['veiculo' => $veiculo]);
    }
}
