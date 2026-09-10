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
