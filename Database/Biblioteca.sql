
CREATE DATABASE IF NOT EXISTS Biblioteca;
USE Biblioteca;


CREATE TABLE IF NOT EXISTS Autor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    nacionalidade VARCHAR(100)
);


CREATE TABLE IF NOT EXISTS Livro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor_id INT,
    ano YEAR,
    genero VARCHAR(100),
    FOREIGN KEY (autor_id) REFERENCES Autores(id)
);


CREATE TABLE IF NOT EXISTS Estudante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    matricula VARCHAR(100) UNIQUE,
    curso VARCHAR(100)
);


CREATE TABLE IF NOT EXISTS Emprestimos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livro_id INT,
    estudante_id INT,
    data_emprestimo DATE,
    data_devolucao DATE,
    FOREIGN KEY (livro_id) REFERENCES Livros(id),
    FOREIGN KEY (estudante_id) REFERENCES Estudantes(id)
);


INSERT INTO Autores (nome, nacionalidade) VALUES
('J.K. Rowling', 'Britânica'),
('George Orwell', 'Britânico'),
('J.R.R. Tolkien', 'Britânico');

INSERT INTO Livros (titulo, autor_id, ano_publicacao, genero) VALUES
('Harry Potter e a Pedra Filosofal', 1, 1997, 'Fantasia'),
('1984', 2, 1949, 'Distopia'),
('O Senhor dos Anéis', 3, 1954, 'Fantasia');

INSERT INTO Estudantes (nome, matricula, curso) VALUES
('Ana Silva', '20240001', 'Engenharia'),
('Pedro Santos', '20240002', 'Matemática'),
('Maria Oliveira', '20240003', 'Sistemas');

INSERT INTO Emprestimos (livro_id, estudante_id, data_emprestimo, data_devolucao) VALUES
(1, 1, '2024-08-01', NULL), -- Empréstimo sem devolução ainda
(2, 2, '2024-08-10', '2024-08-20'), -- Empréstimo já devolvido
(3, 3, '2024-08-15', NULL); -- Empréstimo sem devolução ainda

SELECT * FROM Emprestimos;