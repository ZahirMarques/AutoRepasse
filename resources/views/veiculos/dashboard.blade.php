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
                       class="{{ request()->is('veiculos/dashboard') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
                       Veículos
                    </a>

                    <!-- Dropdown Menu -->
                    <div id="dropdownMenu" class="absolute left-0 hidden mt-2 space-y-2 bg-white border border-gray-300 rounded-lg shadow-lg opacity-0 transition-opacity duration-200">
                        <a href="{{ url('/veiculos/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-indigo-600">Veículos Cadastrados</a>
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
            <a href="{{ url('/veiculos/dashboard') }}" class="text-gray-700 hover:text-violet-500">Veículos</a>
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
    <div class="pt-24 min-h-screen flex justify-center items-start">
        <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg w-full lg:w-2/3">

            <h1 class="text-2xl font-bold text-center text-violet-600 mb-8">Veículos Cadastrados</h1>
            <button onclick="window.location.href='/veiculos/create'" 
                    class="px-6 py-2 bg-violet-600 text-white font-bold rounded-lg shadow-lg hover:bg-violet-700 mb-6">
                Cadastrar Novo Veículo
            </button>

            <div>
                <ul class="list-none p-0">
                    @if (count($veiculo) > 0)
                        @foreach ($veiculo as $veiculos)
                            <li class="mb-6 p-6 bg-white rounded-lg border-2 border-blue-500 hover:shadow-xl transition">
                                <div class="flex items-center space-x-6">
                                    <div class="w-36">
                                        <img src="{{ $veiculos->foto_url ?? '/path/to/default-image.jpg' }}" alt="Foto do Veículo" class="w-full h-auto object-cover rounded-lg">
                                    </div>
                                    <div class="flex-1 cursor-pointer" onclick="window.location.href='/veiculos/show/{{$veiculos->id}}'">
                                        <p class="text-xl font-semibold text-gray-700"><strong>Veículo:</strong> {{ $veiculos->veiculo }}</p>
                                        <p class="text-sm text-gray-600"><strong>Ano:</strong> {{ $veiculos->ano_modelo }}</p>
                                        <p class="text-sm text-gray-600"><strong>Placa:</strong> {{ $veiculos->placa }}</p>
                                        <p class="text-sm text-gray-600"><strong>Cor:</strong> {{ $veiculos->cor }}</p>
                                    </div>
                                    <div>
                                        <form action="/veiculos/edit/{{ $veiculos->id }}" method="get" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="px-4 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition">
                                                Editar
                                            </button>
                                        </form>
                                        <form action="/veiculos/destroy/{{ $veiculos->id }}" method="post" class="inline ml-2">
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
                        <p class="text-center text-gray-700">Você ainda não cadastrou nenhum veículo. <button onclick="window.location.href='/veiculos/create'" class="text-violet-500 underline">Cadastrar Veículo</button></p>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const menuToggle = document.getElementById('menuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const dropdownMenu = document.getElementById('dropdownMenu');
            const vehiclesLink = document.querySelector('a[href="{{ url('/veiculos/dashboard') }}"]').parentElement;

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
