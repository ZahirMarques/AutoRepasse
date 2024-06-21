<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Pessoas</title>
</head>
<body>
    
    <form action="/pessoa/update/{{$pessoa->id}}" method="post">

        @csrf
        @method('PUT')
        
       
        <label>Nome:</label>
        <input type="text" name="pessoa" value="{{$pessoa->nome}}">

        <label>Cidade:</label>
        <input type="text" name="cidade" value="{{$pessoa->cidade}}">

        <label>Estado:</label>
        <input type="text" name="estado" value="{{$pessoa->estado}}">

        <label>CPF:</label>
        <input type="text" name="cpf" value="{{$pessoa->cpf}}">

        <label>CNPJ:</label>
        <input type="text" name="cnpj" value="{{$pessoa->cnpj}}">

        <label>Contato:</label>
        <input type="text" name="contato" value="{{$pessoa->contato}}">

        <button>Editar</button>

    </form>

    <a href="{{url('/pessoa/dashboard')}}">Voltar</a>

</body>
</html>