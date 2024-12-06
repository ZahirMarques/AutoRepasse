<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Cliente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function formatCPF(input) {
            let value = input.value.replace(/\D/g, '');

            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{2})$/, '$1-$2');
            }

            input.value = value;
        }

        function formatContato(input) {
            let value = input.value.replace(/\D/g, '');

            if (value.length <= 11) {
                if (value.length > 6) {
                    value = value.replace(/(\d{2})(\d{5})(\d)/, '($1) $2-$3');
                } else if (value.length > 2) {
                    value = value.replace(/(\d{2})(\d)/, '($1) $2');
                }
            }

            input.value = value;
        }

        function formatEstado(input) {
            let value = input.value.replace(/[^A-Za-z]/g, ''); // Remove qualquer coisa que não seja letra

            // Limita a string a 2 caracteres e transforma em maiúsculas
            value = value.slice(0, 2).toUpperCase();

            input.value = value;
        }

        function formatCNPJ(input) {
            // Remove todos os caracteres não numéricos
            let value = input.value.replace(/\D/g, '');

            // Aplica a formatação de CNPJ
            if (value.length <= 14) {
                value = value.replace(/^(\d{2})(\d)/, '$1.$2'); // Primeira parte
                value = value.replace(/^(\d{2}\.\d{3})(\d)/, '$1.$2'); // Segunda parte
                value = value.replace(/^(\d{2}\.\d{3}\.\d{3})(\d)/, '$1/$2'); // Terceira parte
                value = value.replace(/^(\d{2}\.\d{3}\.\d{3}\/\d{4})(\d{2})$/, '$1-$2'); // Quarta parte
            }

            // Atualiza o valor do input com o formato
            input.value = value;
        }


    </script>
    
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
<div class="bg-cover grid place-items-center min-h-screen pt-24 from-white">

    <!-- Formulário de Edição -->
    <div class="max-w-3xl w-full px-6 py-4 bg-white rounded-lg shadow-xl">
        <h1 class="text-2xl font-bold text-center text-violet-600 mb-6">Editar Cliente</h1>
        <form action="/clientes/update/{{$cliente->id}}" method="post">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nome:</label>
                    <input type="text" name="nome" oninput="formatNome(this)" value="{{$cliente->nome}}" class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Cidade:</label>
                    <input type="text" name="cidade" oninput="formatCidade(this)" value="{{$cliente->cidade}}" class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Estado:</label>
                    <input type="text" name="estado" oninput="formatEstado(this)" value="{{$cliente->estado}}" class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">CPF:</label>
                    <input type="text" name="cpf" oninput="formatCPF(this)" maxlength="14" value="{{$cliente->cpf}}" class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm">
                    @error('cpf')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror  
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">CNPJ:</label>
                    <input type="text" name="cnpj" oninput="formatCNPJ(this)" maxlength="18" value="{{$cliente->cnpj}}" class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Contato:</label>
                    <input type="text" name="contato" oninput="formatContato(this)" maxlength="15"6 value="{{$cliente->contato}}" class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm">
                </div>
            </div>

            <button class="mt-6 w-full py-3 px-4 bg-violet-600 font-bold text-white rounded focus:outline-none hover:bg-violet-700">
                Salvar Alterações
            </button>
        </form>
    </div>
</div>

<footer class="bg-violet-600 text-white py-4 fixed bottom-0 w-full">
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
