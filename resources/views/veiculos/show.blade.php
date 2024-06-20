<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
        
    <h1>Veiculo: {{$veiculo->veiculo}}</h1>
    <p>Ano/Modelo: {{$veiculo->ano_modelo}}</p>
    <p>Placa: {{$veiculo->placa}}</p>
    <p>Cor: {{$veiculo->cor}}</p>
    <p>Renavam: {{$veiculo->renavam}}</p>
    <p>CRV: {{$veiculo->crv}}</p>
    <p>Codigo de segurança do CRV:{{$veiculo->cod_seg_crv}}</p>
    <p>CLA: {{$veiculo->cla}}</p>
    <p>Codigo de segurança do CLA: {{$veiculo->cod_seg_cla}}</p>
    <p>Chassi: {{$veiculo->chassi}}</p>
    <p>Atpve: {{$veiculo->atpve}}</p>
    
    <a href="{{url('/veiculo/dashboard')}}">Voltar</a>
</body>
</html>