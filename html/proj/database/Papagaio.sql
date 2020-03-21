-- Types
 
CREATE TYPE medalType AS ENUM ('Gold', 'Silver', 'Bronze'); 
CREATE TYPE report AS ENUM ( 'Spam' , 'Hate speach' , 'Terrorism' , 'Fake News' , 'Illegal Sales' , 'Violence' , 'Nudity' , 'Harassment' , 'Self Harm');
 
-- Tables
 
 
CREATE TABLE "person" (
    idPerson SERIAL PRIMARY KEY,
    username text NOT NULL CONSTRAINT person_username_uk UNIQUE,
    email text NOT NULL CONSTRAINT person_email_uk UNIQUE,
    password text NOT NULL,
);
 
CREATE TABLE administrator (
    idPerson INTEGER PRIMARY KEY REFERENCES "person" (id) ON UPDATE CASCADE ON DELETE CASCADE,
);
 
CREATE TABLE member (
    idMember INTEGER PRIMARY KEY REFERENCES "person" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    name text NOT NULL,
    biography text,
    idMedal INTEGER REFERENCES medal --falta o check e o resto
);
 
CREATE TABLE location (
    idLocation SERIAL PRIMARY KEY,
    city text,
    district text,
    country text
);
 
/* EXEMPLO DO STOR -- o nome das tabelas ficam entre aspas sempre que sao chamados em mais que uma tabela?
CREATE TABLE collection (
    id SERIAL PRIMARY KEY,
    name text NOT NULL
);
 
CREATE TABLE "work" (
    id SERIAL PRIMARY KEY,
    title text NOT NULL,
    obs text,
    img text,
    "year" INTEGER,
    id_user INTEGER REFERENCES "user" (id) ON UPDATE CASCADE,
    id_collection INTEGER REFERENCES collection (id) ON UPDATE CASCADE,
    CONSTRAINT year_positive_ck CHECK (("year" > 0))
);
 
CREATE TABLE author_work (
    id_author INTEGER NOT NULL REFERENCES author (id) ON UPDATE CASCADE,
    id_work INTEGER NOT NULL REFERENCES "work" (id) ON UPDATE CASCADE,
    PRIMARY KEY (id_author, id_work)
);
 
CREATE TABLE book (
    id_work INTEGER PRIMARY KEY REFERENCES "work" (id) ON UPDATE CASCADE,
    edition text,
    isbn BIGINT NOT NULL CONSTRAINT book_isbn_uk UNIQUE,
    id_publisher INTEGER REFERENCES publisher (id) ON UPDATE CASCADE
);
 
CREATE TABLE nonbook (
    id_work INTEGER PRIMARY KEY REFERENCES "work" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    TYPE media NOT NULL
);
 
CREATE TABLE item (
    id SERIAL PRIMARY KEY,
    id_work INTEGER NOT NULL REFERENCES "work" (id) ON UPDATE CASCADE,
    id_location INTEGER NOT NULL REFERENCES location (id) ON UPDATE CASCADE,
    code INTEGER NOT NULL,
    "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
);
 
CREATE TABLE loan (
    id SERIAL PRIMARY KEY,
    id_item INTEGER NOT NULL REFERENCES item (id) ON UPDATE CASCADE,
    id_user INTEGER NOT NULL REFERENCES "user" (id) ON UPDATE CASCADE,
    start_t TIMESTAMP WITH TIME zone NOT NULL,
    end_t TIMESTAMP WITH TIME zone NOT NULL,
    CONSTRAINT date_ck CHECK (end_t > start_t)
);
 
CREATE TABLE review (
    id_work INTEGER NOT NULL REFERENCES "work" (id) ON UPDATE CASCADE,
    id_user INTEGER NOT NULL REFERENCES "user" (id) ON UPDATE CASCADE,
    "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    comment text NOT NULL,
    rating INTEGER NOT NULL CONSTRAINT rating_ck CHECK (((rating > 0) OR (rating <= 5))),
    PRIMARY KEY (id_work, id_user)
);
 
CREATE TABLE wish_list (
    id_work INTEGER NOT NULL REFERENCES "work" (id) ON UPDATE CASCADE,
    id_user INTEGER NOT NULL REFERENCES "user" (id) ON UPDATE CASCADE,
    PRIMARY KEY (id_work, id_user)
);*/