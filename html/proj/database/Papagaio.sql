-- Drop old schema --

DROP TABLE IF EXISTS person CASCADE;
DROP TABLE IF EXISTS administrator CASCADE;
DROP TABLE IF EXISTS member CASCADE;
DROP TABLE IF EXISTS medal CASCADE;
DROP TABLE IF EXISTS location CASCADE;
DROP TABLE IF EXISTS photo CASCADE;
DROP TABLE IF EXISTS publication CASCADE;
DROP TABLE IF EXISTS reported CASCADE;
DROP TABLE IF EXISTS commentablePublication CASCADE;
DROP TABLE IF EXISTS comment CASCADE;
DROP TABLE IF EXISTS question CASCADE;
DROP TABLE IF EXISTS response CASCADE;
DROP TABLE IF EXISTS likes CASCADE;
DROP TABLE IF EXISTS tag CASCADE;
DROP TABLE IF EXISTS tag_question CASCADE;
DROP TABLE IF EXISTS favorite CASCADE;
 
DROP TYPE IF EXISTS medal_type;
DROP TYPE IF EXISTS report;


-- Types --

CREATE TYPE medal_type AS ENUM
    ('Silver', 'Gold', 'Bronze');

CREATE TYPE report AS ENUM
    ('Spam', 'Hate speach', 'Terrorism', 'Fake News', 'Illegal Sales', 'Violence', 'Nudity', 'Harassment', 'Self Harm');



-- Tables --

CREATE TABLE person
(
    id SERIAL PRIMARY KEY,
    username TEXT NOT NULL CONSTRAINT person_username_uk UNIQUE (username),
    email TEXT NOT NULL CONSTRAINT person_email_uk UNIQUE (email),
    password TEXT NOT NULL,
);

CREATE TABLE administrator
(
    id_person INTEGER PRIMARY KEY REFERENCES person (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE member
(
    id_person INTEGER PRIMARY KEY REFERENCES person (id) ON UPDATE CASCADE ON DELETE CASCADE,
    name TEXT NOT NULL,
    biography TEXT,
    points INTEGER DEFAULT 0 CONSTRAINT member_points_ck CHECK (points > 0),
    id_medal INTEGER REFERENCES medal (id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_location INTEGER REFERENCES location (id),
    id_photo INTEGER REFERENCES photo (id) ON UPDATE CASCADE ON DELETE CASCADE,    
);

CREATE TABLE medal
(   id SERIAL PRIMARY KEY,
    TYPE medal_type NOT NULL
);
 
CREATE TABLE location
(
    id INTEGER PRIMARY KEY,
    city TEXT,
    district TEXT,
    country TEXT
);

CREATE TABLE photo (
    id SERIAL PRIMARY KEY,
    idPublication INTEGER REFERENCES publicaton (id) ON UPDATE CASCADE ON DELETE CASCADE,
    url TEXT
);

CREATE TABLE publication
(
    id SERIAL PRIMARY KEY,
    city TEXT NOT NULL,
    data DATE NOT NULL DEFAULT now(),
    id_owner INTEGER REFERENCES member (id) NOT NULL ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE reported (
    id_member INTEGER NOT NULL REFERENCES member (id_person) ON UPDATE CASCADE ON DELETE CASCADE,
    id_publication INTEGER NOT NULL REFERENCES publication (id) ON UPDATE CASCADE ON DELETE CASCADE,
    TYPE reason NOT NULL,
    PRIMARY KEY (id_member, id_publication)
);

CREATE TABLE commentable_publication (
    idPublication INTEGER PRIMARY KEY REFERENCES publication (id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE comment (
    id_publication INTEGER PRIMARY KEY NOT NULL REFERENCES publication (id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_publication INTEGER PRIMARY KEY REFERENCES publication (id) ON UPDATE CASCADE ON DELETE CASCADE     
);

CREATE TABLE question (
    id_commentable_publication INTEGER PRIMARY KEY REFERENCES commentable_publication (id) ON UPDATE CASCADE ON DELETE CASCADE,
    title NOT NULL
);

CREATE TABLE response (
    id_commentable_publication INTEGER PRIMARY KEY REFERENCES commentable_publication (id) ON UPDATE CASCADE ON DELETE CASCADE,
);

CREATE TABLE likes
(
    id_commentable_publication INTEGER ON UPDATE CASCADE ON DELETE CASCADE,
    id_member INTEGER ON UPDATE CASCADE ON DELETE CASCADE,
    likes BOOLEAN,
    PRIMARY KEY (id_commentable_publication, id_member)
);

CREATE TABLE tag
(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL CONSTRAINT tag_name_uk UNIQUE (name)
);

CREATE TABLE tag_question (
    id_tag INTEGER NOT NULL REFERENCES tag (id),
    id_question INTEGER NOT NULL REFERENCES question (id_commentable_publication) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (id_tag, id_question)
);

CREATE TABLE favorite (
    id_commentable_publication INTEGER ON UPDATE CASCADE ON DELETE CASCADE,
    id_member INTEGER ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY (id_commentable_publication, id_member)
);
