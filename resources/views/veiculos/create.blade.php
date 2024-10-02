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

    <form action="{{ url('veiculo/store') }}" method="post">
        @csrf

        {{-- Veiculo --}}
        <label>Veiculo:</label>
        <input type="text" name="veiculo" value="{{ old('veiculo') }}"> <br>
        @error('veiculo')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        {{-- Ano/Modelo --}}
        <label>Ano/Modelo:</label>
        <input type="text" name="ano_modelo" value="{{ old('ano_modelo') }}"> <br>
        @error('ano_modelo')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        {{-- Placa --}}
        <label>Placa:</label>
        <input type="text" name="placa" value="{{ old('placa') }}"> <br>
        @error('placa')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        {{-- Renavam --}}
        <label>Renavam:</label>
        <input type="text" name="renavam" value="{{ old('renavam') }}"> <br>
        @error('renavam')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        {{-- Cor --}}
        <label>Cor:</label>
        <input type="text" name="cor" value="{{ old('cor') }}"> <br>
        @error('cor')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        {{-- Chassi --}}
        <label>Chassi:</label>
        <input type="text" name="chassi" value="{{ old('chassi') }}"> <br>
        @error('chassi')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        {{-- Codigo de Segurança CRV --}}
        <label>Codigo Seg. CRV:</label>
        <input type="text" name="cod_seg_crv" value="{{ old('cod_seg_crv') }}"> <br>
        @error('cod_seg_crv')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        {{-- Codigo de Segurança CLA --}}
        <label>Codigo Seg. CLA:</label>
        <input type="text" name="cod_seg_cla" value="{{ old('cod_seg_cla') }}"> <br>
        @error('cod_seg_cla')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        {{-- CRV --}}
        <label>CRV:</label>
        <input type="text" name="crv" value="{{ old('crv') }}"> <br>
        @error('crv')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        {{-- ATPVE --}}
        <label>ATPVE:</label>
        <input type="text" name="atpve" value="{{ old('atpve') }}"> <br>
        @error('atpve')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <button>Adicionar Veículo</button> <br> <br>
    </form>

    <a href="{{ url('dashboard') }}">Voltar</a>
</body>
</html>
