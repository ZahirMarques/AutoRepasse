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
                'nullable',
                'string',
                'max:14',
                'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$|^\d{11}$/',
                'unique:pessoas,cpf', // Aqui você especifica a tabela e coluna
            ],
            'cnpj' => 'nullable|string|max:18',
            'contato' => 'required|string|max:15',
        ], [
            'cpf.regex' => 'O CPF deve ser válido no formato XXX.XXX.XXX-XX ou XXXXXXXXXXX.',
            'cpf.unique' => 'Este CPF já está cadastrado!',
        ]);

        Pessoa::create([
            'nome' => $request->nome,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
            'contato' => $request->contato,
        ]);

        session()->flash('success', 'Cliente cadastrado com sucesso!');
        return redirect('/pessoa/dashboard')->with('success', 'Pessoa cadastrada com sucesso!');
    }

    public function dashboard()
    {
        $pessoas = Pessoa::all(['id', 'nome', 'cidade', 'estado', 'contato']);
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

    $request->validate([
        'nome' => 'required|string|max:45',
        'cidade' => 'required|string|max:45',
        'estado' => 'required|string|max:2',
        'cpf' => [
            'nullable',
            'string',
            'max:14',
            'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$|^\d{11}$/',
            "unique:pessoas,cpf,$id", // Ignorar o CPF do registro atual
        ],
        'cnpj' => 'nullable|string|max:18',
        'contato' => 'required|string|max:15',
    ], [
        'cpf.regex' => 'O CPF deve ser válido no formato XXX.XXX.XXX-XX ou XXXXXXXXXXX.',
        'cpf.unique' => 'Este CPF já está cadastrado!',
    ]);

    $pessoa->update([
        'nome' => $request->nome,
        'cidade' => $request->cidade,
        'estado' => $request->estado,
        'cpf' => $request->cpf,
        'cnpj' => $request->cnpj,
        'contato' => $request->contato,
    ]);

    return redirect('pessoa/dashboard')->with('success', 'Pessoa editada com sucesso!');
}

    public function destroy($id)
    {
        Pessoa::findOrFail($id)->delete();
        return redirect('/pessoa/dashboard')->with('msg', 'Pessoa excluída com sucesso');
    }
}
