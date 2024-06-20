<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastrar Venda</title>
</head>
<body>
    <h1>Cadastrar vendas</h1>
    <form action="{{url('/venda/store')}}" method="post">

        @csrf

        {{-- Financiamento --}}
        <label for="financiamento">Financiamento:</label>
        <input type="checkbox" name="financiamento">


        {{-- Tipo --}}
        <select name="tipo">

            <option value="pix">Pix</option>
            <option value="prazo">À prazo</option>
            <option value="vista">À vista</option>

        </select>
        
        {{-- Pessoas --}}
        <select name="pessoas" id="pessoas">

            @foreach ($pessoas as $pessoa)
            <tr>
                <td><option value={{$pessoa->id}}>{{$pessoa->nome}}</option></td>
            </tr>
            @endforeach

        </select>

        {{-- Veiculos --}}
        <select name="veiculos" id="veiculos">

            @foreach ($veiculos as $veiculo)
            <tr>
                <td><option value={{$veiculo->id}}>{{$veiculo->veiculo}}</option></td>
            </tr>
            @endforeach
            
        </select>

        <button>Enviar</button>
    </form>
</body>
</html>