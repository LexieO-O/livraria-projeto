create database livraria;

use livraria;

create table categorias (
	id_categoria int not null identity(1,1) primary key,
	nome varchar(80) not null
);

create table autores (
	id_autor int not null identity(1,1) primary key,
	nome varchar(120) not null,
	nacionalidade varchar(60)
);

create table livros (
	id_livro int not null identity(1,1) primary key,
	titulo varchar(150) not null,
	ano_publicacao int,
	isbn varchar(20),
	quantidade_estoque int not null default 0,
	preco float not null default 0,
	id_autor int foreign key references autores (id_autor),
	id_categoria int foreign key references categorias (id_categoria)
);

insert into categorias (nome) values ('Romance');
insert into categorias (nome) values ('Ficcao Cientifica');
insert into categorias (nome) values ('Tecnologia');
insert into categorias (nome) values ('Biografia');

insert into autores (nome, nacionalidade) values ('Machado de Assis', 'Brasileira');
insert into autores (nome, nacionalidade) values ('George Orwell', 'Britanica');
insert into autores (nome, nacionalidade) values ('Robert C. Martin', 'Americana');

insert into livros (titulo, ano_publicacao, isbn, quantidade_estoque, preco, id_autor, id_categoria)
values ('Dom Casmurro', 1899, '9788525406958', 12, 29.90, 1, 1);

insert into livros (titulo, ano_publicacao, isbn, quantidade_estoque, preco, id_autor, id_categoria)
values ('1984', 1949, '9780451524935', 8, 39.90, 2, 2);

insert into livros (titulo, ano_publicacao, isbn, quantidade_estoque, preco, id_autor, id_categoria)
values ('Clean Code', 2008, '9780132350884', 5, 89.90, 3, 3);
