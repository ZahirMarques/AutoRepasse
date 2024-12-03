<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes Cadastrados</title>
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
                       class="{{ request()->is('veiculos/dashboard') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
                       Veículos
                    </a>

                    <!-- Dropdown Menu -->
                    <div id="dropdownMenu" class="absolute left-0 hidden mt-2 space-y-2 bg-white border border-gray-300 rounded-lg shadow-lg opacity-0 transition-opacity duration-200">
                        <a href="{{ url('/veiculos/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-indigo-600">Veículos Cadastrados</a>
                        <a href="{{ url('/veiculos/create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-indigo-600">Cadastrar Veículo</a>
                    </div>
                </div>

                <a href="{{ url('/vendas/create') }}" 
                   class="{{ request()->is('vendas/create') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
                   Vendas
                </a>

                <!-- Clientes Dropdown -->
                <div class="group relative">
                    <a href="{{ url('/clientes/dashboard') }}" 
                    class="{{ request()->is('clientes/dashboard') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
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
    <div class="pt-24 min-h-screen flex justify-center items-start">
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg w-full lg:w-2/3">

        <h1 class="text-2xl font-bold text-center text-violet-600 mb-8">Clientes Cadastrados</h1>

        <!-- Botão Cadastrar Novo Cliente e Barra de Pesquisa -->
        <div class="flex justify-between items-center mb-6">
            <button onclick="window.location.href='/clientes/create'" 
                    class="px-6 py-2 bg-violet-600 text-white font-bold rounded-lg shadow-lg hover:bg-violet-700">
                Cadastrar Novo Cliente
            </button>

            <div class="relative w-1/2">
                <input type="text" id="searchInput" class="w-full px-4 py-2 border rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-600" 
                       placeholder="Pesquisar por cliente..." onkeyup="searchClients()">
            </div>
        </div>

        @if(session('success'))
            <div id="success-message" class="bg-green-100 text-green-700 border border-green-300 p-4 mb-4 rounded flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button id="close-btn" class="ml-4 text-green-700 font-bold">X</button>
            </div>

            <script>
                document.getElementById('close-btn').onclick = function() {
                    document.getElementById('success-message').style.display = 'none';
                };

                setTimeout(function() {
                    document.getElementById('success-message').style.display = 'none';
                }, 10000);
            </script>
        @endif

        <div>
            <ul class="list-none p-0">
                @if (isset($clientes) && count($clientes) > 0)
                    @foreach ($clientes as $cliente)
                        <li class="mb-6 p-6 bg-white rounded-lg border-2 border-blue-500 hover:shadow-xl transition client-item">
                            <div class="flex items-center space-x-6">
                                <div class="flex-1 cursor-pointer" onclick="window.location.href='/clientes/show/{{$cliente->id}}'">
                                    <p class="text-xl font-semibold text-gray-700"><strong>{{ $cliente->nome }}</strong></p>
                                    <p class="text-sm text-gray-600"><strong>ID:</strong> {{ $cliente->id }}</p>
                                    <p class="text-sm text-gray-600"><strong>Cidade:</strong> {{ $cliente->cidade }}</p>
                                    <p class="text-sm text-gray-600"><strong>Estado:</strong> {{ $cliente->estado }}</p>
                                    <p class="text-sm text-gray-600"><strong>Contato:</strong> {{ $cliente->contato }}</p>
                                </div>
                                <div>
                                    <form action="/clientes/edit/{{ $cliente->id }}" method="get" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="px-4 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition">
                                            Editar
                                        </button>
                                    </form>
                                    <form action="/clientes/destroy/{{ $cliente->id }}" method="post" class="inline ml-2" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-4 py-2 text-red-600 bg-white border-2 border-red-600 text-red font-bold rounded-lg hover:bg-red-600 hover:text-white transition">
                                            Deletar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <p class="text-center text-gray-700">Você ainda não cadastrou nenhum cliente.</p>
                @endif
            </ul>
        </div>
    </div>
</div>

<script>
    function searchClients() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const clients = document.querySelectorAll('.client-item');

        clients.forEach(client => {
            const name = client.textContent.toLowerCase();
            client.style.display = name.includes(input) ? 'block' : 'none';
        });
    }

    function confirmDelete() {
        return confirm("Tem certeza que deseja excluir este cliente?");
    }
</script>


<script>
    function searchClients() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const clients = document.querySelectorAll('.client-item');

        clients.forEach(client => {
            const textContent = client.textContent.toLowerCase();
            client.style.display = textContent.includes(input) ? 'block' : 'none';
        });
    }

    function confirmDelete() {
        return confirm("Tem certeza que deseja excluir este cliente?");
    }
</script>


    <script>
        function searchClients() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const clients = document.querySelectorAll('.client-item');

            clients.forEach(client => {
                const name = client.textContent.toLowerCase();
                client.style.display = name.includes(input) ? 'block' : 'none';
            });
        }

        function confirmDelete() {
            return confirm("Tem certeza que deseja excluir este cliente?");
        }
    </script>


    <script>
        (function() {
            const menuToggle = document.getElementById('menuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const dropdownMenu = document.getElementById('dropdownMenu');
            const vehiclesLink = document.querySelector('a[href="{{ url('/veiculos/dashboard') }}"]').parentElement;
            const clientesLink = document.querySelector('a[href="{{ url('/clientes/dashboard') }}"]').parentElement;
            const clientesDropdownMenu = document.getElementById('clientesDropdownMenu');

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
        })();

    </script>
</body>
</html>
