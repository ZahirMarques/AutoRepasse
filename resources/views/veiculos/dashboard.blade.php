<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veículos Cadastrados</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-white via-gray-100 to-violet-700 min-h-screen flex items-center justify-center">
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold text-center text-900 mb-6">Veículos Cadastrados</h1>
        
        <div class="mb-4">
            <button onclick="window.location.href='/veiculos/create'" class="shadow-lg shadow-gray-600 px-4 py-2 bg-white text-violet-500 border-2 font-bold border-violet-500 rounded-lg hover:bg-violet-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Cadastrar Veículo
            </button>
        </div>

        <div>
            <ul class="list-none p-0">
                @if (count($veiculo) > 0)
                    @foreach ($veiculo as $veiculos)
                        <li class="mb-4 border border-gray-300 rounded-lg p-4 shadow-md">
                            <div class="flex items-center">
                                <div class="w-36 mr-4">
                                    <img src="{{ $veiculos->foto_url ?? '/path/to/default-image.jpg' }}" alt="Foto do Veículo" class="w-full h-auto object-cover rounded-lg">
                                </div>
                                <div class="flex-1 cursor-pointer" onclick="window.location.href='/veiculos/show/{{$veiculos->id}}'">
                                    <p class="text-lg font-semibold"><strong>Veículo:</strong> {{ $veiculos->veiculo }}</p>
                                    <p><strong>Ano:</strong> {{ $veiculos->ano_modelo }}</p>
                                    <p><strong>Placa:</strong> {{ $veiculos->placa }}</p>
                                    <p><strong>Cor:</strong> {{ $veiculos->cor }}</p>
                                </div>
                                <div class="ml-4">
                                    <form action="/veiculos/edit/{{ $veiculos->id }}" method="get" class="inline">
                                        @csrf
                                        <button type="submit" class="shadow-lg shadow-gray-600 px-4 py-1 bg-white text-blue-500 border-2 font-bold border-blue-500 rounded-lg hover:bg-blue-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                            Editar
                                        </button>
                                    </form>
                                    <form action="/veiculos/destroy/{{ $veiculos->id }}" method="post" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="shadow-lg shadow-gray-600 px-4 py-1 bg-white text-red-500 border-2 font-bold border-red-500 rounded-lg hover:bg-red-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                            Deletar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <p class="text-center">Você ainda não cadastrou nenhum veículo. <button onclick="window.location.href='/veiculos/create'" class="text-violet-500 underline">Cadastrar Veículo</button></p>
                @endif
            </ul>
        </div>
    </div>
</body>
</html>
