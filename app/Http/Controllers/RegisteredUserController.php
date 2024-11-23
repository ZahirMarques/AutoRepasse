<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Veiculo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("auth.register");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8', // Define o comprimento mínimo da senha
                'regex:/[a-zA-Z]/', // Exige pelo menos uma letra
                'regex:/[0-9]/', // Exige pelo menos um número
            ],
        ];

        $messages = [
            'email.unique' => 'Este endereço de e-mail já está em uso. Por favor, escolha outro endereço de e-mail.',
            'password.regex' => 'A senha deve conter pelo menos uma letra e um número.',
            'name.min' => 'O nome deve ter no minimo 3 letras',
            'password.min' => 'A senha deve conter pelo menos 8 caracteres',

        ];

        //Check form fields.
        $request->validate($rules, $messages);

        $email = $request->email;
        $password = $request->password;
        $name = $request->name;

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        Auth::login($user);

        return redirect(url('dashboard'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function dashboard()
    {

        $veiculo = Veiculo::all(['id', 'veiculo', 'ano_modelo', 'placa', 'cor']);
        return view('auth.dashboard', [
            'veiculo' => $veiculo,
        ]);
    }
}
