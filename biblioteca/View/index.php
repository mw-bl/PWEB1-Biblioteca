<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilo global */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        /* Estilo da navbar */
        .navbar {
            background-color: #007bff; /* Cor azul */
            color: white;
            width: 100%;
            padding: 1rem;
            text-align: center;
            font-size: 1.5rem;
            position: fixed; /* Fixa a navbar no topo */
            top: 0;
            left: 0;
            z-index: 1000; /* Garante que a navbar fique acima do restante do conteúdo */
        }

        /* Estilo do contêiner */
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 1440px; /* Largura fixa */
            height: 1024px; /* Altura fixa */
            margin: 4rem auto 0 auto; /* Margem superior para compensar a navbar fixa */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Estilo dos links */
        .button {
            display: inline-block;
            text-decoration: none;
            color: white;
            padding: 0.75rem 1.5rem;
            margin: 0.5rem;
            background-color: #007bff; /* Cor azul */
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            font-size: 1rem;
            text-align: center;
        }

        /* Efeito ao passar o mouse */
        .button:hover {
            background-color: #0056b3; /* Azul mais escuro para hover */
        }

        /* Estilo dos botões em linha */
        .button-container {
            display: flex;
            flex-wrap: wrap; /* Permite que os botões quebrem para a linha seguinte em telas menores */
            justify-content: center;
            padding: 1rem;
        }

        /* Estilos responsivos */
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
            <a href="cadastrar_autor.php" class="button">Cadastrar Novo Autor</a>
            <a href="cadastrar_livro.php" class="button">Cadastrar Novo Livro</a>
            <a href="cadastrar_estudante.php" class="button">Cadastrar Novo Estudante</a>
            <a href="listar_autores.php" class="button">Listar Autores</a>
            <a href="listar_livros.php" class="button">Listar Livros</a>
            <a href="listar_estudantes.php" class="button">Listar Estudantes</a>
            <a href="devolver_livro.php" class="button">Devolver Livro</a>
            <a href="emprestar_livro.php" class="button">Emprestar Livro</a>
            <a href="livros_emprestados.php" class="button">Livros Emprestados</a>
        </div>
    </div>
</body>
</html>
