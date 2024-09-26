<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro Veiculo</title>
</head>
<body>
    <h1>Cadastro de Veículo</h1>

    <form action="{{url("veiculo/store")}}" method="post">

        @csrf

        {{-- Veiculo --}}
        <label>Veiculo:</label>
        <input type="text" name="veiculo"> <br>

        {{-- Ano/Modelo --}}
        <label>Ano/Modelo:</label>
        <input type="text" name="ano_modelo"> <br>

        {{-- Placa --}}
        <label>Placa:</label>
        <input type="text" name="placa"> <br>

        {{-- Renavam --}}
        <label>Renavam:</label>
        <input type="text" name="renavam"> <br>

        {{-- Cor --}}
        <label>Cor:</label>
        <input type="text" name="cor"> <br>

        {{-- Chassi --}}
        <label>Chassi:</label>
        <input type="text" name="chassi"> <br>

        {{-- Codigo de Segurança CRV --}}
        <label>Codigo Seg. CRV:</label>
        <input type="text" name="cod_seg_crv"> <br>

        {{-- Codigo de Segurança CLA --}}
        <label>Codigo Seg. CLA:</label>
        <input type="text" name="cod_seg_cla"> <br>

        {{-- CRV --}}
        <label>CRV:</label>
        <input type="text" name="crv"> <br>

        {{-- ATPVE --}}
        <label>ATPVE:</label>
        <input type="text" name="atpve"> <br> <br>

        <button>Adicionar Veículo</button> <br> <br>

    </form>

    <a href="{{url('dashboard')}}">Voltar</a>
</body>
</html>