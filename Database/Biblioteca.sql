CREATE DATABASE Biblioteca;
USE Biblioteca;

-- Tabela Autor
CREATE TABLE Autor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    nacionalidade VARCHAR(100)
);

-- Tabela Livro
CREATE TABLE Livro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    ano YEAR,
    genero VARCHAR(100),
    autor_id INT,
    FOREIGN KEY (autor_id) REFERENCES Autor(id) 
        ON DELETE SET NULL 
        ON UPDATE CASCADE
);

-- Tabela Estudante
CREATE TABLE Estudante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    matricula VARCHAR(100) UNIQUE,
    curso VARCHAR(100)
);

-- Tabela Emprestimos
CREATE TABLE Emprestimos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livro_id INT,
    estudante_id INT,
    data_emprestimo DATE NOT NULL,
    data_devolucao DATE DEFAULT NULL,
    FOREIGN KEY (livro_id) REFERENCES Livro(id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    FOREIGN KEY (estudante_id) REFERENCES Estudante(id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
);


INSERT INTO Autor (nome, nacionalidade) VALUES
('J.K. Rowling', 'Britânica'),
('George Orwell', 'Britânico'),
('J.R.R. Tolkien', 'Britânico');

INSERT INTO Livro (titulo, ano, autor_id, genero) VALUES
('Harry Potter e a Pedra Filosofal', 1997, 1, 'Fantasia'),
('1984', 1949, 2, 'Distopia'),
('O Senhor dos Anéis', 1954, 3, 'Fantasia');

INSERT INTO Estudante (nome, matricula, curso) VALUES
('Ana Silva', '20240001', 'Engenharia'),
('Pedro Santos', '20240002', 'Matemática'),
('Maria Oliveira', '20240003', 'Sistemas');

INSERT INTO Emprestimos (livro_id, estudante_id, data_emprestimo, data_devolucao) VALUES
(1, 1, '2024-08-01', NULL), -- Empréstimo sem devolução ainda
(2, 2, '2024-08-10', '2024-08-20'), -- Empréstimo já devolvido
(3, 3, '2024-08-15', NULL); -- Empréstimo sem devolução ainda