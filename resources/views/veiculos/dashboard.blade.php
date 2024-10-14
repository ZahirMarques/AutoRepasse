<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div>
        <div> 
            <h1>Veiculos Cadastrados</h1>
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
                                    <div class="flex-1 cursor-pointer" onclick="window.location.href='/veiculos/show/{{$veiculos->id}}'">
                                        <p><strong>Veículo:</strong> {{ $veiculos->veiculo }}</p>
                                        <p><strong>Ano:</strong> {{ $veiculos->ano_modelo }}</p>
                                        <p><strong>Placa:</strong> {{ $veiculos->placa }}</p>
                                        <p><strong>Cor:</strong> {{ $veiculos->cor }}</p>
                                    </div>
                                    <!-- Botões de Ação à direita -->
                                    <div class="ml-4">
                                        <form action="/veiculos/edit/{{ $veiculos->id }}" method="get" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded mr-2 hover:bg-blue-600">Editar</button>
                                        </form>
                                        <form action="/veiculos/destroy/{{ $veiculos->id }}" method="post" class="inline">
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
                    <p>Você ainda não cadastrou nenhum veículo, <button onclick="window.location.href='/veiculos/create'"> Cadastrar Veículo </button> </p>
                @endif
                </div>
            </div>
        </div>

        <div>
            <button onclick="window.location.href='/veiculos/create'"> Cadastrar Veículo </button>
        </div>
</body>
</html>