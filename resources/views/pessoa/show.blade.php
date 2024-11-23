<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
        
    <h1>Pessoa: {{$pessoa->nome}}</h1>
    <p>Cidade: {{$pessoa->cidade}}</p>
    <p>Estado: {{$pessoa->estado}}</p>
    <p>CPF: {{$pessoa->cpf}}</p>
    <p>CNPJ: {{$pessoa->cnpj}}</p>
    <p>Contato: {{$pessoa->contato}}</p>
    
    <a href="{{url('/pessoa/dashboard')}}">Voltar</a>

</body>
</html>
