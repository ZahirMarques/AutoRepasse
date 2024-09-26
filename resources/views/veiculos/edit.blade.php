<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
</head>
<body>
    <h1>Editar Veiculo</h1>

    <form action="/veiculo/update/{{$veiculo->id}}" method="post">

        @csrf
        @method('PUT')
        
        {{-- Veiculo --}}
        <label>Veiculo:</label>
        <input type="text" name="veiculo" value="{{$veiculo->veiculo}}">

        {{-- Ano/Modelo --}}
        <label>Ano/Modelo:</label>
        <input type="text" name="ano_modelo" value="{{$veiculo->ano_modelo}}">

        {{-- Placa --}}
        <label>Placa:</label>
        <input type="text" name="placa" value="{{$veiculo->placa}}">

        {{-- Renavam --}}
        <label>Renavam:</label>
        <input type="text" name="renavam" value="{{$veiculo->renavam}}">

        {{-- Cor --}}
        <label>Cor:</label>
        <input type="text" name="cor" value="{{$veiculo->cor}}">

        {{-- Chassi --}}
        <label>Chassi:</label>
        <input type="text" name="chassi" value="{{$veiculo->chassi}}">

        {{-- Codigo de Segurança CRV --}}
        <label>Codigo Seg. CRV:</label>
        <input type="text" name="cod_seg_crv" value="{{$veiculo->cod_seg_crv}}">

        {{-- Codigo de Segurança CLA --}}
        <label>Codigo Seg. CLA:</label>
        <input type="text" name="cod_seg_cla" value="{{$veiculo->cod_seg_cla}}">

        {{-- CRV --}}
        <label>CRV:</label>
        <input type="text" name="crv" value="{{$veiculo->crv}}">

        {{-- ATPVE --}}
        <label>ATPVE:</label>
        <input type="text" name="atpve" value="{{$veiculo->atpve}}">

        <button>Editar</button>

    </form>

    <a href="{{url('/dashboard')}}">Voltar</a>
</body>
</html>
