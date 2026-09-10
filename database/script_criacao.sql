create database livraria;

use livraria;

create table categorias (
	id_categoria int not null auto_increment,
	nome varchar(80) not null,
    primary key (id_categoria)
);

create table autores (
	id_autor int not null auto_increment,
	nome varchar(120) not null,
	nacionalidade varchar(60),
    primary key (id_autor)
);

create table livros (
	id_livro int not null auto_increment,
	titulo varchar(150) not null,
	ano_publicacao int,
	isbn varchar(20),
	quantidade_estoque int not null default 0,
	preco decimal(10,2) not null default 0.00,
	id_autor int,
	id_categoria int,
    
    primary key (id_livro),
    
    constraint fk_livros_autores
    	foreign key (id_autor)
    	references autores (id_autor),
    
    constraint fk_livros_categorias foreign key (id_categoria)
    	references categorias (id_categoria)
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
