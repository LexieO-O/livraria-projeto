<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraria | Livros</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Livraria TADS</h1>
        <nav>
            <a href="index.html">Início</a>
            <a href="livros.php">Livros</a>
        </nav>
    </header>
    <main>
        <section class="form-livro">
            <h2>Cadastrar novo livro</h2>
            <form id="formLivro" action="../backend/processar_livro.php" method="POST">
                <label for="titulo">Título *</label>
                <input type="text" id="titulo" name="titulo" required>
                <label for="ano_publicacao">Ano de publicação</label>
                <input type="number" id="ano_publicacao" name="ano_publicacao" min="1000" max="2100">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn">
                <label for="quantidade_estoque">Quantidade em estoque</label>
                <input type="number" id="quantidade_estoque" name="quantidade_estoque" min="0" value="0">
                <label for="preco">Preço (R$)</label>
                <input type="number" id="preco" name="preco" min="0" step="0.01" value="0">
                <label for="id_autor">ID do autor (opcional)</label>
                <input type="number" id="id_autor" name="id_autor" min="1">
                <label for="id_categoria">ID da categoria (opcional)</label>
                <input type="number" id="id_categoria" name="id_categoria" min="1">
                <button type="submit" class="botao">Cadastrar</button>
            </form>
            <p id="mensagem"></p>
        </section>
        <section class="tabela-livro">
            <h2>Livros Cadastrados</h2>
            <table id="tabelaLivros">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Ano de Publicação</th>
                        <th>ISBN</th>
                        <th>Quantidade em Estoque</th>
                        <th>Preço (R$)</th>
                        <th>ID do Autor</th>
                        <th>ID da Categoria</th>
                    </tr>
                </thead>
                <tbody id="verTabelaLivros">
                    <tr><td colspan="8">Carregando...</td></tr>
                </tbody>
            </table>
        </section>
    </main>
    <script>
        const formLivro = document.getElementById('formLivro');
        const mensagem = document.getElementById('mensagem');
        const tabelaLivros = document.getElementById('verTabelaLivros');

        async function carregarLivros() {
            try {
                const resposta = await fetch('../backend/listar_livros.php');
                const dados = await resposta.json();
                if (!dados.sucesso) {
                    tabelaLivros.innerHTML = `<tr><td colspan="8">${dados.mensagem}</td></tr>`;
                    return;
                }
                if (dados.livros.length === 0) {
                    tabelaLivros.innerHTML = `<tr><td colspan="8">Nenhum livro cadastrado.</td></tr>`;
                    return;
                }
                tabelaLivros.innerHTML = dados.livros.map(livro => `
                    <tr>
                        <td>${livro.id_livro}</td>
                        <td>${livro.titulo}</td>
                        <td>${livro.ano_publicacao ?? 'N/A'}</td>
                        <td>${livro.isbn ?? 'N/A'}</td>
                        <td>${livro.quantidade_estoque}</td>
                        <td>R$ ${Number(livro.preco).toFixed(2)}</td>
                        <td>${livro.id_autor ?? 'N/A'}</td>
                        <td>${livro.id_categoria ?? 'N/A'}</td>
                    </tr>
                `).join('');
            } catch (erro) {
                tabelaLivros.innerHTML = `<tr><td colspan="8">Erro ao carregar livros: Falha ao conectar com servidor</td></tr>`;
            }
        }

        formLivro.addEventListener('submit', async (evento) => {
            evento.preventDefault();
            const dadosForm = new FormData(formLivro);
            try {
                const resposta = await fetch(formLivro.action, {
                    method: formLivro.method,
                    body: dadosForm,
                });
                if (resposta.url.includes('erro=1')) {
                    mensagem.textContent = 'Erro: o título do livro é obrigatório.';
                    mensagem.style.color = 'red';
                } else if (resposta.url.includes('erro=2')) {
                    mensagem.textContent = 'Erro: o ano de publicação deve ser um número entre 1000 e 2100.';
                    mensagem.style.color = 'red';
                } else if (resposta.url.includes('erro=3')) {
                    mensagem.textContent = 'Erro: a quantidade em estoque deve ser um número maior ou igual a 0.';
                    mensagem.style.color = 'red';
                } else if (resposta.url.includes('erro=4')) {
                    mensagem.textContent = 'Erro: o preço deve ser um número maior ou igual a 0.';
                    mensagem.style.color = 'red';
                } else if (resposta.url.includes('erro=5')) {
                    mensagem.textContent = 'Erro: o ID do autor deve ser um número maior ou igual a 1.';
                    mensagem.style.color = 'red';
                } else if (resposta.url.includes('erro=6')) {
                    mensagem.textContent = 'Erro: o ID da categoria deve ser um número maior ou igual a 1.';
                    mensagem.style.color = 'red';
                } else {
                    mensagem.textContent = 'Livro cadastrado com sucesso!';
                    mensagem.style.color = 'green';
                    formLivro.reset();
                    carregarLivros();
                }
            } catch (erro) {
                mensagem.textContent = 'Erro ao cadastrar livro: Falha ao conectar com servidor';
                mensagem.style.color = 'red';
            }
        });

        carregarLivros();
    </script>
</body>
</html>
