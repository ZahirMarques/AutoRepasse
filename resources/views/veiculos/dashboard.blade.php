<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Veículos Cadastrados</title>
</head>
<body>

    <h1>Veículos Cadastrados</h1>

        @if (count($veiculo) > 0) 

            @foreach ($veiculo as $veiculos)
            <tr>
                <td scropt="row">{{$loop->index + 1}}</td>
                <td><a href="/veiculo/show/{{$veiculos->id}}">{{$veiculos}}</a></td>
                <td>0</td>

            <form action="/veiculo/edit/{{$veiculos->id}}" method="get">
                @csrf
                <button>Editar</button>
                </form>
        
            <form action="/veiculo/destroy/{{$veiculos->id}}" method="post">
                @csrf
                @method('DELETE')

                <button type="submit">Deletar</button>
            </form>
            </tr>
            
            @endforeach
    
        @else
       <p>Você ainda não cadastrou nenhum veiculo, <a href="{{url('/veiculo/create')}}">Cadastrar Veículo</a></p>
        @endif
    
    <p><a href="{{url('index')}}">Voltar</a></p> 
</body>
</html>
