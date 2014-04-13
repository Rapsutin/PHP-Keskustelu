CREATE TABLE Alue(
    nimi varchar(100) PRIMARY KEY NOT NULL
    );

CREATE TABLE Kayttaja(
    nimimerkki varchar(20) NOT NULL PRIMARY KEY,
    salasana varchar(20) NOT NULL,
    viesteja integer DEFAULT 0,
    liittymisaika date NOT NULL,
    onYllapitaja boolean DEFAULT FALSE,
    avatar bytea
    );


CREATE TABLE Aihe(
    id SERIAL PRIMARY KEY NOT NULL,
    luontiaika timestamp NOT NULL,
    alue varchar(100) REFERENCES Alue NOT NULL,
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

