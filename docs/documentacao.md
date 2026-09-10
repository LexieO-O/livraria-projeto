# Documentação - Sistema de Gerenciamento de Livros (Livraria)

## 1. Objetivo

Sistema web simples para cadastrar e listar os livros do acervo de uma livraria, desenvolvido como trabalho em grupo para a displina de Desenvolvimento Web 2 (versionamento com Git/GitHub).


## 2. Estrutura do projeto

livraria-projeto/
├── frontend/
│   ├── index.html → página inicial
│   ├── livros.html → cadastro e listagem de livros
│   └── css/
│       └── estilo.css → estilização das páginas
├── backend/
│   ├── conexao.php → conexão PDO com o MySQL
│   ├── cadastrar_livro.php → endpoint para inserir um livro (POST)
│   └── listar_livros.php → endpoint que retorna os livros em JSON (GET)
├── database/
│   └── script_criacao.sql → criação do banco, tabelas e dados de teste
└── docs/
    └── documentacao.md → este arquivo


## 3. Banco de dados

Três tabelas principais:

- categorias (`id_categoria`, `nome`)
- autores (`id_autor`, `nome`, `nacionalidade`)
- livros (`id_livro`, `titulo`, `ano_publicacao`, `isbn`,
  `quantidade_estoque`, `preco`, `id_autor` [FK], `id_categoria` [FK],
  `data_cadastro`)

`livros` se relaciona com `autores` e `categorias` por chave estrangeira
(N:1 em ambos os casos).


## 4. Backend (PHP)

- `conexao.php`: abre a conexão PDO com o banco `livraria` (host, usuário
  e senha configuráveis no topo do arquivo — por padrão, valores do
  XAMPP: `root` sem senha).
- `cadastrar_livro.php`: recebe `POST` (JSON ou form-data) com os campos
  do livro, valida o título e insere o registro. Retorna JSON com
  `sucesso`, `mensagem` e `id_livro`.
- `listar_livros.php`: retorna, em JSON, todos os livros já com o nome
  do autor e da categoria (via `LEFT JOIN`).