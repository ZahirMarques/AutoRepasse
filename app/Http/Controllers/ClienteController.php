<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function create()
    {
        return view('clientes.create');
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
                'unique:clientes,cpf', // Aqui você especifica a tabela e coluna
            ],
            'cnpj' => 'nullable|string|max:18',
            'contato' => 'required|string|max:15',
        ], [
            'cpf.regex' => 'O CPF deve ser válido no formato XXX.XXX.XXX-XX ou XXXXXXXXXXX.',
            'cpf.unique' => 'Este CPF já está cadastrado!',
        ]);

        Cliente::create([
            'nome' => $request->nome,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
            'contato' => $request->contato,
        ]);

        session()->flash('success', 'Cliente cadastrado com sucesso!');
        return redirect('/clientes/dashboard')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function dashboard()
    {
        $clientes = Cliente::all(['id', 'nome', 'cidade', 'estado', 'contato']);
        return view('clientes.dashboard', ['clientes' => $clientes]);
    }

    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', ['cliente' => $cliente]);
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', ['cliente' => $cliente]);
    }

    public function update(Request $request, $id)
{
    $cliente = Cliente::findOrFail($id);

    $request->validate([
        'nome' => 'required|string|max:45',
        'cidade' => 'required|string|max:45',
        'estado' => 'required|string|max:2',
        'cpf' => [
            'nullable',
            'string',
            'max:14',
            'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$|^\d{11}$/',
            "unique:clientes,cpf,$id", // Ignorar o CPF do registro atual
        ],
        'cnpj' => 'nullable|string|max:18',
        'contato' => 'required|string|max:15',
    ], [
        'cpf.regex' => 'O CPF deve ser válido no formato XXX.XXX.XXX-XX ou XXXXXXXXXXX.',
        'cpf.unique' => 'Este CPF já está cadastrado!',
    ]);

    $cliente->update([
        'nome' => $request->nome,
        'cidade' => $request->cidade,
        'estado' => $request->estado,
        'cpf' => $request->cpf,
        'cnpj' => $request->cnpj,
        'contato' => $request->contato,
    ]);

    return redirect('clientes/dashboard')->with('success', 'Cliente editado com sucesso!');
}

    public function destroy($id)
    {
        Cliente::findOrFail($id)->delete();
        return redirect('/clientes/dashboard')->with('msg', 'Cliente excluído com sucesso');
    }
}
