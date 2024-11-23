{{-- resources/views/errors/500.blade.php --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro no Servidor</title>
    <style>
        body {

            text-align: center;

            background-color: #fff;
            color: #636b6f;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: bold;
            height: 100vh;
            margin: 0;
        }

        .custom-button {
            padding: 10px 20px;
            background-color: #6366f1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            /* Transição suave ao trocar a cor */
        }

        .custom-button:hover {
            background-color: #4338ca;
            /* Cor ao passar o mouse */
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 36px;
            padding: 20px;
        }

        h1 {
            font-size: 50px;
        }

        p {
            font-size: 20px;
        }
    </style>
</head>

<body>



    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title">
                @yield('message')

                <h1>Erro no Servidor</h1>
                <p>Desculpe, algo deu errado com o servidor.</p>
                <p>Verifique se o XAMPP está sendo executado</p>


                <div>

                    <button class="custom-button" onclick="window.location.href='/'">
                        Ir para a página inicial
                    </button>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
