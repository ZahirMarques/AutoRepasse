<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Pessoas Cadastradas</h1>

        @if (count($pessoa) > 0) 

            @foreach ($pessoa as $pessoas)
            <tr>
                <td scropt="row">{{$loop->index + 1}}</td>
                <td><a href="/pessoa/show/{{$pessoas->id}}">{{$pessoas}}</a></td>
                <td>0</td>

            <form action="/pessoa/edit/{{$pessoas->id}}" method="get">
                @csrf
                <button>Editar</button>
                </form>
        
            <form action="/pessoa/destroy/{{$pessoas->id}}" method="post">
                @csrf
                @method('DELETE')

                <button type="submit">Deletar</button>
            </form>
            </tr>
            
            @endforeach
    
        @else
       <p>Você ainda não cadastrou nenhuma pessoa, <a href="{{url('/pessoa/create')}}">Cadastrar Pessoa</a></p>
        @endif
    
    <p><a href="{{url('index')}}">Voltar</a></p> 
</body>
</html>