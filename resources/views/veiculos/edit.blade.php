<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Veículo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                    function formatAno_Modelo(input) {
                let value = input.value.replace(/\D/g, ''); // Remove qualquer caractere não numérico

                // Limita a quantidade de caracteres a 8
                if (value.length > 8) {
                    value = value.substring(0, 8);
                }

                // Adiciona a barra entre os dois grupos de 4 números
                if (value.length > 4) {
                    value = value.replace(/(\d{4})(\d{0,4})$/, '$1/$2');
                }

                input.value = value;
            }

            function formatPlaca(input) {
                let value = input.value.replace(/\W/g, ''); // Remove caracteres não alfanuméricos

                // Converte as letras para maiúsculas
                value = value.toUpperCase();

                // Limita o valor a 7 caracteres
                if (value.length > 7) {
                    value = value.substring(0, 7);
                }

                // Formata o valor como "ABC-1234"
                if (value.length > 3) {
                    value = value.replace(/(\w{3})(\w{0,4})$/, '$1-$2');
                }

                input.value = value;
            }
    </script>

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
                       class="{{ request()->is('veiculos/*') ? 'text-[#5277ff] text-lg' : 'text-gray-500 text-sm' }} hover:text-[#5277ff]">
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
                    class="{{ request()->is('clientes/*') ? 'text-[#5277ff] text-lg' : 'text-gray-500 text-sm' }} hover:text-[#5277ff]">
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
<div class="bg-cover grid place-items-center min-h-screen pt-24 from-white">

    <!-- Formulário de Edição -->
    <div class="max-w-3xl w-full px-6 py-4 bg-white rounded-lg shadow-xl">
    <h1 class="text-2xl font-bold text-center text-[#5277ff] mb-6">Editar Veículo</h1>
    <form action="/veiculos/update/{{$veiculo->id}}" method="post">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Marca: <b>*</b></label>
                <input 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" 
                    type="text" 
                    name="marca" 
                    placeholder="Volkswagen" 
                    value="{{ $veiculo->marca }}"
                >
                @error('marca')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Modelo: <b>*</b></label>
                <input 
                    class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" 
                    type="text" 
                    name="modelo" 
                    placeholder="Golf 2.0 Tsi Gti 16v Turbo Gasolina 4p Automático" 
                    value="{{ $veiculo->modelo }}"
                >
                @error('modelo')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Ano/Modelo: <b>*</b></label>
                <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="ano_modelo" placeholder="2010/2011" oninput="formatAno_Modelo(this)" value="{{ $veiculo->ano_modelo }}">
                @error('ano_modelo')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Placa: <b>*</b></label>
                <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="placa" oninput="formatPlaca(this)" placeholder="ABC-1111" value="{{ $veiculo->placa }}">
                @error('placa')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Renavam: <b>*</b></label>
                <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="renavam" placeholder="01234567890" maxlength="11" value="{{ $veiculo->renavam }}">
                @error('renavam')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Cor: <b>*</b></label>
                <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="cor" placeholder="Branco" value="{{ $veiculo->cor }}">
                @error('cor')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Chassi:</label>
                <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="chassi" maxlength="17" placeholder="12345678910111213" value="{{ $veiculo->chassi }}">
                @error('chassi')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">ATPVE:</label>
                <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="atpve" placeholder="Código ATPVE" maxlength="7" value="{{ $veiculo->atpve }}">
                @error('atpve')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">CRV:</label>
                <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="crv" placeholder="Número do CRV" maxlength="11" value="{{ $veiculo->crv }}">
                @error('crv')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Código Seg. CRV:</label>
                <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="cod_seg_crv" maxlength="11" placeholder="12345678910" value="{{ $veiculo->cod_seg_crv }}">
                @error('cod_seg_crv')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">CLA:</label>
                <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="cla" maxlength="7" placeholder="1234567" value="{{ $veiculo->cla }}">
                @error('cla')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Código Seg. CLA:</label>
                <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" type="text" name="cod_seg_cla"  maxlength="6" placeholder="123456" value="{{ $veiculo->cod_seg_cla }}">
                @error('cod_seg_cla')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Combustível: <b>*</b></label>
                <select class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" name="combustivel" required>
                    <option value="" disabled selected>Selecione</option>
                    <option value="Gasolina" {{ (isset($veiculo) && $veiculo->combustivel == 'Gasolina') ? 'selected' : '' }}>Gasolina</option>
                    <option value="Diesel" {{ (isset($veiculo) && $veiculo->combustivel == 'Diesel') ? 'selected' : '' }}>Diesel</option>
                    <option value="Flex" {{ (isset($veiculo) && $veiculo->combustivel == 'Flex') ? 'selected' : '' }}>Flex</option>
                    <option value="Híbrido" {{ (isset($veiculo) && $veiculo->combustivel == 'Híbrido') ? 'selected' : '' }}>Híbrido</option>
                    <option value="Álcool" {{ (isset($veiculo) && $veiculo->combustivel == 'Álcool') ? 'selected' : '' }}>Álcool</option>
                    <option value="Elétrico" {{ (isset($veiculo) && $veiculo->combustivel == 'Elétrico') ? 'selected' : '' }}>Elétrico</option>
                </select>
                @error('combustivel')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Categoria: <b>*</b></label>
                <select class="mt-1 block w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-white text-sm" name="categoria" required>
                    <option value="" disabled selected>Selecione</option>
                    <option value="SUV" {{ (isset($veiculo) && $veiculo->categoria == 'SUV') ? 'selected' : '' }}>SUV</option>
                    <option value="Hatch" {{ (isset($veiculo) && $veiculo->categoria == 'Hatch') ? 'selected' : '' }}>Hatch</option>
                    <option value="Sedã" {{ (isset($veiculo) && $veiculo->categoria == 'Sedã') ? 'selected' : '' }}>Sedã</option>
                    <option value="Picape" {{ (isset($veiculo) && $veiculo->categoria == 'Picape') ? 'selected' : '' }}>Picape</option>
                    <option value="Esportivo" {{ (isset($veiculo) && $veiculo->categoria == 'Esportivo') ? 'selected' : '' }}>Esportivo</option>
                    <option value="Minivan" {{ (isset($veiculo) && $veiculo->categoria == 'Minivan') ? 'selected' : '' }}>Minivan</option>
                    <option value="Outro" {{ (isset($veiculo) && $veiculo->categoria == 'Outro') ? 'selected' : '' }}>Outro</option>
                </select>
                @error('categoria')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>
        </div>

    <button class="mt-6 w-full py-3 px-4 bg-[#5277ff] font-bold text-white rounded focus:outline-none hover:bg-[#3253CB]">
        Salvar Alterações
    </button>

</div>
</div>

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

    </script>

</body>
</html>
