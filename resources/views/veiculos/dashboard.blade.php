<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veículos Cadastrados</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-6 border-b-2 fixed top-0 left-0 w-full z-10">
        <div class="container mx-auto px-4 flex flex-wrap items-center justify-center">
            <!-- Logo -->
            <div class="flex items-center absolute left-4">
                <img src="{{ asset('img/autorepasse.png') }}" alt="Imagem AutoRepasse" class="w-26 h-8">
            </div>

            <!-- Navigation Links (Desktop) -->
            <div class="flex items-center space-x-8 text-base font-semibold text-gray-700 md:flex hidden">
                <a href="{{ url('/dashboard') }}"
                   class="{{ request()->is('dashboard') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
                   Dashboard
                </a>

                <!-- Veículos Dropdown -->
                <div class="group relative">
                    <a href="{{ url('/veiculos/dashboard') }}"
                       class="{{ request()->is('veiculos/*') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
                       Veículos
                    </a>

                    <!-- Dropdown Menu -->
                    <div id="dropdownMenu" class="absolute left-0 hidden mt-2 space-y-2 bg-white border border-gray-300 rounded-lg shadow-lg opacity-0 transition-opacity duration-200">
                        <a href="{{ url('/veiculos/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-indigo-600">Veículos Cadastrados</a>
                        <a href="{{ url('/veiculos/create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-indigo-600">Cadastrar Veículo</a>
                    </div>
                </div>

                <!-- Vendas Dropdown -->
                <div class="group relative">
                    <a href="{{ url('/vendas/dashboard') }}"
                    class="{{ request()->is('vendas/*') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
                    Vendas
                    </a>

                    <!-- Dropdown Menu -->
                    <div id="vendasDropdownMenu" class="absolute left-0 hidden mt-2 space-y-2 bg-white border border-gray-300 rounded-lg shadow-lg opacity-0 transition-opacity duration-200">
                        <a href="{{ url('/vendas/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-indigo-600">Vendas Cadastradas</a>
                        <a href="{{ url('/vendas/create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-indigo-600">Cadastrar Venda</a>
                    </div>
                </div>

                <!-- Clientes Dropdown -->
                <div class="group relative">
                    <a href="{{ url('/clientes/dashboard') }}"
                    class="{{ request()->is('clientes/*') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
                    Clientes
                    </a>

                    <!-- Dropdown Menu -->
                    <div id="clientesDropdownMenu" class="absolute left-0 hidden mt-2 space-y-2 bg-white border border-gray-300 rounded-lg shadow-lg opacity-0 transition-opacity duration-200">
                        <a href="{{ url('/clientes/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-indigo-600">Clientes Cadastrados</a>
                        <a href="{{ url('/clientes/create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-indigo-600">Cadastrar Cliente</a>
                    </div>
                </div>


                <!-- Logout Button -->
                <form action="{{ url('/logout') }}" method="post" class="flex items-center space-x-2 ml-4">
                    @csrf
                    <button class="text-gray-700 text-sm hover:text-red-500">
                        Sair
                    </button>
                </form>
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="md:hidden flex items-center ml-auto">
                <button id="menuToggle" class="text-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div id="mobileMenu" class="hidden md:hidden flex flex-col mt-4 space-y-4 bg-white px-4 py-2">
            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-violet-500">Dashboard</a>
            <a href="{{ url('/veiculos/dashboard') }}" class="text-gray-700 hover:text-violet-500">Veículos</a>
            <a href="{{ url('/vendas/create') }}" class="text-gray-700 hover:text-violet-500">Vendas</a>
            <a href="{{ url('/clientes/dashboard') }}" class="text-gray-700 hover:text-violet-500">Clientes</a>
            <!-- Logout Button -->
            <form action="{{ url('/logout') }}" method="post" class="flex items-center space-x-2 mt-4">
                @csrf
                <button class="text-gray-700 text-sm hover:text-red-500">
                    Sair
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <!-- Main Content -->
<div class="pt-24 min-h-screen flex justify-center items-start">
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg w-full lg:w-2/3">

        <h1 class="text-2xl font-bold text-center text-violet-600 mb-8">Veículos Cadastrados</h1>

        <!-- Botão Cadastrar Novo Veículo e Barra de Pesquisa -->
        <div class="flex justify-between items-center mb-6">
            <button onclick="window.location.href='/veiculos/create'"
                    class="px-6 py-2 bg-violet-600 text-white font-bold rounded-lg shadow-lg hover:bg-violet-700">
                Cadastrar Novo Veículo
            </button>

            <button onclick="window.print()"
                    class="px-6 py-2 border-2 border-violet-600 text-violet-600 font-bold rounded-lg shadow-lg hover:bg-gray-100 ml-2">
                Imprimir
            </button>

            <!-- Barra de Pesquisa -->
            <div class="relative w-2/3"> <!-- Aumentando a largura da barra de pesquisa -->
                <input type="text" id="searchInput" class="w-full px-4 py-2 border rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-600"
                    placeholder="Pesquisar por veículo..." onkeyup="searchVehicles()">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h9" />
                </svg>
            </div>
        </div>

            @if(session('success'))
                    <div id="success-message" class="bg-green-100 text-green-700 border border-green-300 p-4 mb-4 rounded flex justify-between items-center">
                        <span>{{ session('success') }}</span>
                        <button id="close-btn" class="ml-4 text-green-700 font-bold">X</button>
                    </div>

                    <script>
                        // Fechar a mensagem quando o botão de fechar for clicado
                        document.getElementById('close-btn').onclick = function() {
                            document.getElementById('success-message').style.display = 'none';
                        };

                        // Fazer a mensagem desaparecer automaticamente após 10 segundos
                        setTimeout(function() {
                            document.getElementById('success-message').style.display = 'none';
                        }, 10000);
                    </script>
                @endif

        <div>
            <ul class="list-none p-0">
                @if (count($veiculo) > 0)
                    @foreach ($veiculo as $veiculos)
                        <li class="mb-6 p-6 bg-white rounded-lg border-2 border-blue-500 hover:shadow-xl transition veiculo-item">
                            <div class="flex items-center space-x-6">
                                <div class="flex-1 cursor-pointer" onclick="window.location.href='/veiculos/show/{{$veiculos->id}}'">
                                    <p class="text-xl font-semibold text-gray-700"><strong> {{ $veiculos->marca}} {{ $veiculos->modelo}} </strong></p>
                                    <p class="text-sm text-gray-600"><strong>Ano:</strong> {{ $veiculos->ano_modelo }}</p>
                                    <p class="text-sm text-gray-600"><strong>Placa:</strong> {{ $veiculos->placa }}</p>
                                    <p class="text-sm text-gray-600"><strong>Cor:</strong> {{ $veiculos->cor }}</p>
                                    <p class="text-sm text-gray-600"><strong>Situação:</strong> {{ $veiculos->situacao }}</p>
                                </div>
                                <div>
                                    <form action="/veiculos/edit/{{ $veiculos->id }}" method="get" class="inline">
                                        @csrf
                                        <button type="submit"
                                                class="px-4 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition">
                                            Editar
                                        </button>
                                    </form>
                                    <form action="/veiculos/destroy/{{ $veiculos->id }}" method="post" class="inline ml-2" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 text-red-600 bg-white border-2 border-red-600 text-red font-bold rounded-lg hover:bg-red-600 hover:text-white transition">
                                            Deletar
                                        </button>
                                    </form>

                                    <script>
                                        function confirmDelete() {
                                            return confirm("Tem certeza que deseja excluir este veículo?");
                                        }
                                    </script>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <p class="text-center text-gray-700">Você ainda não cadastrou nenhum veículo.</p>
                @endif
            </ul>
        </div>
    </div>
</div>

<footer class="bg-violet-600 text-white py-4 mt-6">
    <div class="container mx-auto text-center">
        <p class="text-sm">© 2024 Sistema de Venda de Veículos. Todos os direitos reservados.</p>
    </div>
</footer>

    <script>
        function searchVehicles() {
        // Pega o valor da barra de pesquisa
        const searchQuery = document.getElementById('searchInput').value.toLowerCase();

        // Pega todos os itens da lista de veículos
        const veiculos = document.querySelectorAll('.veiculo-item');

        // Itera sobre os itens da lista
        veiculos.forEach(function(veiculo) {
            // Pega o texto dos campos que queremos buscar (por exemplo, nome do veículo, placa, etc.)
            const veiculoNome = veiculo.querySelector('.text-xl').innerText.toLowerCase();
            const veiculoAno = veiculo.querySelector('.text-sm.text-gray-600').innerText.toLowerCase();
            const veiculoCor = veiculo.querySelector('.text-sm.text-gray-600').innerText.toLowerCase();
            const veiculoPlaca = veiculo.querySelectorAll('.text-sm.text-gray-600')[1].innerText.toLowerCase();

            // Verifica se o nome, ano ou placa do veículo contém o texto da pesquisa
            if (veiculoNome.includes(searchQuery) || veiculoAno.includes(searchQuery) || veiculoCor.includes(searchQuery) || veiculoPlaca.includes(searchQuery)) {
                veiculo.style.display = ''; // Exibe o item
            } else {
                veiculo.style.display = 'none'; // Esconde o item
            }
        });
    }

    (function() {
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const vehiclesLink = document.querySelector('a[href="{{ url('/veiculos/dashboard') }}"]').parentElement;
        const clientesLink = document.querySelector('a[href="{{ url('/clientes/dashboard') }}"]').parentElement;
        const vendasLink = document.querySelector('a[href="{{ url('/vendas/dashboard') }}"]').parentElement;
        const clientesDropdownMenu = document.getElementById('clientesDropdownMenu');
        const vendasDropdownMenu = document.getElementById('vendasDropdownMenu');

        // Mobile Menu Toggle
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');
        });

        // Veículos Dropdown
        vehiclesLink.addEventListener('mouseenter', () => {
            dropdownMenu.classList.remove('hidden');
            setTimeout(() => {
                dropdownMenu.classList.add('opacity-100');
            }, 0);
        });

        vehiclesLink.addEventListener('mouseleave', () => {
            setTimeout(() => {
                if (!dropdownMenu.matches(':hover')) {
                    dropdownMenu.classList.remove('opacity-100');
                    dropdownMenu.classList.add('hidden');
                }
            }, 100);
        });

        dropdownMenu.addEventListener('mouseenter', () => {
            dropdownMenu.classList.remove('opacity-0');
            dropdownMenu.classList.add('opacity-100');
        });

        dropdownMenu.addEventListener('mouseleave', () => {
            setTimeout(() => {
                dropdownMenu.classList.remove('opacity-100');
                dropdownMenu.classList.add('hidden');
            }, 100);
        });

        // Clientes Dropdown
        clientesLink.addEventListener('mouseenter', () => {
            clientesDropdownMenu.classList.remove('hidden');
            setTimeout(() => {
                clientesDropdownMenu.classList.add('opacity-100');
            }, 0);
        });

        clientesLink.addEventListener('mouseleave', () => {
            setTimeout(() => {
                if (!clientesDropdownMenu.matches(':hover')) {
                    clientesDropdownMenu.classList.remove('opacity-100');
                    clientesDropdownMenu.classList.add('hidden');
                }
            }, 100);
        });

        clientesDropdownMenu.addEventListener('mouseenter', () => {
            clientesDropdownMenu.classList.remove('opacity-0');
            clientesDropdownMenu.classList.add('opacity-100');
        });

        clientesDropdownMenu.addEventListener('mouseleave', () => {
            setTimeout(() => {
                clientesDropdownMenu.classList.remove('opacity-100');
                clientesDropdownMenu.classList.add('hidden');
            }, 100);
        });

        // Vendas Dropdown
        vendasLink.addEventListener('mouseenter', () => {
            vendasDropdownMenu.classList.remove('hidden');
            setTimeout(() => {
                vendasDropdownMenu.classList.add('opacity-100');
            }, 0);
        });

        vendasLink.addEventListener('mouseleave', () => {
            setTimeout(() => {
                if (!vendasDropdownMenu.matches(':hover')) {
                    vendasDropdownMenu.classList.remove('opacity-100');
                    vendasDropdownMenu.classList.add('hidden');
                }
            }, 100);
        });

        vendasDropdownMenu.addEventListener('mouseenter', () => {
            vendasDropdownMenu.classList.remove('opacity-0');
            vendasDropdownMenu.classList.add('opacity-100');
        });

        vendasDropdownMenu.addEventListener('mouseleave', () => {
            setTimeout(() => {
                vendasDropdownMenu.classList.remove('opacity-100');
                vendasDropdownMenu.classList.add('hidden');
            }, 100);
        });
    })();

    </script>
</body>
</html>
