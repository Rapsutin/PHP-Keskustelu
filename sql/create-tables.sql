CREATE TABLE Alue(
    nimi varchar(100) PRIMARY KEY NOT NULL
    );

CREATE TABLE Kayttaja(
    nimimerkki varchar(20) NOT NULL PRIMARY KEY,
    salasana varchar(20) NOT NULL,
    viesteja integer DEFAULT 0,
    liittymisaika date NOT NULL,
    onYllapitaja boolean DEFAULT FALSE,
    avatar varchar (1000)
    );


CREATE TABLE Aihe(
    id SERIAL PRIMARY KEY NOT NULL,
    luontiaika timestamp NOT NULL,
    alue varchar(100) REFERENCES Alue ON DELETE CASCADE ON UPDATE CASCADE NOT NULL,
    nimi varchar(100) NOT NULL
    );

CREATE TABLE Viesti(
    id SERIAL PRIMARY KEY NOT NULL,
    kirjoittaja varchar(20) REFERENCES Kayttaja NOT NULL,
    kirjoitushetki timestamp NOT NULL,
    teksti varchar(4000),
    aihe INTEGER REFERENCES Aihe(id) ON DELETE CASCADE
    );
	
	
CREATE TABLE Luetut(
    lukija varchar(20) REFERENCES Kayttaja ON DELETE CASCADE NOT NULL,
    aiheID INTEGER REFERENCES aihe ON DELETE CASCADE NOT NULL,
    primary key(lukija, aiheID)
    );

