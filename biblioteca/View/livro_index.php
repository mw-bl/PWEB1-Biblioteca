<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #379936;
            color: white;
            width: 100%;
            padding: 1rem;
            text-align: center;
            font-size: 1.5rem;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 4rem auto;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .button {
            display: inline-block;
            text-decoration: none;
            color: white;
            padding: 0.75rem 1.5rem;
            margin: 0.5rem;
            background-color: #379936;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
            font-size: 1rem;
            text-align: center;
            border: none;
            cursor: pointer;
        }

        .button:hover {
            background-color: #1b4c1b;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        @media (max-width: 768px) {
            .button {
                font-size: 0.9rem;
                padding: 0.5rem 1rem;
            }
        }

        @media (max-width: 480px) {
            .button {
                font-size: 0.8rem;
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">Livros</div>
    <div class="container">
        <h1>Gerenciar Livros</h1>
        <div class="button-container">
            <a href="cadastrar_livro.php" class="button">Cadastrar Novo Livro</a>
            <a href="listar_livros.php" class="button">Listar Livros</a>
        </div>
    </div>
</body>
</html>
