<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro Veiculo</title>
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
                <a href="{{ url('/veiculos/create') }}" 
                   class="{{ request()->is('veiculos/create') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
                   Veículos
                </a>

                <!-- Dropdown Menu -->
                <div id="dropdownMenu" class="absolute left-0 hidden mt-2 space-y-2 bg-white border border-gray-300 rounded-lg shadow-lg opacity-0 transition-opacity duration-200">
                    <a href="{{ url('/veiculos/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-indigo-600">Veículos Cadastrados</a>
                    {{-- <a href="{{ url('/veiculos/edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-indigo-600">Editar Veículos</a> --}}
                    <a href="{{ url('/veiculos/create') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-indigo-600">Cadastrar Veículo</a>
                </div>
            </div>

            <a href="{{ url('/vendas') }}" 
               class="{{ request()->is('vendas') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
               Vendas
            </a>
            <a href="{{ url('/pessoa/create') }}" 
               class="{{ request()->is('/pessoa/create') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
               Clientes
            </a>

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
        <a href="{{ url('/veiculos/create') }}" class="text-gray-700 hover:text-violet-500">Veículos</a>
        <a href="{{ url('/vendas') }}" class="text-gray-700 hover:text-violet-500">Vendas</a>
        <a href="{{ url('/pessoa/create') }}" class="text-gray-700 hover:text-violet-500">Clientes</a>
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

    <!-- Cadastro de Veículo Form -->
    <div class="max-w-3xl w-full px-6 py-4 bg-white rounded-lg shadow-xl">
        <h1 class="text-2xl font-bold text-center text-violet-600 mb-6">Cadastro de Veículos</h1>
        <form action="{{ url('veiculos/store') }}" method="post">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700">Veículo: <b>*</b></label>
                    <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="veiculo" placeholder="Golf 2.0 Tsi Gti 16v Turbo Gasolina 4p Automático" value="{{ old('veiculo') }}">
                    @error('veiculo')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Ano/Modelo: <b>*</b></label>
                    <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="ano_modelo" placeholder="aaaa" value="{{ old('ano_modelo') }}">
                    @error('ano_modelo')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Placa: <b>*</b></label>
                    <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="placa" placeholder="ABC-1111" value="{{ old('placa') }}">
                    @error('placa')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Renavam: <b>*</b></label>
                    <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="renavam" placeholder="01234567890" value="{{ old('renavam') }}">
                    @error('renavam')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Cor: <b>*</b></label>
                    <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="cor" placeholder="Branco" value="{{ old('cor') }}">
                    @error('cor')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Chassi:</label>
                    <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="chassi" value="{{ old('chassi') }}">
                    @error('chassi')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Código Seg. CRV:</label>
                    <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="cod_seg_crv" value="{{ old('cod_seg_crv') }}">
                    @error('cod_seg_crv')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Código Seg. CLA:</label>
                    <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="cod_seg_cla" value="{{ old('cod_seg_cla') }}">
                    @error('cod_seg_cla')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Combustível: <b>*</b></label>
                    <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="combustivel" placeholder="Gasolina" value="{{ old('combustivel') }}">
                    @error('combustivel')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Categoria: <b>*</b></label>
                    <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="categoria" placeholder="SUV" value="{{ old('categoria') }}">
                    @error('categoria')
                    <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button class="mt-6 w-full py-3 px-4 bg-violet-600 font-bold text-white rounded focus:outline-none hover:bg-violet-700">Cadastrar</button>
        </form>
    </div>
</div>

<script>
    (function() {
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const vehiclesLink = document.querySelector('a[href="{{ url('/veiculos/create') }}"]').parentElement;

        // Mobile Menu Toggle
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');
        });

        // Dropdown Menu
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
    })();
</script>

</body>
</html>