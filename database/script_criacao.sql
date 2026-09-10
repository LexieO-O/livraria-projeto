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