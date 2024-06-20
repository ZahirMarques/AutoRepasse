<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem vindo, {{Auth::user()->name}}</h1>   

    <a href="{{url('/veiculo/create')}}">Cadastrar Veículo</a> <br>

    <a href="{{url('/pessoa/create')}}">Cadastrar Pessoa</a> <br>

    <a href="{{url('/veiculo/dashboard')}}">Veículos Cadastrados</a> <br>

    <a href="{{url('/venda/create')}}">Cadastrar Vendas</a> <br>

    <form action="{{url('/logout')}}" method="post"> <br> <br>
        @csrf
        <button>Sair</button>
    </form>
</body>
</html>