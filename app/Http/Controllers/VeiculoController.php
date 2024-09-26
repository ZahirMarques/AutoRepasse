<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;

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
        
        Veiculo::create($request->all());

        return redirect(url('/dashboard'));

    }

    public function dashboard(Request $request)
{
    // Verifica se há um parâmetro de pesquisa
    $search = $request->input('search');

    // Se houver busca, filtra os veículos com base nos campos especificados
    if ($search) {
        $veiculo = Veiculo::where('veiculo', 'like', "%{$search}%")
                          ->orWhere('ano_modelo', 'like', "%{$search}%")
                          ->orWhere('placa', 'like', "%{$search}%")
                          ->orWhere('cor', 'like', "%{$search}%")
                          ->get();
    } else {
        // Se não houver busca, retorna todos os veículos
        $veiculo = Veiculo::all(['id', 'veiculo', 'ano_modelo', 'placa', 'cor']);
    }

    return view('auth.dashboard', [
        'veiculo' => $veiculo,
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
        $veiculo = Veiculo::findOrFail($id);

        return view('veiculos.show', ['veiculo' => $veiculo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $veiculo = Veiculo::findOrFail($id);

        return view('veiculos.edit', ['veiculo' => $veiculo]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Veiculo::findOrFail($id)->delete();

        return redirect(url('/index'))->with('msg','Veiculo excluido com sucesso');
    }
}
