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
<body>
    <div class="bg-cover grid h-screen object-center bg-gradient-to-l from-white from-65% to-violet-700 place-items-center min-h-screen">
        
        <div class="grid grid-cols-2 gap-4 h-5/6 w-11/12">
            <div class="grid grid-rows-3 grid-flow-col place-items-center pt-16 mt-[12vh]">
                <div class="w-9/12 h-5/6 pt-14"> <img src="{{ asset('img/autorepasse.png') }}" alt="Imagem AutoRepasse"> </div>
                <div class="w-9/12 h-4/6 text-2xl font-semibold leading-snug text-justify text-black-900 pt-7"><p> Encontre o veículo dos seus sonhos na AutoRepasse! Controle total de vendas com a garantia de qualidade e confiança que você merece.</p></div>
                <div class="w-9/12 h-5/6 text-1xl font-semibold leading-snug text-justify text-black-900 pt-7"> <button class="shadow-lg shadow-gray-600 px-4 py-2 bg-white text-violet-500 border-2 font-bold border-violet-500 rounded-lg hover:bg-gray-300 hover:text-violet-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" onclick="window.location.href='/'">Voltar</button> </div>
            </div>

            <div class="border-l-2 border-gray-400 grid-flow-col place-items-center">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm border-2 border-violet-500 rounded-lg mt-[25%] px-7 pb-7 row-span-3 mb-30 shadow-2xl shadow-gray-400"> 
                    <div class="mt-[2vh] mb-[2vh] py-2 block text-4xl font-bold leading-9 tracking-tight text-violet-500"><h1> Cadastre-se </h1></div>
                    <form action="{{url('/register')}}" method="POST">
                
                        @csrf
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('name')
                         <div style="color: red;">{{ $message }}</div>
                         @enderror
                
                        <label for="email" class="block text-sm font-medium text-gray-700 mt-3">Email</label>
                        <input type="text" name="email" value="{{ old('email') }}" id="email" required class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('email')
                         <div style="color: red;">{{ $message }}</div>
                         @enderror
                
                        <label for="password" class="block text-sm font-medium text-gray-700 mt-3">Senha</label>
                        <input type="password" name="password" value="{{ old('password') }}" id="password" required class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('password')
                        <div style="color: red;">{{ $message }}</div>
                        @enderror
                
                        <button class="w-full bg-violet-500 text-white py-2 font-bold rounded hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 mt-5">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</body>
</html>
