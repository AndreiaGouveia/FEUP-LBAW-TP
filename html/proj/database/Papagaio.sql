-- Types --

CREATE TYPE medal_type AS ENUM
    ('Silver', 'Gold', 'Bronze');

CREATE TYPE report AS ENUM
    ('Spam', 'Hate speach', 'Terrorism', 'Fake News', 'Illegal Sales', 'Violence', 'Nudity', 'Harassment', 'Self Harm');



-- Tables --

DROP TABLE person;
CREATE TABLE person
(
    id SERIAL PRIMARY KEY,
    username TEXT NOT NULL CONSTRAINT person_username_ck UNIQUE (username),
    email TEXT NOT NULL CONSTRAINT person_email_ck UNIQUE (email),
    password TEXT NOT NULL,
);
 
DROP TABLE administrator;
CREATE TABLE administrator
(
    id_person INTEGER PRIMARY KEY REFERENCES person (id) ON UPDATE CASCADE ON DELETE CASCADE
);
 
DROP TABLE member;
CREATE TABLE member
(
    id_person INTEGER PRIMARY KEY REFERENCES person (id) ON UPDATE CASCADE ON DELETE CASCADE,
    name TEXT NOT NULL,
    biography TEXT,
    points INTEGER DEFAULT 0 CONSTRAINT member_points_ck CHECK (points > 0),
    id_medal INTEGER REFERENCES medal (id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_location INTEGER REFERENCES location (id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_photo INTEGER REFERENCES photo (id) ON UPDATE CASCADE ON DELETE CASCADE,    
);

DROP TABLE medal;
CREATE TABLE medal
(   id SERIAL PRIMARY KEY,
    TYPE medal_type NOT NULL
);
 
DROP TABLE location;
CREATE TABLE location
(
    id INTEGER PRIMARY KEY,
    city TEXT,
    district TEXT,
    country TEXT
);

DROP TABLE photo;
CREATE TABLE photo (
    id SERIAL PRIMARY KEY,
    idPublication INTEGER REFERENCES publicaton (id) ON UPDATE CASCADE ON DELETE CASCADE,
    url TEXT
);

DROP TABLE publication;
CREATE TABLE publication
(
    id SERIAL PRIMARY KEY,
    city TEXT NOT NULL,
    data DATE NOT NULL DEFAULT now(),
    idOwner INTEGER REFERENCES member (id) NOT NULL ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE reported;
CREATE TABLE reported (
    idMember INTEGER NOT NULL REFERENCES member (idPerson) ON UPDATE CASCADE ON DELETE CASCADE,
    idPublication INTEGER NOT NULL REFERENCES publication (id) ON UPDATE CASCADE ON DELETE CASCADE,
    TYPE reason NOT NULL,
    PRIMARY KEY (idMember, idPublication)
);

DROP TABLE commentablePublication;
CREATE TABLE commentablePublication (
    idPublication INTEGER PRIMARY KEY REFERENCES publication (id) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE comment;
CREATE TABLE comment (
    idPublication INTEGER PRIMARY KEY NOT NULL REFERENCES publication (id) ON UPDATE CASCADE ON DELETE CASCADE,
    idPublication INTEGER PRIMARY KEY REFERENCES publication (id) ON UPDATE CASCADE ON DELETE CASCADE     
);

DROP TABLE question;
CREATE TABLE question (
    idCommentablePublication INTEGER PRIMARY KEY REFERENCES commentablePublication (id) ON UPDATE CASCADE ON DELETE CASCADE,
    title NOT NULL
);

DROP TABLE response;
CREATE TABLE response (
    idCommentablePublication INTEGER PRIMARY KEY REFERENCES commentablePublication (id) ON UPDATE CASCADE ON DELETE CASCADE,
);

DROP TABLE likes;
CREATE TABLE likes
(
    id_commentable_publication INTEGER ON UPDATE CASCADE ON DELETE CASCADE,
    id_member INTEGER ON UPDATE CASCADE ON DELETE CASCADE,
    likes BOOLEAN,
    PRIMARY KEY (id_commentable_publication, id_member)
);

DROP TABLE tag;
CREATE TABLE tag
(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL CONSTRAINT tag_name UNIQUE (name)
);

DROP TABLE tagQuestion;
CREATE TABLE tagQuestion (
    idTag INTEGER NOT NULL REFERENCES tag (id) ON UPDATE CASCADE ON DELETE CASCADE,
    idQuestion INTEGER NOT NULL REFERENCES question (idCommentablePublication) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (idTag, idQuestion)
);