INSERT INTO Kayttaja VALUES(
    'Rapsutin',
    'salasana1234',
    40,
    date '2010-09-12'
    );

INSERT INTO Kayttaja VALUES(
    'Jonne69',
    'ESESES',
    40,
    date '2013-09-22'
    );

INSERT INTO Aihe (luontiaika, alue, nimi) VALUES(
    timestamp '2014-04-04 12:06:00',
    'Yleinen keskustelu',
    'Olympialaiset');

INSERT INTO Viesti(kirjoittaja, kirjoitushetki, teksti, aihe) VALUES(
    'Rapsutin',
    timestamp '2014-04-04 12:19:00',
    'Nyt testataaaaaaaannn!!!!!!',
    1);
INSERT INTO Viesti(kirjoittaja, kirjoitushetki, teksti, aihe) VALUES(
    'Jonne69',
    timestamp '2014-04-04 12:20:00',
    'JUST NII!!! Lorum ipsum ja nii edellee',
    1);


    
    
