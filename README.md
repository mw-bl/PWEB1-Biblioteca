# Sistema de Biblioteca Online

## O que é / Objetivo do Projeto

O Sistema de Biblioteca Online é uma aplicação web desenvolvida para gerenciar livros, autores e empréstimos de uma biblioteca. O objetivo principal é permitir a administração de livros, registro de empréstimos e devoluções, e a visualização de livros emprestados e devolvidos.

## Tecnologias Usadas

- **HTML, CSS**: Para a construção do front-end e estilização das páginas.
- **PHP**: Para a implementação da lógica de negócios e interação com o banco de dados.
- **MySQL**: Para o gerenciamento do banco de dados.
- **XAMPP**: Para a criação de um ambiente de desenvolvimento local com Apache e MySQL.

## Dependências Necessárias

- **XAMPP**: Para rodar o servidor web Apache e o banco de dados MySQL localmente.
- **PHP 7.4 ou superior**: Necessário para a execução dos scripts PHP.
- **MySQL 5.7 ou superior**: Necessário para a criação e gerenciamento do banco de dados.

## Como Rodar a Aplicação

1. **Instalar XAMPP**:
   - Baixe e instale o XAMPP a partir do [site oficial](https://www.apachefriends.org/index.html).

2. **Configurar o Ambiente**:
   - Inicie o XAMPP e ative os módulos **Apache** e **MySQL**.

3. **Criar o Banco de Dados**:
   - Crie um novo banco de dados chamado `biblioteca`.
   - Importe o arquivo SQL com a estrutura e dados iniciais do banco de dados.

4. **Configurar o Projeto**:
   - Coloque os arquivos do projeto na pasta `htdocs` dentro do diretório de instalação do XAMPP `c:xampp/htdocs`.
   - Certifique-se de que o arquivo de configuração do banco de dados (`Database.php`) está corretamente configurado com as credenciais do MySQL.

5. **Acessar o Projeto**:
   - Abra o navegador e acesse `http://localhost/nome_da_pasta` para visualizar o sistema.

## Possíveis Problemas

- **Conexão com o Banco de Dados**: Verifique se as credenciais no arquivo `Database.php` estão corretas e se o MySQL está rodando.
- **Erros de PHP**: Certifique-se de que a versão do PHP é compatível com o código do projeto.
- **Problemas de Layout**: Se a página não estiver exibindo corretamente, verifique o CSS e a estrutura HTML.

## Próximos Passos

- **Melhorias**: Adicionar funcionalidades ao sistema de biblioteca.
- **Adicionar Autenticação**: Implementar um sistema de login para diferentes níveis de acesso (administrador, usuário).
- **Testes Automatizados**: Criar testes automatizados para garantir a qualidade e a estabilidade do sistema.
- **Documentação**: Expandir a documentação do projeto com exemplos de uso e instruções detalhadas para desenvolvedores.
