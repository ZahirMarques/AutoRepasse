<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>

    <h1>Bem vindo, {{ Auth::user()->name }}</h1>

    <a href="{{ url('/veiculo/create') }}">Cadastrar Veículo</a> <br>
    <a href="{{ url('/pessoa/create') }}">Cadastrar Pessoa</a> <br>
    <a href="{{ url('/pessoa/dashboard') }}">Pessoas Cadastradas</a> <br>
    <a href="{{ url('/venda/create') }}">Cadastrar Vendas</a> <br>

    <h1>Veículos Cadastrados</h1>

    <!-- Formulário de Pesquisa com Dropdown e Botão "Mostrar Todos" -->
    <form action="{{ url('/veiculo/dashboard') }}" method="GET">
        <select name="filtro" id="filtro">
            <option value="">Selecione um filtro (Opcional)</option>
            <option value="nome">Nome do Veículo</option>
            <option value="cpf">CPF do Proprietário</option>
            <option value="cnpj">CNPJ do Proprietário</option>
            <option value="modelo">Modelo do Veículo</option>
            <option value="placa">Placa do Veículo</option>
            <option value="ano">Ano do Veículo</option>
            <option value="cor">Cor do Veículo</option>
        </select>

        <input type="text" name="search" placeholder="Pesquisar...">
        <button type="submit">Buscar</button>

        <!-- Botão para mostrar todos os veículos -->
        <a href="{{ url('/veiculo/dashboard') }}">
            <button type="button">Mostrar Todos</button>
        </a>
    </form>

    @if (count($veiculo) > 0)
        <!-- Exibição dos veículos sem tabela -->
        <div>
            @foreach ($veiculo as $veiculos)
                <div onclick="window.location.href='/veiculo/show/{{$veiculos->id}}'">
                    <p><strong>Veículo:</strong>{{ $veiculos->veiculo }}</p>
                    <p><strong>Ano:</strong> {{ $veiculos->ano_modelo }}</p>
                    <p><strong>Placa:</strong> {{ $veiculos->placa }}</p>
                    <p><strong>Cor:</strong> {{ $veiculos->cor }}</p>

                    <!-- Botões de Ação -->
                    <div>
                        <form action="/veiculo/edit/{{ $veiculos->id }}" method="get" style="display: inline;">
                            @csrf
                            <button type="submit">Editar</button>
                        </form>
                        <form action="/veiculo/destroy/{{ $veiculos->id }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Deletar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Você ainda não cadastrou nenhum veículo, <a href="{{ url('/veiculo/create') }}">Cadastrar Veículo</a></p>
    @endif

    <form action="{{ url('/logout') }}" method="post">
        @csrf
        <button>Sair</button>
    </form>

</body>
</html>
