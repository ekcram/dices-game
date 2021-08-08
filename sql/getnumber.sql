
DROP TABLE IF EXISTS mensaje;
DROP TABLE IF EXISTS partida;
DROP TABLE IF EXISTS usuario;

CREATE TABLE usuario (
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50),
    username VARCHAR(50), 
    contrasena VARCHAR(100),
	CONSTRAINT PK_usuario PRIMARY KEY (id)
);

CREATE TABLE partida (
    id_partida INT NOT NULL AUTO_INCREMENT,
    id_jugador INT,
    username_jugador VARCHAR(50),
    numDados INT,
    numCaras INT,
    numGanador INT,
    victorias INT,
    derrotas INT,
    CONSTRAINT PK_partida PRIMARY KEY (id_partida),
    FOREIGN KEY (id_jugador) REFERENCES usuario(id)
);

CREATE TABLE mensaje (
id_mensaje INT NOT NULL AUTO_INCREMENT,
asunto VARCHAR(250),
cuerpo TEXT,
fecha DATE, 
id_usuario INT,
username_usuario VARCHAR(50),
CONSTRAINT PK_mensaje PRIMARY KEY (id_mensaje),
FOREIGN KEY (id_usuario) REFERENCES usuario(id)
);


INSERT INTO usuario (id,nombre,username,contrasena) VALUES (1,"Marco","marco","$2y$12$UeaoQb6SImyUDhKddTE6Teiffx4aqg5CbXDRVetrkCXzv58yXLJ52");
INSERT INTO usuario (id,nombre,username,contrasena) VALUES (2,"María","maria","$2y$12$UeaoQb6SImyUDhKddTE6Teiffx4aqg5CbXDRVetrkCXzv58yXLJ52");
INSERT INTO usuario (id,nombre,username,contrasena) VALUES (3,"Javi","javi","$2y$12$UeaoQb6SImyUDhKddTE6Teiffx4aqg5CbXDRVetrkCXzv58yXLJ52");
INSERT INTO usuario (id,nombre,username,contrasena) VALUES (4,"Victoria","vicky","$2y$12$UeaoQb6SImyUDhKddTE6Teiffx4aqg5CbXDRVetrkCXzv58yXLJ52");
INSERT INTO usuario (id,nombre,username,contrasena) VALUES (5,"Antonio","antonio","$2y$12$UeaoQb6SImyUDhKddTE6Teiffx4aqg5CbXDRVetrkCXzv58yXLJ52");





