<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;

class PessoaController extends Controller
{
    public function create()
    {
        return view('pessoa.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nome' => 'required|string|max:45',
        'cidade' => 'required|string|max:45',
        'estado' => 'required|string|max:2',
        'cpf' => [
            'required',
            'string',
            'max:14', // Ajustado para o tamanho correto
            'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$|^\d{11}$/', // Aceita com ou sem formatação
        ],
        'cnpj' => 'nullable|string|max:14',
        'contato' => 'required|string|max:15',
    ], [
        'cpf.regex' => 'O CPF deve ser válido no formato XXX.XXX.XXX-XX ou XXXXXXXXXXX.',
    ]);

    Pessoa::create([
        'nome' => $request->nome,
        'cidade' => $request->cidade,
        'estado' => $request->estado,
        'cpf' => $request->cpf,
        'cnpj' => $request->cnpj,
        'contato' => $request->contato,
    ]);

    return redirect(url('/pessoa/dashboard'))->with('msg', 'Pessoa cadastrada com sucesso.');
}


    public function dashboard()
    {
        $pessoas = Pessoa::all(['id', 'nome', 'contato']);
        return view('pessoa.dashboard', ['pessoas' => $pessoas]);
    }

    public function show($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        return view('pessoa.show', ['pessoa' => $pessoa]);
    }

    public function edit($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        return view('pessoa.edit', ['pessoa' => $pessoa]);
    }

    public function update(Request $request, $id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->update($request->all());

        return redirect('/pessoa/dashboard')->with('msg', 'Pessoa editada com sucesso');
    }

    public function destroy($id)
    {
        Pessoa::findOrFail($id)->delete();
        return redirect('/pessoa/dashboard')->with('msg', 'Pessoa excluída com sucesso');
    }
}
