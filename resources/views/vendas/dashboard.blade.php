<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vendas Cadastradas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    <div class="pt-24 min-h-screen flex justify-center items-start">
        <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg w-full lg:w-2/3">

            <h1 class="text-2xl font-bold text-center text-[#5277ff] mb-8">Vendas Cadastradas</h1>

            <!-- Botão Cadastrar Nova Venda e Barra de Pesquisa -->
            <div class="flex justify-between items-center mb-6">
                <button onclick="window.location.href='/vendas/create'"
                        class="px-6 py-2 bg-[#5277ff] text-white font-bold rounded-lg shadow-lg hover:bg-[#3253CB]">
                    Cadastrar Nova Venda
                </button>

                <button onclick="window.print()"
                        class="px-6 py-2 border-2 border-[#5277ff] text-[#5277ff] font-bold rounded-lg shadow-lg hover:bg-gray-100 ml-2"> <!-- Adicionada margem à esquerda -->
                    Imprimir
                </button>

                <div class="relative w-2/3"> <!-- Aumentando a largura da barra de pesquisa -->
                    <input type="text" id="searchInput" class="w-full px-4 py-2 border rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#5277ff]"
                        placeholder="Pesquisar por venda..." onkeyup="searchVendas()">
                </div>
            </div>

            @if(session('success'))
                <div id="success-message" class="bg-green-100 text-green-700 border border-green-300 p-4 mb-4 rounded flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                </div>

                <script>
                    setTimeout(function() {
                        document.getElementById('success-message').style.display = 'none';
                    }, 5000);
                </script>
            @endif

            <div>
                <ul class="list-none p-0">
                    @if (isset($vendas) && count($vendas) > 0)
                        @foreach ($vendas as $venda)
                            <li class="mb-6 p-6 bg-white rounded-lg border-2 border-[#5277ff] hover:shadow-xl transition">
                                <div class="flex items-center space-x-6">
                                    <div class="flex-1 cursor-pointer" onclick="window.location.href='/vendas/show/{{$venda->id}}'">
                                        <p class="text-xl font-semibold text-gray-700"><strong>Venda ID:</strong> {{ $venda->id }}</p>
                                        <p class="text-sm text-gray-600"><strong>Cliente:</strong> {{ $venda->cliente->nome }}</p>
                                        <p class="text-sm text-gray-600"><strong>Veículo:</strong> {{ $venda->veiculo->marca }} {{ $venda->veiculo->modelo }}</p>
                                        <p class="text-sm text-gray-600"><strong>Tipo:</strong> {{ $venda->tipo ?? 'N/A' }}</p>
                                        <p class="text-sm text-gray-600"><strong>Financiamento:</strong> {{ $venda->financiamento ? 'Sim' : 'Não' }}</p>
                                    </div>
                                    <div>
                                        <form action="/vendas/destroy/{{ $venda->id }}" method="post" class="inline ml-2" onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-4 py-2 text-red-600 bg-white border-2 border-red-600 font-bold rounded-lg hover:bg-red-600 hover:text-white transition">
                                                Deletar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <p class="text-center text-gray-700">Nenhuma venda cadastrada no momento.</p>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <footer class="bg-white border-t-2 border-gray-300 text-black py-4 mt-6">
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

    function searchVendas() {
        var input, filter, list, items, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toLowerCase();
        list = document.querySelector(".list-none");
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

    function confirmDelete() {
        return confirm('Tem certeza que deseja deletar esta venda?');
    }

    </script>


</body>
</html>
