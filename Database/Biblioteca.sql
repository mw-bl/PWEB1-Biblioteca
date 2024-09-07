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
    ano INT NOT NULL,
    autor_id INT,
    FOREIGN KEY (autor_id) REFERENCES autor(id)
);

CREATE TABLE estudante (
    idEstudante INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE biblioteca (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livro_id INT,
    estudante_id INT,
    data_emprestimo DATE NOT NULL,
    data_devolucao DATE,
    FOREIGN KEY (livro_id) REFERENCES livro(id),
    FOREIGN KEY (estudante_id) REFERENCES estudante(id)
);
