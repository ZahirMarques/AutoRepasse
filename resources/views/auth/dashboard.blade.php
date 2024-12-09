<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-6 border-b-2 fixed top-0 left-0 w-full z-10">
        <div class="container mx-auto px-4 flex flex-wrap items-center justify-center">
            <!-- Logo -->
            <div class="flex items-center absolute left-4">
                <img src="{{ asset('img/auto.png') }}" alt="Imagem AutoRepasse" class="w-20 h-12">
            </div>

            <!-- Navigation Links (Desktop) -->
            <div class="flex items-center space-x-8 text-base font-semibold text-gray-700 md:flex hidden">
                <a href="{{ url('/dashboard') }}"
                   class="{{ request()->is('dashboard') ? 'text-[#5277ff] text-lg' : 'text-gray-500 text-sm' }} hover:text-[#5277ff]">
                   Dashboard
                </a>

                <!-- Veículos Dropdown -->
                <div class="group relative">
                    <a href="{{ url('/veiculos/dashboard') }}"
                       class="{{ request()->is('veiculos/dashboard') ? 'text-[#5277ff] text-lg' : 'text-gray-500 text-sm' }} hover:text-[#5277ff]">
                       Veículos
                    </a>

                    <!-- Dropdown Menu -->
                    <div id="dropdownMenu" class="absolute left-0 hidden mt-2 space-y-2 bg-white border border-gray-300 rounded-lg shadow-lg opacity-0 transition-opacity duration-200">
                        <a href="{{ url('/veiculos/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-[#5277ff]">Veículos Cadastrados</a>
                        <a href="{{ url('/veiculos/create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-[#5277ff]">Cadastrar Veículo</a>
                    </div>
                </div>

                <!-- Dropdown Menu -->
                <div class="group relative">
                    <a href="{{ url('/vendas/dashboard') }}"
                    class="{{ request()->is('vendas/*') ? 'text-[#5277ff] text-lg' : 'text-gray-500 text-sm' }} hover:text-[#5277ff]">
                    Vendas
                    </a>

                    <!-- Dropdown Menu -->
                    <div id="vendasDropdownMenu" class="absolute left-0 hidden mt-2 space-y-2 bg-white border border-gray-300 rounded-lg shadow-lg opacity-0 transition-opacity duration-200">
                        <a href="{{ url('/vendas/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-[#5277ff]">Vendas Cadastradas</a>
                        <a href="{{ url('/vendas/create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-[#5277ff]">Cadastrar Venda</a>
                    </div>
                </div>

                <!-- Clientes Dropdown -->
                <div class="group relative">
                    <a href="{{ url('/clientes/dashboard') }}"
                    class="{{ request()->is('clientes/dashboard') ? 'text-[#5277ff] text-lg' : 'text-gray-500 text-sm' }} hover:text-[#5277ff]">
                    Clientes
                    </a>

                    <!-- Dropdown Menu -->
                    <div id="clientesDropdownMenu" class="absolute left-0 hidden mt-2 space-y-2 bg-white border border-gray-300 rounded-lg shadow-lg opacity-0 transition-opacity duration-200">
                        <a href="{{ url('/clientes/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-[#5277ff]">Clientes Cadastrados</a>
                        <a href="{{ url('/clientes/create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-[#5277ff]">Cadastrar Cliente</a>
                    </div>
                </div>

                <!-- Logout Button -->
                <form action="{{ url('/logout') }}" method="post" class="flex items-center space-x-2 ml-4" onsubmit="return confirmLogout()">
                    @csrf
                    <button class="text-gray-700 text-sm hover:text-red-500">
                        Sair
                    </button>
                </form>

                <script>
                    function confirmLogout() {
                        return confirm("Tem certeza que deseja sair?");
                    }
                </script>
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
            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-[#5277ff]">Dashboard</a>
            <a href="{{ url('/veiculos/dashboard') }}" class="text-gray-700 hover:text-[#5277ff]">Veículos</a>
            <a href="{{ url('/vendas/create') }}" class="text-gray-700 hover:text-[#5277ff]">Vendas</a>
            <a href="{{ url('/clientes/dashboard') }}" class="text-gray-700 hover:text-[#5277ff]">Clientes</a>
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
    <main class="pt-20 min-h-screen flex justify-center items-center">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 px-4">

        <!-- Todas as Vendas -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h1 class="text-2xl font-bold text-[#5277ff] mb-3 text-center hover:text-[#3253CB] transition cursor-pointer" onclick="window.location.href='/vendas/dashboard'">Vendas</h1>
            <div class="mb-4">
                <!-- Barra de Pesquisa para Vendas -->
                <input type="text" id="searchVendas" class="w-full px-4 py-2 border rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#5277ff]" placeholder="Pesquisar por veículo, comprador..." onkeyup="filterList('vendas')">
            </div>
            <div class="h-[32rem] overflow-y-auto">
                <ul id="vendasList">
                    @foreach ($vendas as $venda)
                    <li class="mb-4 p-4 bg-white rounded-lg border-2 border-[#5277ff] hover:shadow-xl transition cursor-pointer" onclick="window.location.href='/vendas/show/{{$venda->id}}'">
                        <p><strong>{{ $venda->veiculo->marca }} {{ $venda->veiculo->modelo }}</p></strong>
                        <p><strong>Comprador:</strong> {{ $venda->cliente->nome }}</p>
                        <p><strong>ID da Venda:</strong> {{ $venda->id }}</p>
                        <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($venda->created_at)->format('d/m/Y') }}</p>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Todos os Veículos -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h1 class="text-2xl font-bold text-[#5277ff] mb-3 text-center hover:text-[#3253CB] transition cursor-pointer" onclick="window.location.href='/veiculos/dashboard'">Veículos Disponíveis</h1>
            <div class="mb-4">
                <!-- Barra de Pesquisa para Veículos -->
                <input type="text" id="searchVeiculos" class="w-full px-4 py-2 border rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#5277ff]" placeholder="Pesquisar por modelo, marca..." onkeyup="filterList('veiculos')">
            </div>
            <div class="h-[32rem] overflow-y-auto">
                <ul id="veiculosList">
                    @foreach ($veiculos as $veiculo)
                    <li class="mb-4 p-4 bg-white border-2 border-[#5277ff] rounded-lg hover:shadow-xl transition cursor-pointer" onclick="window.location.href='/veiculos/show/{{$veiculo->id}}'">
                        <p><strong>{{ $veiculo->marca }} {{ $veiculo->modelo }} </strong></p>
                        <p><strong>Ano/Modelo: </strong> {{ $veiculo->ano_modelo }}</p>
                        <p><strong>Placa: </strong>{{ $veiculo->placa }}</p>
                        <p><strong>Cor: </strong>{{ $veiculo->cor }}</p>
                        <p><strong>Situação:</strong> {{ $veiculo->situacao }}</p>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Todos os Clientes -->
        <div class="bg-white shadow-md rounded-lg p-4">
            <h1 class="text-2xl font-bold text-[#5277ff] mb-3 text-center hover:text-[#3253CB] transition cursor-pointer" onclick="window.location.href='/clientes/dashboard'">Clientes</h1>
            <div class="mb-4">
                <!-- Barra de Pesquisa para Clientes -->
                <input type="text" id="searchClientes" class="w-full px-4 py-2 border rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#5277ff]" placeholder="Pesquisar por nome, cidade..." onkeyup="filterList('clientes')">
            </div>
            <div class="h-[32rem] overflow-y-auto">
                <ul id="clientesList">
                    @foreach ($clientes as $cliente)
                    <li class="mb-4 p-4 bg-white rounded-lg border-2 border-[#5277ff] hover:shadow-xl transition cursor-pointer" onclick="window.location.href='/clientes/show/{{$cliente->id}}'">
                        <p><strong>Nome:</strong> {{ $cliente->nome }}</p>
                        <p><strong>ID:</strong> {{ $cliente->id }}</p>
                        <p><strong>Telefone:</strong> {{ $cliente->contato }}</p>
                        <p><strong>Cidade:</strong> {{ $cliente->cidade }} - {{ $cliente->estado }}</p>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</main>

<footer class="border-t-2 border-gray-300 bg-white text-black py-4 fixed bottom-0 w-full">
        <div class="container mx-auto text-center">
            <p class="text-sm">© 2024 Sistema de Venda de Veículos. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>
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

        function filterList(section) {
        var input, filter, list, items, i, txtValue;
        input = document.getElementById("search" + section.charAt(0).toUpperCase() + section.slice(1));
        filter = input.value.toLowerCase();
        list = document.getElementById(section + "List");
        items = list.getElementsByTagName("li");

        for (i = 0; i < items.length; i++) {
            txtValue = items[i].textContent || items[i].innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                items[i].style.display = "";
            } else {
                items[i].style.display = "none";
            }
        }
    }

    </script>

</body>
</html>
