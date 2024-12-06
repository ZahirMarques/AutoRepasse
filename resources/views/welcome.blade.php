<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>AutoRepasse</title>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-6 border-b-2 fixed top-0 left-0 w-full z-10">
        <div class="container mx-auto px-4 flex flex-wrap items-center justify-center">
            <!-- Logo -->
            <div class="flex items-center absolute left-4">
                <img src="{{ asset('img/auto.png') }}" alt="Imagem AutoRepasse" class="w-20 h-12">
            </div>

            <!-- Navigation Links -->
            <div class="flex items-center space-x-8 text-base font-semibold text-gray-700 md:flex hidden">
                <a href="{{ url('/dashboard') }}" 
                   class="{{ request()->is('dashboard') ? 'text-[#5277ff] text-lg' : 'text-gray-500 text-sm' }} hover:text-[#5277ff]">
                   Dashboard
                </a>
                <a href="{{ url('/veiculos/dashboard') }}" 
                   class="{{ request()->is('veiculos') ? 'text-[#5277ff] text-lg' : 'text-gray-500 text-sm' }} hover:text-[#5277ff]">
                   Veículos
                </a>
                <a href="{{ url('/vendas/dashboard') }}" 
                   class="{{ request()->is('vendas') ? 'text-[#5277ff] text-lg' : 'text-gray-500 text-sm' }} hover:text-[#5277ff]">
                   Vendas
                </a>
                <a href="{{ url('/clientes/dashboard') }}" 
                   class="{{ request()->is('clientes') ? 'text-[#5277ff] text-lg' : 'text-gray-500 text-sm' }} hover:text-[#5277ff]">
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

                            @if (session('message'))
                    <div id="alert" class="alert alert-warning bg-yellow-100 text-yellow-700 border border-yellow-300 p-4 mb-4 rounded flex justify-between items-center">
                        {{ session('message') }}
                    </div>

                    <script>
                        // Fazer a mensagem desaparecer automaticamente após 10 segundos
                        setTimeout(function() {
                            document.getElementById('alert').style.display = 'none';
                        }, 5000);
                    </script>
                @endif
            <!-- Content Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- Left Section -->
                <div class="text-center space-y-6">
                    <img src="{{ asset('img/auto.png') }}" alt="Imagem AutoRepasse" class="mx-auto w-8/12">
                    <p class="text-sg font-semibold leading-snug text-gray-800">
                        Cadastre-se agora na AutoRepasse e transforme sua concessionária com a melhor solução em gestão de vendas automotivas, garantindo eficiência, produtividade e agilidade na busca de informações.
                    </p>
                    <button class="px-6 py-3 bg-[#5277ff] text-white font-bold rounded-lg hover:bg-[#3253CB]" onclick="window.location.href='/register'">
                        Cadastre-se
                    </button>
                </div>

                <!-- Right Section -->
                <div class="flex flex-col items-center border-l-2 border-gray-300 px-8">
                    <h1 class="text-3xl font-bold text-[#5277ff] mb-8">Já possui uma conta?</h1>
                    <div class="w-full max-w-sm bg-white border-2 border-[#3253CB] rounded-lg px-6 py-6 shadow-xl">
                        <form action="{{url('/login')}}" method="POST" class="space-y-4">
                            @csrf
                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" required class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Digite seu email">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                                <input type="password" name="password" required class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Digite sua senha">
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Login Button -->
                            <button class="w-full bg-[#5277ff] text-white py-2 font-bold rounded hover:bg-[#3253CB]">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer class="border-t-2 border-gray-300 bg-white text-black py-4 fixed bottom-0 w-full">
        <div class="container mx-auto text-center">
            <p class="text-sm">© 2024 Sistema de Venda de Veículos. Todos os direitos reservados.</p>
        </div>
    </footer>

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
