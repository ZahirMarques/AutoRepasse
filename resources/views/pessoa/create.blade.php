<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de Pessoas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function formatCPF(input) {
            let value = input.value.replace(/\D/g, ''); // Remove tudo que não é número

            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{2})$/, '$1-$2');
            }

            input.value = value;
        }

        


        function formatContato(input) {
            let value = input.value.replace(/\D/g, ''); // Remove tudo que não é número

            // Formata o contato como (XX) XXXXX-XXXX
            if (value.length <= 11) {
                if (value.length > 6) {
                    value = value.replace(/(\d{2})(\d{5})(\d)/, '($1) $2-$3');
                } else if (value.length > 2) {
                    value = value.replace(/(\d{2})(\d)/, '($1) $2');
                }
            }
            input.value = value;
        }


       
    </script>
</head>

<body>

    <div class="bg-emerald-600 w-screen h-screen">

        <div class=" w-10/12 h-4/5">
            <div class="bg-gray-300">
                <h1>Cadastrar Pessoas</h1>
            </div>

            <div class="bg-orange-200">
                <form action="{{url('/pessoa/store')}}" method="post">

                    @csrf

                    <label for="nome">Nome</label>
                    <input type="text" name="nome">

                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade">

                    <label for="estado">Estado</label>
                    <input type="text" name="estado">

                    <label for="cpf">CPF</label>
                    <input type="numeric" name="cpf" oninput="formatCPF(this)" maxlength="14" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">

                    <label for="cnpj">CNPJ</label>
                    <input type="numeric" name="cnpj" oninput="formatCNPJ(this)" maxlength="18" pattern="\d{2}\.\d{3}\.\d{3}/\d{4}-\d{2}">

                    <label for="contato">Contato</label>
                    <input type="numeric" name="contato" oninput="formatContato(this)" maxlength="15" required pattern="\d+">

                    <button>Enviar</button>

                </form>
            </div>

            <div class="bg-lime-200">
                <button onclick="window.location.href='/pessoa/dashboard'">Voltar</button>
            </div>
        </div>
    </div>

</body>

</html>