<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <div class="bg-cover grid h-screen object-center bg-gradient-to-l from-white from-65% to-violet-700 place-items-center min-h-screen">
        <div class="grid grid-cols-2 gap-4 h-5/6 w-11/12"> 
            
            <div class="grid grid-rows-3 grid-flow-col place-items-center mt-[16vh]">
                <div class="w-9/12 h-4/6"> <img src="{{ asset('img/autorepasse.png') }}" alt="Imagem AutoRepasse"> </div>
                <div class="w-9/12 h-4/6 text-2xl font-semibold leading-snug text-justify text-black-900"><p>Cadastre-se agora na AutoRepasse e transforme sua concessionária com a melhor solução em gestão de vendas automotivas, garantindo eficiência, produtividade e agilidade na busca de informações.</p></div>
                <div class="w-9/12 h-2/6 mb-[13vh]"><button class="shadow-lg shadow-gray-600 px-4 py-2 bg-white text-violet-500 border-2 font-bold border-violet-500 rounded-lg hover:bg-violet-700 hover:text-white focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" onclick="window.location.href='/register'">Cadastre-se</button></div>
            </div>
        
            <div class="border-l-2 border-gray-400 grid-flow-col place-items-center">
                <div class="mt-[23%] text-center text-4xl font-bold leading-9 tracking-tight text-violet-500 pt-12"><h1>Já possui uma conta?</h1></div>
                <div class="sm:mx-auto sm:w-full sm:max-w-sm border-2 border-violet-500 rounded-lg mt-12 px-7 py-7 row-span-3 mb-30 shadow-2xl shadow-gray-400">

                    <form action="{{url('/login')}}" method="POST">            
                    @csrf

                    <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" name="email" required class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Digite seu email"><br>
                    </div>

                    <div> 
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" name="password" id="password" required class="mt-1 block w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Digite sua senha"><br>
                    </div>

                    <button class="w-full bg-violet-500 text-white py-2 font-bold rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"> Login</button>
                    </form>

                </div> 

            </div>
        </div>
    </div>  
</body>
</html>