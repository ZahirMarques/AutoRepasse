<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="bg-cover grid h-full object-center bg-gradient-to-l from-white from-65% to-indigo-500 place-items-center min-h-screen">

        <nav class="mt-16 bg-indigo-500 w-9/12 rounded-lg sticky top-0 z-50">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <img src="{{ asset('img/autorepasse.png') }}" alt="Imagem AutoRepasse" class="h-8">
              <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <h1 class="text-white font-bold text-xl">Bem vindo, {{ Auth::user()->name }}!</h1>
              </a>
              <div class="hidden w-full md:block md:w-auto">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                  <li>
                    <button class="px-2 py-1 bg-white text-indigo-400 border-2 border-white font-bold rounded-lg hover:bg-indigo-400 hover:text-white duration-300" onclick="window.location.href='/veiculo/create'">Cadastrar Veículo</button>
                  </li>
                  <li>
                    <button class="px-2 py-1 bg-white text-indigo-400 border-2 border-white font-bold rounded-lg hover:bg-indigo-400 hover:text-white duration-300" onclick="window.location.href='/pessoa/create'">Cadastrar Pessoa</button>
                  </li>
                  <li>
                    <button class="px-2 py-1 bg-white text-indigo-400 border-2 border-white font-bold rounded-lg hover:bg-indigo-400 hover:text-white duration-300" onclick="window.location.href='/pessoa/dashboard'">Pessoas Cadastradas</button>
                  </li>
                  <li>
                    <button class="px-2 py-1 bg-white text-indigo-400 border-2 border-white font-bold rounded-lg hover:bg-indigo-400 hover:text-white duration-300" onclick="window.location.href='/venda/create'">Cadastrar Venda</button>
                  </li>
                  <li>
                    <form action="{{ url('/logout') }}" method="post">
                        @csrf
                        <button class="px-2 py-1 bg-red-500 text-white border-2 font-bold border-red-500 rounded-lg hover:bg-red-700 hover:border-red-700 hover:text-white duration-300">Sair</button>
                    </form>
                  </li>
                </ul>
              </div>
            </div>
        </nav>

        <div class="flex justify-center items-center w-9/12 h-4/6 py-1">
            <form action="{{ url('/veiculo/dashboard') }}" method="GET" class="flex space-x-4 w-full">
                <!-- Campo de pesquisa -->
                <div class="flex items-center w-full">
                    <input type="text" name="search" placeholder="Pesquisar por veículo, modelo, placa ou cor"
                        class="w-full px-4 py-2 border-2 rounded-lg border-gray-300 rounded-l-md focus:outline-none focus:ring-2"
                    >
                    <select name="filter" 
                        class="border-2 rounded-lg border-gray-300 mx-3 py-2 px-2 rounded-r-md focus:ring-2"
                    >
                        <option value="">Filtrar por...</option>
                        <option value="veiculo">Veículo</option>
                        <option value="placa">Placa</option>
                        <option value="ano">Ano</option>
                        <option value="cor">Cor</option>
                        <option value="cpf">CPF do Proprietário</option>
                        <option value="cnpj">CNPJ do Proprietário</option>
                    </select>
                </div>
                
                <!-- Botões -->
                <div class="flex space-x-2 mr-4">
                    <button type="submit" class="my-5 px-2 bg-green-500 text-white border-2 text-base font-bold border-green-500 rounded-lg hover:bg-green-700 hover:border-green-700 hover:text-white duration-300"> Buscar </button>
                    <button type="submit" name="all" value="1" class="my-5 px-2 bg-indigo-500 text-white border-2 text-sm font-bold border-indigo-500 rounded-lg hover:bg-indigo-700 hover:border-indigo-700 hover:text-white duration-300"> Mostrar Todos </button>
                </div>
            </form>
        </div>
        

        <div class="grid grid-rows-3 w-11/12 h-4/6 bg-red-300">
                <div> 
                    <h1>Veículos Cadastrados</h1>
                </div>
    
                <div> 
                    <ul class="list-none p-0">
                        @if (count($veiculo) > 0)
                            @foreach ($veiculo as $veiculos)
                            <li class="mb-4 border border-gray-300 p-4">
                                <!-- Exibição dos veículos sem tabela -->
                                <div class="flex items-center">
                                    <!-- Espaço para a foto do veículo -->
                                    <div class="w-36 mr-4">
                                        <img src="{{ $veiculos->foto_url ?? '/path/to/default-image.jpg' }}" alt="Foto do Veículo" class="w-full h-auto object-cover">
                                    </div>
                                    <div class="flex-1 cursor-pointer" onclick="window.location.href='/veiculo/show/{{$veiculos->id}}'">
                                        <p><strong>Veículo:</strong> {{ $veiculos->veiculo }}</p>
                                        <p><strong>Ano:</strong> {{ $veiculos->ano_modelo }}</p>
                                        <p><strong>Placa:</strong> {{ $veiculos->placa }}</p>
                                        <p><strong>Cor:</strong> {{ $veiculos->cor }}</p>
                                    </div>
                                    <!-- Botões de Ação à direita -->
                                    <div class="ml-4">
                                        <form action="/veiculo/edit/{{ $veiculos->id }}" method="get" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded mr-2 hover:bg-blue-600">Editar</button>
                                        </form>
                                        <form action="/veiculo/destroy/{{ $veiculos->id }}" method="post" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">Deletar</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                    </ul>
                    @else
                    <p>Você ainda não cadastrou nenhum veículo, <a href="{{ url('/veiculo/create') }}">Cadastrar Veículo</a></p>
                @endif
                </div>
            </div>
        </div>
    </div>

</body>
</html>
