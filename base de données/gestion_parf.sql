drop database if exists gestion_parf;
create database if not exists gestion_parf;
use gestion_parf;

create table ListeParfum(
    idListeParfum int(4) auto_increment primary key,
    nom varchar(50),
    photo varchar(100),
    idMarque int(4)
);

create table Marque(
    idMarque int(4) auto_increment primary key,
    nomMarque varchar(50),
    categorie varchar(50)
);

create table utilisateur(
    iduser int(4) auto_increment primary key,
    login varchar(50),
    email varchar(255),
    role varchar(50),   -- admin ou visiteur
    etat int(1),        -- 1:activé 0:desactivé
    pwd varchar(255)
);

Alter table ListeParfum add constraint foreign key(idMarque) references Marque(idMarque);

INSERT INTO Marque(nomMarque,categorie) VALUES
	('PRADA','PR'),
    ('ARMANI','ARM'),
    ('Louis vuitton','LV'),
    ('TOM FORD','TF'),
    ('Calvin Klein','CK'),
	('DIOR','DR');		
	
	
INSERT INTO utilisateur(login,email,role,etat,pwd) VALUES 
    ('admin','admin@gmail.com','ADMIN',1,md5('123')),
    ('user1','user1@gmail.com','VISITEUR',0,md5('123')),
    ('user2','user2@gmail.com','VISITEUR',1,md5('123'));	

INSERT INTO ListeParfum(nom,photo,idMarque) VALUES
    ('Prada Candy','Chrysantheme.jpg',1),
	('Si Eau de Parfum','Desert.jpg',2),
	('Le Jour Se Lève','Hortensias.jpg',3),
    
	('Black Orchid','Meduses.jpg',4),
	('Euphoria','Penguins.jpg',5),
	('Jadore','Tulipes.jpg',6),
    
     ('Prada Luna Rossa','Chrysantheme.jpg',1),
	('Armani Code','Desert.jpg',2),
	('Mille Feux','Hortensias.jpg',3),
    
	('Oud Wood','Meduses.jpg',4),
	('Obsession','Penguins.jpg',5),
	('Dior Homme','Tulipes.jpg',6);
	

  


