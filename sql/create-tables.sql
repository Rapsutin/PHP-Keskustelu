CREATE TABLE Kayttaja(
	nimimerkki varchar(20) NOT NULL PRIMARY KEY,
	salasana varchar(20) NOT NULL,
	viestejä integer DEFAULT 0,
	liittymisaika date NOT NULL,
	avatar bytea
	);

CREATE TABLE Aihe(
	id SERIAL PRIMARY KEY NOT NULL,
	luontiaika timestamp NOT NULL,
	nimi varchar(100) NOT NULL
	);

CREATE TABLE Viesti(
	id SERIAL PRIMARY KEY NOT NULL,
	kirjoittaja varchar(20) REFERENCES Kayttaja NOT NULL,
	kirjoitushetki timestamp NOT NULL,
	teksti varchar(4000),
	aihe INTEGER REFERENCES Aihe(id)
	);
	
	
CREATE TABLE Luetut(
        
	lukija varchar(20) REFERENCES Kayttaja NOT NULL,
	viestiID INTEGER REFERENCES Viesti NOT NULL,
        primary key(lukija, viestiID)
	);
