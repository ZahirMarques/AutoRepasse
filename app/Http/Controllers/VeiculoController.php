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
        
        $validatedData = $request->validate([
            'veiculo' => 'required|string|max:45', // Campo obrigatório
            'ano_modelo' => 'required|string|max:8', // Campo opcional
            'placa' => 'required|string|max:7|unique:veiculos', // Campo obrigatório e único
            'renavam' => 'required|digits:11|unique:veiculos', // Campo obrigatório, apenas dígitos, único
            'cor' => 'required|string|max:15', // Campo obrigatório
            'chassi' => 'nullable|string|max:20|unique:veiculos', // Campo opcional, único
            'cod_seg_crv' => 'nullable|digits:20|unique:veiculos', // Campo opcional, apenas dígitos, único
            'cod_seg_cla' => 'nullable|digits:20|unique:veiculos', // Campo opcional, apenas dígitos, único
            'crv' => 'nullable|digits:20|unique:veiculos', // Campo opcional, apenas dígitos, único
            'atpve' => 'nullable|string|max:20|unique:veiculos', // Campo opcional, único
        ], [
            'veiculo.required' => 'O campo Veículo é obrigatório.',
            'ano_modelo.required' => 'O campo ano/modelo é obrigatório.',
            'placa.required' => 'O campo Placa é obrigatório.',
            'placa.unique' => 'Esta Placa já está cadastrada.',
            'placa.max' => 'A placa não pode ter mais de 7 caracteres.',
            'renavam.required' => 'O campo Renavam é obrigatório.',
            'renavam.digits' => 'O Renavam deve conter exatamente 11 números.',
            'renavam.unique' => 'Este Renavam já está cadastrado.',
            'cor.required' => 'O campo Cor é obrigatório.',
            'chassi.unique' => 'Este Chassi já está cadastrado.',
            'cod_seg_crv.digits' => 'O Código de Segurança CRV deve conter apenas números.',
            'cod_seg_cla.digits' => 'O Código de Segurança CLA deve conter apenas números.',
            'crv.digits' => 'O CRV deve conter apenas números.',
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
