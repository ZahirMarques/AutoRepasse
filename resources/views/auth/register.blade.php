<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-6 border-b-2 fixed top-0 left-0 w-full z-10">
        <div class="container mx-auto px-4 flex flex-wrap items-center justify-center">
            <!-- Logo -->
            <div class="flex items-center absolute left-4">
                <img src="{{ asset('img/autorepasse.png') }}" alt="Imagem AutoRepasse" class="w-26 h-8">
            </div>

            <!-- Navigation Links -->
            <div class="flex items-center space-x-8 text-base font-semibold text-gray-700 md:flex hidden">
                <a href="{{ url('/dashboard') }}" 
                   class="{{ request()->is('dashboard') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
                   Dashboard
                </a>
                <a href="{{ url('/veiculos') }}" 
                   class="{{ request()->is('veiculos') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
                   Veículos
                </a>
                <a href="{{ url('/vendas') }}" 
                   class="{{ request()->is('vendas') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
                   Vendas
                </a>
                <a href="{{ url('/clientes') }}" 
                   class="{{ request()->is('clientes') ? 'text-blue-500 text-lg' : 'text-gray-500 text-sm' }} hover:text-violet-500">
                   Clientes
                </a>
            </div>

            <!-- Mobile Menu Toggle (positioned on the right for mobile view) -->
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
            <a href="{{ url('/veiculos') }}" class="text-gray-700 hover:text-violet-500">Veículos</a>
            <a href="{{ url('/vendas') }}" class="text-gray-700 hover:text-violet-500">Vendas</a>
            <a href="{{ url('/clientes') }}" class="text-gray-700 hover:text-violet-500">Clientes</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-grow flex items-center justify-center px-4 pt-28"> <!-- pt-28 para compensar a navbar fixa -->
        <div class="bg-white shadow-2xl rounded-lg max-w-6xl w-full mx-4 p-8 flex flex-col space-y-8">

            <!-- Content Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- Left Section -->
                <div class="text-center space-y-6">
                    <img src="{{ asset('img/autorepasse.png') }}" alt="Imagem AutoRepasse" class="mx-auto w-10/12">
                    <p class="text-sg font-semibold leading-snug text-gray-800">
                        Encontre o veículo dos seus sonhos na AutoRepasse! Controle total de vendas com a garantia de qualidade e confiança que você merece.
                    </p>
                    <button class="px-6 py-3 bg-violet-500 text-white font-bold rounded-lg hover:bg-violet-700 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" onclick="window.location.href='/'">
                        Voltar
                    </button>
                </div>

                <!-- Right Section -->
                <div class="flex flex-col items-center border-l-2 border-gray-300 px-8">
                    <h1 class="text-3xl font-bold text-violet-500 mb-8">Cadastre-se</h1>
                    <div class="w-full max-w-sm bg-white border-2 border-violet-500 rounded-lg px-6 py-6 shadow-xl">
                        <form action="{{url('/register')}}" method="POST" class="space-y-2">
                            @csrf
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                                <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                                <input type="password" name="password" required class="mb-2 mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button class="w-full bg-violet-500 text-white py-2 font-bold rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Enviar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Toggle Mobile Menu Script -->
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</body>

</html>
