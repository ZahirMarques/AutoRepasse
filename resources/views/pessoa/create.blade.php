<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de Pessoas</title>
</head>
<body>
    <h1>Cadastrar Pessoas</h1>

    <form action="{{url('/pessoa/store')}}" method="post">

        @csrf

        {{-- Nome --}}
        <label for="nome">Nome</label>
        <input type="text" name="nome">

        {{-- Cidade --}}
        <label for="cidade">Cidade</label>
        <input type="text" name="cidade">

        {{-- Estado --}}
        <label for="estado">Estado</label>
        <input type="text" name="estado">

        {{-- CPF --}}
        <label for="cpf">CPF</label>
        <input type="text" name="cpf">

        {{-- CNPJ --}}
        <label for="cnpj">CNPJ</label>
        <input type="text" name="cnpj">

        {{-- Contato --}}
        <label for="contato">Contato</label>
        <input type="text" name="contato">
        
        <button>Enviar</button>
        
    </form>

    <a href="{{url('index')}}">Voltar</a>

    

</body>
</html>