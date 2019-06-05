-- CREATE SCHEMA Mibac;

-- USE Mibac;
CREATE TABLE Tipologie(
	id_tipologia VARCHAR(10),
	nome_tipologia VARCHAR(60),
	PRIMARY KEY (id_tipologia)
);

CREATE TABLE Regioni(
	id_regione INT,
	nome_regione VARCHAR(25),
	PRIMARY KEY (id_regione)
);

CREATE TABLE Province(
	id_provincia INT,
	nome_provincia VARCHAR(40),
	id_regione INT,
	targa VARCHAR(2)
	PRIMARY KEY (id_provincia),
	FOREIGN KEY (id_regione) REFERENCES Regioni(id_regione)
);

CREATE TABLE Comuni(
	id_comune INT,
	nome_comune VARCHAR(40),
	id_provincia INT,
	PRIMARY KEY (id_comune),
	FOREIGN KEY (id_provincia) REFERENCES Province(id_provincia)
);

CREATE TABLE Agenzie(
	id_agenzia VARCHAR(30),
	nome_agenzia VARCHAR(40),
	PRIMARY KEY (id_agenzia)
);

CREATE TABLE Rotte(
	id_rotta VARCHAR(20),
	nome_breve VARCHAR(15),
	nome_completo VARCHAR(130),
	tipo INT,
	id_agenzia VARCHAR(30) NOT NULL ,
	PRIMARY KEY (id_rotta),
	FOREIGN KEY (id_agenzia) REFERENCES Agenzie(id_agenzia) ON DELETE CASCADE
);

CREATE TABLE Fermate(
	id_fermata VARCHAR(40),
	nome_fermata VARCHAR(90),
	latitudine DECIMAL(10,6),
	longitudine DECIMAL(10,6),
	id_comune INT NOT NULL,
	id_provincia INT NOT NULL,
	id_regione INT NOT NULL,
	PRIMARY KEY (id_fermata),
	FOREIGN KEY (id_comune) REFERENCES Comuni(id_comune),
	FOREIGN KEY (id_provincia) REFERENCES Province(id_provincia),
	FOREIGN KEY (id_regione) REFERENCES Regioni(id_regione)
);

CREATE TABLE Viaggi(
	id_viaggio VARCHAR(105),
	direzione INT,
	id_rotta VARCHAR(20) NOT NULL,
	PRIMARY KEY (id_viaggio),
	FOREIGN KEY (id_rotta) REFERENCES Rotte(id_rotta) ON DELETE CASCADE
);

CREATE TABLE Attrattori(
	id_attrattore VARCHAR(6),
	denominazione VARCHAR(140),
	latitudine DECIMAL(10,6),
	longitudine DECIMAL(10,6),
	descrizione TEXT,
	descrizione_eng TEXT,
	sito_web VARCHAR(160),
	email VARCHAR(100),
	telefono VARCHAR(130),
	orario VARCHAR(240),
	chiusura_settimanale VARCHAR(140),
	telefono_biglietteria VARCHAR(110),
	prezzo_biglietto VARCHAR(300),
	riduzioni_biglietto VARCHAR(280),
	orario_biglietteria VARCHAR(150),
	indirizzo VARCHAR(120),
	cap CHAR(5),
	id_comune INT NOT NULL,
	id_provincia INT NOT NULL,
	id_regione INT NOT NULL,
	PRIMARY KEY (id_attrattore),
	FOREIGN KEY (id_comune) REFERENCES Comuni(id_comune),
	FOREIGN KEY (id_provincia) REFERENCES Province(id_provincia),
	FOREIGN KEY (id_regione) REFERENCES Regioni(id_regione)
);

CREATE TABLE Vicino_a(
	id_attrattore VARCHAR(6),
	id_fermata VARCHAR(40),
	priorita INT,
	distanza DECIMAL(10,6),
	PRIMARY KEY (id_attrattore, id_fermata),
	FOREIGN KEY (id_attrattore) REFERENCES Attrattori(id_attrattore) ON DELETE CASCADE,
	FOREIGN KEY (id_fermata) REFERENCES Fermate(id_fermata) ON DELETE CASCADE
);

CREATE TABLE Segue_orari(
	id_fermata VARCHAR(40),
	id_viaggio VARCHAR(105),
	orario_partenza CHAR(10),
	orario_Arrivo CHAR(10),
	PRIMARY KEY (id_fermata, id_viaggio),
	FOREIGN KEY (id_fermata) REFERENCES Fermate(id_fermata) ON DELETE CASCADE,
	FOREIGN KEY (id_viaggio) REFERENCES Viaggi(id_viaggio) ON DELETE CASCADE
);

CREATE TABLE Appartiene_ad_una(
	id_attrattore VARCHAR(6),
	id_tipologia VARCHAR(10),
	PRIMARY KEY (id_attrattore, id_tipologia),
	FOREIGN KEY (id_attrattore) REFERENCES Attrattori(id_attrattore),
	FOREIGN KEY (id_tipologia) REFERENCES Tipologie(id_tipologia)
);




























