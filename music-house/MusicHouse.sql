CREATE TABLE Artistas (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    genero VARCHAR(50) NOT NULL
);

CREATE TABLE Albuns (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    artista_id INT REFERENCES Artistas(id) NOT NULL,
    lancamento DATE NOT NULL
);

CREATE TABLE Musicas (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    album_id INT REFERENCES Albuns(id) NOT NULL,
    duracao TIME NOT NULL,
    preco DECIMAL(8,2) NOT NULL
);

CREATE TABLE Clientes (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    data_cadastro DATE NOT NULL
);

CREATE TABLE Compras (
    id SERIAL PRIMARY KEY,
    cliente_id INT REFERENCES Clientes(id) NOT NULL,
    data_compra DATE NOT NULL,
    total DECIMAL(8,2) NOT NULL
);

CREATE TABLE ItensCompra (
    id SERIAL PRIMARY KEY,
    compra_id INT REFERENCES Compras(id) NOT NULL,
    musica_id INT REFERENCES Musicas(id) NOT NULL,
    quantidade INT NOT NULL
);

CREATE TABLE Carrinho (
    id SERIAL PRIMARY KEY,
    cliente_id INT REFERENCES Clientes(id) NOT NULL,
    musica_id INT REFERENCES Musicas(id) NOT NULL,
    quantidade INT NOT NULL
);

CREATE TABLE HistoricoDownloads (
    id SERIAL PRIMARY KEY,
    cliente_id INT REFERENCES Clientes(id) NOT NULL,
    musica_id INT REFERENCES Musicas(id) NOT NULL,
    data_download DATE NOT NULL
);



										-- Trigger 01 --									
CREATE OR REPLACE FUNCTION verifica_albums_artista()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (SELECT 1 FROM Albuns WHERE artista_id = OLD.id) THEN
        RAISE EXCEPTION 'Este artista possui álbuns associados e não pode ser excluído!';
    END IF;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_verifica_albums_artista
BEFORE DELETE ON Artistas
FOR EACH ROW
EXECUTE FUNCTION verifica_albums_artista();

										-- Trigger 02 --
CREATE OR REPLACE FUNCTION remove_musicas_album()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM Musicas WHERE album_id = OLD.id;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_remove_musicas_album
BEFORE DELETE ON Albuns
FOR EACH ROW
EXECUTE FUNCTION remove_musicas_album();

										-- Trigger 03 --
CREATE OR REPLACE FUNCTION remove_compras_cliente()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM Compras WHERE cliente_id = OLD.id;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_remove_compras_cliente
BEFORE DELETE ON Clientes
FOR EACH ROW
EXECUTE FUNCTION remove_compras_cliente();

							-- Stored Procedure 01 --
CREATE OR REPLACE FUNCTION inserir_cliente(
    nome_cliente VARCHAR(100),
    email_cliente VARCHAR(100),
    data_cadastro_cliente DATE
)
RETURNS INT AS $$
DECLARE
    cliente_id INT;
BEGIN
    INSERT INTO Clientes (nome, email, data_cadastro)
    VALUES (nome_cliente, email_cliente, data_cadastro_cliente)
    RETURNING id INTO cliente_id;
    
    RETURN cliente_id;
END;
$$ LANGUAGE plpgsql;


						-- Stored Procedure 02 --


CREATE OR REPLACE FUNCTION realizar_compra(
    cliente_id INT,
    data_compra DATE,
    itens_compra INT[][]
)
RETURNS INT AS $$
DECLARE
    compra_id INT;
    total_compra DECIMAL(8,2);
BEGIN
    -- Inserir compra
    INSERT INTO Compras (cliente_id, data_compra, total)
    VALUES (cliente_id, data_compra, 0)
    RETURNING id INTO compra_id;
    
    -- Inserir itens de compra
    FOR i IN 1..array_length(itens_compra, 1) LOOP
        INSERT INTO ItensCompra (compra_id, musica_id, quantidade)
        VALUES (compra_id, itens_compra[i][1], itens_compra[i][2]);
    END LOOP;
    
    -- Calcular o total da compra
    SELECT SUM(m.preco * ic.quantidade) INTO total_compra
    FROM ItensCompra ic
    INNER JOIN Musicas m ON ic.musica_id = m.id
    WHERE ic.compra_id = compra_id;
    
    -- Atualizar o total da compra na tabela "Compras"
    UPDATE Compras
    SET total = total_compra
    WHERE id = compra_id;
    
    RETURN compra_id;
END;
$$ LANGUAGE plpgsql;


					-- Stored Procedure 03 --
	
CREATE OR REPLACE FUNCTION obter_historico_downloads(
    cliente_id INT
)
RETURNS TABLE (musica VARCHAR(100), data_download DATE) AS $$
BEGIN
    RETURN QUERY
    SELECT m.titulo, hd.data_download
    FROM HistoricoDownloads hd
    INNER JOIN Musicas m ON hd.musica_id = m.id
    WHERE hd.cliente_id = cliente_id;
END;
$$ LANGUAGE plpgsql;


INSERT INTO Artistas (nome, genero)
VALUES ('Mano Brown', 'RAP'),
       ('Roberto Carlos', 'Rock'),
       ('Charlie Brown Jr', 'Rock');
	   
INSERT INTO Albuns (titulo, artista_id, lancamento)
VALUES ('Sobrevivendo no Inferno', 1, '1997-12-20'),
       ('É Proibido Fumar', 2, '1964-06-01'),
       ('Tamo Aí na Atividade', 1, '2004-11-01');

INSERT INTO Musicas (titulo, album_id, duracao, preco)
VALUES ('Capítulo 4, Versículo 3', 1, '00:08:09', 8.00),
       ('O Calhambeque', 1, '00:02:21', 12.99),
       ('Tamo Aí na Atividade', 2, '00:03:39', 5.50);

INSERT INTO Clientes (nome, email, data_cadastro)
VALUES ('Pedro Fratassi', 'pedro3fratassi@gmail.com', '2022-06-06'),
       ('Gisele Souza', 'gisele_sousa@gmail.com', '2022-05-15'),
       ('Keroly Andrade', 'kerolyandrade@gmail.com', '2022-03-27');
	   
INSERT INTO Compras (cliente_id, data_compra, total)
VALUES (1, '2022-01-01', 8.00),
       (2, '2022-02-01', 5.50),
       (3, '2022-03-01', 8.00);

INSERT INTO ItensCompra (compra_id, musica_id, quantidade)
VALUES (1, 1, 2),
       (1, 2, 1),
       (2, 3, 1);
	   
INSERT INTO Carrinho (cliente_id, musica_id, quantidade)
VALUES (1, 1, 1),
       (2, 2, 2),
       (3, 3, 3);

INSERT INTO HistoricoDownloads (cliente_id, musica_id, data_download)
VALUES (1, 2, '2022-01-01'),
       (1, 3, '2022-02-01'),
       (2, 1, '2022-03-01');

											-- SELECT --
-- Subconsultas --									
SELECT titulo
FROM Musicas
WHERE album_id IN (SELECT id FROM Albuns WHERE artista_id = (SELECT id FROM Artistas WHERE nome = 'Artista 1'));

-- UNION --
SELECT titulo
FROM Musicas
WHERE album_id IN (SELECT id FROM Albuns WHERE artista_id = (SELECT id FROM Artistas WHERE nome = 'Artista 1'))
UNION
SELECT m.titulo
FROM Musicas m
INNER JOIN ItensCompra ic ON m.id = ic.musica_id
INNER JOIN Compras c ON ic.compra_id = c.id
WHERE c.cliente_id = 2;

-- INTERSECT -- 
SELECT m.titulo
FROM Musicas m
INNER JOIN ItensCompra ic ON m.id = ic.musica_id
INNER JOIN Compras c ON ic.compra_id = c.id
WHERE c.cliente_id = 1
INTERSECT
SELECT m.titulo
FROM Musicas m
INNER JOIN HistoricoDownloads hd ON m.id = hd.musica_id
WHERE hd.cliente_id = 1;

-- EXCEPT -- 
SELECT m.titulo
FROM Musicas m
INNER JOIN ItensCompra ic ON m.id = ic.musica_id
INNER JOIN Compras c ON ic.compra_id = c.id
WHERE c.cliente_id = 3
EXCEPT
SELECT m.titulo
FROM Musicas m
INNER JOIN HistoricoDownloads hd ON m.id = hd.musica_id
WHERE hd.cliente_id = 3;

								-- View --
CREATE OR REPLACE VIEW DetalhesCompra AS
SELECT c.id AS compra_id, cl.nome AS nome_cliente, c.data_compra, c.total
FROM Compras c
INNER JOIN Clientes cl ON c.cliente_id = cl.id;

SELECT * FROM DetalhesCompra;


                            