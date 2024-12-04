<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalhes do Cliente</title>
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

            <div class="group relative">
                <a href="{{ url('/veiculos/dashboard') }}" 
                   class="{{ request()->is('veiculos/*') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
                   Veículos
                </a>
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

            <div class="group relative">
                <a href="{{ url('/clientes/dashboard') }}" 
                   class="{{ request()->is('clientes/*') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
                   Clientes
                </a>
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
<div class="bg-cover grid place-items-center min-h-screen pt-24 from-white">
    <div class="max-w-3xl w-full px-6 py-4 bg-white rounded-lg shadow-xl">
        <h1 class="text-2xl font-bold text-center text-violet-600 mb-6">Informações do Cliente</h1>
        <h2 class="text-lg font-bold text-gray-700 mb-4">Nome: {{$cliente->nome}}</h2>
        <p><b>Cidade: </b> {{$cliente->cidade}}</p>
        <p><b>Estado:</b> {{$cliente->estado}}</p>
        <p><b>CPF:</b> {{$cliente->cpf}}</p>
        <p><b>CNPJ:</b> {{$cliente->cnpj}}</p>
        <p><b>Contato:</b> {{$cliente->contato}}</p>

        <div class="mt-6">
            <a href="{{ url('/clientes/dashboard') }}" class="py-2 px-4 bg-violet-600 text-white font-bold rounded hover:bg-violet-700">
                Voltar
            </a>
        </div>
    </div>
</div>

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
