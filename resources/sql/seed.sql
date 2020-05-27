
-- Drop old schema --

DROP TABLE IF EXISTS person CASCADE;
DROP TABLE IF EXISTS administrator CASCADE;
DROP TABLE IF EXISTS member CASCADE;
DROP TABLE IF EXISTS location CASCADE;
DROP TABLE IF EXISTS photo CASCADE;
DROP TABLE IF EXISTS photo_in_publication CASCADE;
DROP TABLE IF EXISTS publication CASCADE;
DROP TABLE IF EXISTS reported CASCADE;
DROP TABLE IF EXISTS commentable_publication CASCADE;
DROP TABLE IF EXISTS comment CASCADE;
DROP TABLE IF EXISTS question CASCADE;
DROP TABLE IF EXISTS response CASCADE;
DROP TABLE IF EXISTS likes CASCADE;
DROP TABLE IF EXISTS tag CASCADE;
DROP TABLE IF EXISTS tag_question CASCADE;
DROP TABLE IF EXISTS favorite CASCADE;

DROP TYPE IF EXISTS medal_type CASCADE;
DROP TYPE IF EXISTS report CASCADE;

DROP TRIGGER IF EXISTS check_own_like ON likes;
DROP TRIGGER IF EXISTS check_current_user_likes ON likes;
DROP TRIGGER IF EXISTS check_own_favorite ON favorite;
DROP TRIGGER IF EXISTS erase_old_photo ON member;
DROP TRIGGER IF EXISTS erase_unnecessary_tag ON tag_question;
DROP TRIGGER IF EXISTS delete_person ON person;
DROP TRIGGER IF EXISTS delete_publication ON publication;
DROP TRIGGER IF EXISTS check_edit ON publication;
DROP TRIGGER IF EXISTS update_medal_to_bronze ON member;
DROP TRIGGER IF EXISTS update_medal_to_silver ON member;
DROP TRIGGER IF EXISTS update_medal_to_gold ON member;
DROP TRIGGER IF EXISTS update_points ON likes;
DROP TRIGGER IF EXISTS update_points_delete ON likes;

DROP FUNCTION IF EXISTS check_own_like() CASCADE;
DROP FUNCTION IF EXISTS check_current_user_likes() CASCADE;
DROP FUNCTION IF EXISTS check_own_favorite() CASCADE;
DROP FUNCTION IF EXISTS erase_old_photo() CASCADE;
DROP FUNCTION IF EXISTS erase_unnecessary_tag() CASCADE;
DROP FUNCTION IF EXISTS delete_person() CASCADE;
DROP FUNCTION IF EXISTS delete_publication() CASCADE;
DROP FUNCTION IF EXISTS check_edit() CASCADE;
DROP FUNCTION IF EXISTS update_medal_to_bronze() CASCADE;
DROP FUNCTION IF EXISTS update_medal_to_silver() CASCADE;
DROP FUNCTION IF EXISTS update_medal_to_gold() CASCADE;
DROP FUNCTION IF EXISTS update_points() CASCADE;
DROP FUNCTION IF EXISTS update_points_delete() CASCADE;

DROP INDEX IF EXISTS search_question;
DROP INDEX IF EXISTS search_publication;
DROP INDEX IF EXISTS search_tag;

-- Types --

CREATE TYPE medal_type AS ENUM
    ('Silver', 'Gold', 'Bronze');

CREATE TYPE report AS ENUM
    ('Spam', 'Hate speach', 'Terrorism', 'Fake News', 'Illegal Sales', 'Violence', 'Nudity', 'Harassment', 'Self Harm');



-- Tables --

CREATE TABLE person (
    id SERIAL PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    visible BOOLEAN DEFAULT TRUE
);

CREATE TABLE administrator (
    id_person INTEGER PRIMARY KEY REFERENCES person (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE location
(
    id SERIAL PRIMARY KEY,
    city TEXT,
    district TEXT,
    country TEXT
);

CREATE TABLE photo (
    id SERIAL PRIMARY KEY,
    url TEXT NOT NULL
);

CREATE TABLE member
(
    id_person INTEGER PRIMARY KEY REFERENCES person (id) ON UPDATE CASCADE ON DELETE CASCADE,
    name TEXT NOT NULL,
    biography TEXT,
    points INTEGER DEFAULT 0,
    id_location INTEGER REFERENCES location (id),
    id_photo INTEGER REFERENCES photo (id) ON UPDATE CASCADE ON DELETE SET NULL,
    medal medal_type,
    moderator boolean NOT NULL DEFAULT false
);

CREATE TABLE publication
(
    id SERIAL PRIMARY KEY,
    description TEXT NOT NULL,
    date DATE NOT NULL DEFAULT now(),
    id_owner INTEGER REFERENCES member (id_person) ON UPDATE CASCADE ON DELETE CASCADE,
    visible BOOLEAN DEFAULT TRUE
);

CREATE TABLE photo_in_publication (
    id_photo INTEGER PRIMARY KEY REFERENCES photo (id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_publication INTEGER NOT NULL REFERENCES publication (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE reported (
    id_member INTEGER NOT NULL REFERENCES member (id_person) ON UPDATE CASCADE ON DELETE CASCADE,
    id_publication INTEGER NOT NULL REFERENCES publication (id) ON UPDATE CASCADE ON DELETE CASCADE,
    motive report NOT NULL,
    resolved boolean NOT NULL DEFAULT false,
    PRIMARY KEY (id_member, id_publication, motive)
);

CREATE TABLE commentable_publication (
    id_publication INTEGER PRIMARY KEY REFERENCES publication (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE comment (
    id_publication INTEGER PRIMARY KEY NOT NULL REFERENCES publication (id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_commentable_publication INTEGER REFERENCES commentable_publication (id_publication) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE question (
    id_commentable_publication INTEGER PRIMARY KEY REFERENCES commentable_publication (id_publication) ON UPDATE CASCADE ON DELETE CASCADE,
    title TEXT NOT NULL
);

CREATE TABLE response (
    id_commentable_publication INTEGER PRIMARY KEY REFERENCES commentable_publication (id_publication) ON UPDATE CASCADE ON DELETE CASCADE,
    id_question INTEGER REFERENCES question (id_commentable_publication) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE likes
(
    id_commentable_publication INTEGER REFERENCES commentable_publication(id_publication) ON UPDATE CASCADE ON DELETE CASCADE,
    id_member INTEGER REFERENCES member (id_person) ON UPDATE CASCADE ON DELETE CASCADE,
    likes BOOLEAN,
    PRIMARY KEY (id_commentable_publication, id_member)
);

CREATE TABLE tag
(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE
);

CREATE TABLE tag_question (
    id_tag INTEGER NOT NULL REFERENCES tag (id),
    id_question INTEGER NOT NULL REFERENCES question (id_commentable_publication) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (id_tag, id_question)
);

CREATE TABLE favorite (
    id_commentable_publication INTEGER REFERENCES commentable_publication(id_publication) ON UPDATE CASCADE ON DELETE CASCADE,
    id_member INTEGER REFERENCES member (id_person) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (id_commentable_publication, id_member)
);



CREATE FUNCTION check_own_like() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
	IF EXISTS (SELECT * FROM commentable_publication, publication
	    WHERE commentable_publication.id_publication =  NEW.id_commentable_publication
	    AND publication.id = commentable_publication.id_publication
      	    AND publication.id_owner = NEW.id_member) 
	    THEN RAISE EXCEPTION 'A member is not allowed to like/dislike their own question/answer ';
        END IF;
        RETURN NEW;
    END;
	$BODY$
	LANGUAGE plpgsql;

CREATE TRIGGER check_own_like
    BEFORE INSERT OR UPDATE ON likes
    FOR EACH ROW
    EXECUTE PROCEDURE check_own_like(); 


CREATE FUNCTION check_current_user_likes() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
	IF EXISTS (SELECT * 
		FROM likes 
		WHERE likes.id_member = NEW.id_member
		AND likes.id_commentable_publication = NEW.id_commentable_publication)
	THEN UPDATE likes SET likes = NEW.likes 
		 WHERE likes.id_member = NEW.id_member
		 AND likes.id_commentable_publication = NEW.id_commentable_publication;
        END IF;		
        RETURN NEW;
    END;
	$BODY$
	LANGUAGE plpgsql;
	
	
CREATE TRIGGER check_current_user_likes
BEFORE INSERT ON likes
FOR EACH ROW EXECUTE PROCEDURE check_current_user_likes();

CREATE FUNCTION check_own_favorite() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
	IF EXISTS (SELECT * FROM commentable_publication, publication
	    WHERE commentable_publication.id_publication =  NEW.id_commentable_publication
	    AND publication.id = commentable_publication.id_publication
      	    AND publication.id_owner = NEW.id_member) 
	    THEN RAISE EXCEPTION 'A member is not allowed to favorite their own question/answer ';
        END IF;
        RETURN NEW;
    END;
	$BODY$
	LANGUAGE plpgsql;

CREATE TRIGGER check_own_favorite
    BEFORE INSERT ON favorite
    FOR EACH ROW
    EXECUTE PROCEDURE check_own_favorite(); 

CREATE FUNCTION erase_old_photo() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
	DELETE FROM photo where OLD.id_photo = photo.id;
        RETURN NEW;
    END;
	$BODY$
	LANGUAGE plpgsql;

CREATE TRIGGER erase_old_photo
    AFTER UPDATE OF id_photo ON member
    FOR EACH ROW
    EXECUTE PROCEDURE erase_old_photo(); 

CREATE FUNCTION erase_unnecessary_tag() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
        IF NOT EXISTS (SELECT * FROM tag_question
		    WHERE id_tag = OLD.id_tag)
	THEN DELETE FROM tag WHERE tag.id = OLD.id_tag;
        END IF;
        RETURN NEW;
    END;
	$BODY$
	LANGUAGE plpgsql;

CREATE TRIGGER erase_unnecessary_tag
    AFTER DELETE ON tag_question
    FOR EACH ROW
    EXECUTE PROCEDURE erase_unnecessary_tag(); 

CREATE FUNCTION delete_person() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
	IF EXISTS (SELECT * FROM person
	    WHERE person.id =  OLD.id)
	THEN UPDATE person SET visible = false WHERE person.id = OLD.id;
	END IF;
        RETURN OLD;
    END;
	$BODY$
	LANGUAGE plpgsql;
	
CREATE TRIGGER delete_person
    BEFORE DELETE ON person
    FOR EACH ROW
    EXECUTE PROCEDURE delete_person(); 

CREATE FUNCTION delete_publication() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
	IF EXISTS (SELECT * FROM publication
		WHERE publication.id = OLD.id)
	THEN UPDATE publication SET visible = false WHERE publication.id =  OLD.id;
        END IF;
        RETURN OLD;
    END;
	$BODY$
	LANGUAGE plpgsql;
	
CREATE TRIGGER delete_publication
    AFTER DELETE ON publication
    FOR EACH ROW
    EXECUTE PROCEDURE delete_publication(); 


CREATE FUNCTION check_edit() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
	IF EXISTS (SELECT count(likes.likes) AS num_likes 
		FROM likes
		WHERE likes.id_commentable_publication = OLD.id
		HAVING  count(likes.likes) > 3)
	THEN RAISE EXCEPTION 'Publication cant be edited because it has more than 3 likes/dislikes' ;
        END IF;
		
	IF EXISTS (SELECT *
		FROM comment
		WHERE comment.id_commentable_publication = OLD.id)
	THEN RAISE EXCEPTION 'Publication cant be edited because it already has comments associted';
	END IF;

	IF EXISTS (SELECT *
		FROM response
		WHERE response.question = OLD.id)
	THEN RAISE EXCEPTION 'Publication cant be edited because it already has answers associted';
        END IF;
		
        RETURN NEW;
    END;
	$BODY$
	LANGUAGE plpgsql;
	
CREATE TRIGGER check_edit
BEFORE UPDATE OF description ON publication
FOR EACH ROW EXECUTE PROCEDURE check_edit();	

CREATE FUNCTION update_medal_to_bronze() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
	
	IF(NEW.points > 2020 AND NEW.points < 4000)
	THEN
		UPDATE member
			SET medal = 'Bronze', moderator=true
		WHERE NEW.id_person = member.id_person;
	END IF;
	
        RETURN NEW;
    END;
	$BODY$
	LANGUAGE plpgsql;
	
CREATE TRIGGER update_medal_to_bronze
AFTER UPDATE OF points ON member
FOR EACH ROW EXECUTE PROCEDURE update_medal_to_bronze();	


CREATE FUNCTION update_medal_to_silver() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
	
	IF(NEW.points >= 4000 AND NEW.points < 6000)
	THEN
		UPDATE member
			SET medal = 'Silver', moderator=true
		WHERE NEW.id_person = member.id_person;
	END IF;
	
        RETURN NEW;
    END;
	$BODY$
	LANGUAGE plpgsql;
	
CREATE TRIGGER update_medal_to_silver
AFTER UPDATE OF points ON member
FOR EACH ROW EXECUTE PROCEDURE update_medal_to_bronze();	


CREATE FUNCTION update_medal_to_gold() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
	
	IF(NEW.points >= 6000)
	THEN
		UPDATE member
			SET medal = 'Gold', moderator=true
		WHERE NEW.id_person = member.id_person;
	END IF;
	
        RETURN NEW;
    END;
	$BODY$
	LANGUAGE plpgsql;
	
CREATE TRIGGER update_medal_to_gold
AFTER UPDATE OF points ON member
FOR EACH ROW EXECUTE PROCEDURE update_medal_to_gold();	

CREATE FUNCTION update_points() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
	
	IF(NEW.likes)
	THEN
		UPDATE member
			SET points = points + 1
		WHERE member.id_person = 
		(SELECT id_owner from publication WHERE publication.id = NEW.id_member);
	ELSE
	UPDATE member
			SET points = points - 1
		WHERE member.id_person = 
		(SELECT id_owner from publication WHERE publication.id = NEW.id_member);
		
	END IF;
	
        RETURN NEW;
    END;
	$BODY$
	LANGUAGE plpgsql;
	
CREATE TRIGGER update_points
AFTER INSERT ON likes
FOR EACH ROW EXECUTE PROCEDURE update_points();	

CREATE FUNCTION update_points_delete() RETURNS TRIGGER AS 
    $BODY$
    BEGIN
	
	IF(OLD.likes)
	THEN
		UPDATE member
			SET points = points - 1
		WHERE member.id_person = 
		(SELECT id_owner from publication WHERE publication.id = OLD.id_member);
	ELSE
	UPDATE member
			SET points = points + 1
		WHERE member.id_person = 
		(SELECT id_owner from publication WHERE publication.id = OLD.id_member);
		
	END IF;
	
        RETURN OLD;
    END;
	$BODY$
	LANGUAGE plpgsql;
	
CREATE TRIGGER update_points_delete
AFTER DELETE ON likes
FOR EACH ROW EXECUTE PROCEDURE update_points_delete();	


CREATE INDEX search_question ON question USING GIST (to_tsvector('english' , title || ' '));
CREATE INDEX search_publication ON publication USING GIST (to_tsvector('english' , description || ' '));
CREATE INDEX search_tag ON tag USING GIST (to_tsvector('english' , name));




INSERT INTO person(username,email,password) 
VALUES ('admin','admin@papagaio.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq'),
('gustavo_Mendes','gustavinho@gmail.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq'),
('mariaJoana1','mariajoana99@hotmail.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq'),
('PedroGustus','pedro2Augusto@yahoo.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq'),
('Maria','maria@gmail.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq'),
('Henrique2004','henrique_2004_santos@gmail.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq'),
('Fernando_Mendez','precoCerto@gmail.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq'),
('GuidaEmanuela','emanuelazita1234@gmail.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq'),
('AnabelaDeMalhadas','epico2010anabela@yahoo.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq'),
('PapagaioLover','dancingParrotLover@outlook.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq'),
('RicardoPereira','faltaDeCha@gmail.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq'),
('MarianaSousa','marianaSousa25@gmail.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq'),
('JoseAlves','queInformacaoDramatica@yahoo.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq'),
('QuimOvelha','quimquimquim@hotmail.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq'),
('CoelhoPassos','coelhoJose123@outlook.com','$2y$12$8F2OA0N/x/9SrItNaqkoXuJVy4yP9kul7j8bSuMTf0s/PhWYsepnq');

INSERT INTO administrator VALUES (1);

INSERT INTO location(country) VALUES ('Portugal'),
('France'),
('USA'),
('Afghanistan'),
('Brazil'),
('Fiji'),
('Germany'),
('Mexico'),
('Mozambique'),
('Russia'),
('Slovenia'),
('South Korea'),
('United States of America');

INSERT INTO photo(url) VALUES ('https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'),
('data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/'),
('https://statig1.akamaized.net/bancodeimagens/5i/6x/4l/5i6x4ly396q2ioenmxznv4zd3.jpg'),
('data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/'),
('data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/'),
('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSWFL6RbANo3ZyKyv1lHNH3P0DQfHaFkD9U-poSa77AHpJKm7rT'),
('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQLd7v7uPEqbURs_qnqQ29GuKYvj2kg8308IX0Z_7iCEyDR0dl3'),
('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRuOX_1JWUYSZL7QDfFUuaht2qDVW-e1JZ4oOmFLSs_j2hruE-i'),
('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRCxxjozfjyFiOUdS8N5lIt_CnuBG7yOZB2gdp-LOXpiLkn-vRF'),
('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQuQst6y8kRBEx7GQ7QG5GQiXXLGnoQGBgHVTELRhHAIHPfB_oz'),
('https://i.insider.com/5a9f1d915cc41020008b45f3?width=889&format=jpeg'),
('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRSlsNTSmsrjZDUY2-YcfkBf-sWFDaNTOF3KRELqqn_oYGV8SaQ'),
('https://www.themckenziefirm.com/wp-content/uploads/2019/03/AdobeStock_250034790-e1553990171364.jpeg'), ('https://images.pexels.com/photos/3273851/pexels-photo-3273851.jpeg?cs=srgb&dl=cidade-meio-urbano-cama-leito-3273851.jpg&fm=jpg'),
('https://images.pexels.com/photos/3786128/pexels-photo-3786128.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260');

INSERT INTO member(id_person, name, biography, points, id_location, id_photo, medal, moderator) VALUES 
(2,'Gustavo Mendes','Sou amante da natureza. Não passo um dia sem os meus gatos que só comem a ração de melhor qualidade.',3000,1,1,'Gold', true),
(3,'Maria Joana Da Silva','Sou a Maria, tenho 20 anos e adoro passear com os meus dois gatos.',1,2,2, 'Gold', true),
(4,'Pedro Augusto','Olá! Sou o Pedro e adoro papagaios.',4001,3,3,'Silver', true),
(5,'Henrique Sousa','Produzo ração para animais.',120000,4,4, 'Bronze', true),
(6,'Fernando Mendes','Olá! Sai-me sempre a sorte grande naquelas rodas marotas.',1,5,5, 'Bronze', true),
(7,'Margarida Emanuela', 'Sou a margarida, no entanto prefiro que me chamem de manuela. Emanuela só os meus pais.',1,6,6, 'Silver', true);

INSERT INTO member(id_person, name, biography, id_location, id_photo) VALUES 
(8,'Anabela De Malhadas','Bom dia! Adoro animais, mas prefiro gatos.',7,7),
(9,'Guilherme Fernandes','Não dou descrição pois sei que é o governo a espiar em mim.',8,8),
(10,'Ricardo Pereira','Falta-vos chá.',9,9),
(11,'Mariana Sousa','Boas! Desde os meus 8 anos sempre amei os bichinhos de 4 patas. Tenho 4 cães.',10,10),
(12,'Jose Alves','Adiciona-me no Facebook :)',11,11),
(13,'Joaquim Ovelha','Adoro ler e ouvir musica.',12,12),
(14,'Passos Coelho','Gosto de ler livros de economia.',13,13);

INSERT INTO tag (name) VALUES ('Papagaio'),
('Cão'),
('Gato'),
('Ração'),
('Ferida'),
('Ouriço'),
('Peixe'),
('Coelho'),
('Comportamento'),
('Urgente'),
('Treinar'),
('Hamster'),
('Chinchila'),
('Pássaro'),
('Gaivota');

INSERT INTO publication(id_owner, description) VALUES (2, ''),
(3, ''),
(4, 'Por favor ajudem!'),
(6, 'Pode ser por causa do tipo de comida, as calorias por kg variam muito e quanto mais elevado,mais engorda'),
(7, 'Ahhh não tinha pensado nisto'),
(8, ''),
(9, ''),
(10, ''),
(11, ''),
(12, '');

INSERT INTO photo_in_publication VALUES(14, 1);
INSERT INTO photo_in_publication VALUES(15, 2);

INSERT INTO commentable_publication
VALUES (2),(3),(4),(5),(6),(7),(8);

INSERT INTO comment VALUES (9, 2),(10, 3),(8, 4);

INSERT INTO question VALUES (2,'Porque é que o meu gato é tão gordo? Ele só come 2kgs de comida por dia. Porfavor, ajudem!'),
(3,'Se eu um dia comer comida de cão, torno-me num cão? Porque somos o que comemos!');

INSERT INTO response VALUES (4,2),
(5,2),
(6,2), 
(7,2),
(8,2);

INSERT INTO tag_question VALUES
(1,2),
(2,2),
(5,2),
(3,3),
(4,3),
(10,3);

INSERT INTO reported VALUES
(11,2,'Spam'),
(12,3,'Hate speach'),
(13,4,'Violence');

INSERT INTO likes
VALUES (4,2,true),
(5,2,false),
(4,3,true),
(5,3,false);

INSERT INTO favorite(id_member, id_commentable_publication) VALUES
(6,2),
(3,4),
(2,3); 