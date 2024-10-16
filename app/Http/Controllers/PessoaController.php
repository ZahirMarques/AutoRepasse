<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
class PessoaController extends Controller
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
        return view('pessoa.create');
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
            'nome' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'cpf' => [
                'required',
                'string',
                'max:18',
            ],
            'cnpj' => [
                'nullable',
                'string',
                'max:18',
               
            ],
            'contato' => 'required|string|max:15',
        ], [
            'cpf.regex' => 'O CPF deve ser um número válido no formato XXX.XXX.XXX-XX ou XXXXXXXXXXX.',
            'cnpj.regex' => 'O CNPJ deve ser um número válido no formato XX.XXX.XXX/XXXX-XX ou XXXXXXXXXXXXXXX.',
        ]);

        Pessoa::create([

            'nome' => $request->nome,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
            'contato' => $request->contato,
        ]);

        return redirect(url('/pessoa/dashboard'));
    }

    public function dashboard() {

        $pessoa = Pessoa::all(['id','nome','contato']);
        return view('pessoa.dashboard', [
            'pessoa' => $pessoa,
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
        $pessoa = Pessoa::findOrFail($id);

        return view('pessoa.show', ['pessoa' => $pessoa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pessoa = Pessoa::findOrFail($id);

        return view('pessoa.edit', ['pessoa' => $pessoa]);
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
        Pessoa::findOrFail($request->id)->update($request->all());

        return redirect('/pessoa/dashboard')->with('msg','Pessoa editada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pessoa::findOrFail($id)->delete();

        return redirect('/pessoa/dashboard')->with('msg','Cliente excluido com sucesso');
    }
}
