<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
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
            margin: 4rem auto;
            max-width: 1200px;
            padding: 2rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .button {
            display: inline-block;
            text-decoration: none;
            color: white;
            padding: 0.75rem 1.5rem;
            margin: 0.5rem;
            background-color: #379936;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            font-size: 1rem;
            text-align: center;
        }

        .button:hover {
            background-color: #1b4c1b;
        }

        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 1rem;
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
    <div class="navbar">Biblioteca IFCE</div>
    <div class="container">
        <div class="button-container">
            <a href="autor_index.php" class="button">Autores</a>
            <a href="livro_index.php" class="button">Livros</a>
            <a href="estudante_index.php" class="button">Estudantes</a>
            <a href="emprestimo_index.php" class="button">Empréstimos</a>
        </div>
    </div>
</body>
</html>
