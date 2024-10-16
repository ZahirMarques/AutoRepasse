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
<body>

<div class="bg-cover grid h-screen object-center bg-gradient-to-r from-white from-65% to-violet-700 place-items-center min-h-screen">
    
    <div class="grid grid-cols-2 gap-4 h-5/6 w-11/12">
        <div class="border-gray-400 grid-flow-col place-items-center">

            <div class="ml-24 border-2 border-violet-500 rounded-lg px-7 pb-7 shadow-2xl shadow-gray-400"> 
                
                <div class="mt-[2vh] mb-[2vh] py-2 block text-4xl font-bold leading-9 tracking-tight text-violet-500"><h1> Cadastro de Veículos </h1></div>
                <form action="{{ url('veiculos/store') }}" method="post">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div>
                            {{-- Veiculo --}}
                            <label class="block text-sm font-medium text-gray-700">Veiculo: <b>*</b></label>
                            <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="veiculo" placeholder="Golf 2.0 Tsi Gti 16v Turbo Gasolina 4p Automático" value="{{ old('veiculo') }}"> <br>
                            @error('veiculo')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            {{-- Ano/Modelo --}}
                            <label class="block text-sm font-medium text-gray-700">Ano/Modelo: <b>*</b></label>
                            <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="ano_modelo" placeholder="aaaa" value="{{ old('ano_modelo') }}"> <br>
                            @error('ano_modelo')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            {{-- Placa --}}
                            <label class="block text-sm font-medium text-gray-700">Placa: <b>*</b></label>
                            <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="placa" placeholder="ABC-1111" value="{{ old('placa') }}"> <br>
                            @error('placa')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            {{-- Renavam --}}
                            <label class="block text-sm font-medium text-gray-700">Renavam: <b>*</b></label>
                            <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="renavam" placeholder="01234567890" value="{{ old('renavam') }}"> <br>
                            @error('renavam')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            {{-- Cor --}}
                            <label class="block text-sm font-medium text-gray-700">Cor: <b>*</b></label>
                            <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="cor" placeholder="Branco" value="{{ old('cor') }}"> <br>
                            @error('cor')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            {{-- Chassi --}}
                            <label class="block text-sm font-medium text-gray-700">Chassi:</label>
                            <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="chassi" value="{{ old('chassi') }}"> <br>
                            @error('chassi')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            {{-- Codigo de Segurança CRV --}}
                            <label class="block text-sm font-medium text-gray-700">Codigo Seg. CRV:</label>
                            <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="cod_seg_crv" value="{{ old('cod_seg_crv') }}"> <br>
                            @error('cod_seg_crv')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            {{-- Codigo de Segurança CLA --}}
                            <label class="block text-sm font-medium text-gray-700">Codigo Seg. CLA:</label>
                            <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="cod_seg_cla" value="{{ old('cod_seg_cla') }}"> <br>
                            @error('cod_seg_cla')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            {{-- CRV --}}
                            <label class="block text-sm font-medium text-gray-700">CRV:</label>
                            <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="crv" value="{{ old('crv') }}"> <br>
                            @error('crv')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            {{-- ATPVE --}}
                            <label class="block text-sm font-medium text-gray-700">ATPVE:</label>
                            <input class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="atpve" value="{{ old('atpve') }}"> <br>
                        </div>
                    </div>
                    <button class="w-full bg-violet-500 text-white py-2 font-bold rounded hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 mt-2">Adicionar Veículo</button> <br> <br>
                </form>
                @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
                @endif
                <button onclick="window.location.href='/veiculos/dashboard'" class="w-full bg-gray-500 text-white py-2 font-bold rounded hover:bg-gray-700">Voltar</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
