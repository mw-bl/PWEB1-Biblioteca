CREATE DATABASE Biblioteca;
USE Biblioteca;

CREATE TABLE autor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    nacionalidade VARCHAR(100) NOT NULL
);

CREATE TABLE livro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    ano INT,
    autor INT,
    FOREIGN KEY (autor) REFERENCES autor(id) ON DELETE SET NULL
);

CREATE TABLE estudante (
    idEstudante INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE emprestimo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idLivro INT NOT NULL,
    idEstudante INT NOT NULL,
    dataEmprestimo DATE NOT NULL,
    dataDevolucao DATE DEFAULT NULL,
    FOREIGN KEY (idLivro) REFERENCES livro(id),
    FOREIGN KEY (idEstudante) REFERENCES estudante(idEstudante),
    CHECK (dataDevolucao IS NULL OR dataDevolucao >= dataEmprestimo)
);


-- Autores
INSERT INTO autor (nome, nacionalidade) VALUES ('Jorge Amado', 'Brasileiro');
INSERT INTO autor (nome, nacionalidade) VALUES ('Gabriel García Márquez', 'Colombiano');
INSERT INTO autor (nome, nacionalidade) VALUES ('Machado de Assis', 'Brasileiro');
INSERT INTO autor (nome, nacionalidade) VALUES ('Miguel de Cervantes', 'Espanhol');

-- Livros
INSERT INTO livro (titulo, ano, autor) VALUES ('Capitães da Areia', 1937, 1);
INSERT INTO livro (titulo, ano, autor) VALUES ('Cem Anos de Solidão', 1967, 2);
INSERT INTO livro (titulo, ano, autor) VALUES ('Dom Casmurro', 1899, 3);
INSERT INTO livro (titulo, ano, autor) VALUES ('Dom Quixote', 1605, 4);

-- Estudantes
INSERT INTO estudante (nome) VALUES ('Maria Silva');
INSERT INTO estudante (nome) VALUES ('João Souza');
INSERT INTO estudante (nome) VALUES ('Ana Costa');
INSERT INTO estudante (nome) VALUES ('Pedro Almeida');


-- Registros de empréstimos
INSERT INTO emprestimo (idLivro, idEstudante, dataEmprestimo, dataDevolucao)
VALUES (1, 1, CURDATE(), NULL); -- Livro emprestado e ainda não devolvido
INSERT INTO emprestimo (idLivro, idEstudante, dataEmprestimo, dataDevolucao)
VALUES (2, 2, CURDATE(), '2024-09-10'); -- Livro emprestado e devolvido
INSERT INTO emprestimo (idLivro, idEstudante, dataEmprestimo, dataDevolucao)
VALUES (3, 3, CURDATE(), NULL); -- Livro emprestado e ainda não devolvido
INSERT INTO emprestimo (idLivro, idEstudante, dataEmprestimo, dataDevolucao)
VALUES (4, 4, CURDATE(), NULL); -- Livro emprestado e ainda não devolvido

