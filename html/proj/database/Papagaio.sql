-- Types
 
CREATE TYPE medalType AS ENUM ('Gold', 'Silver', 'Bronze'); 
CREATE TYPE report AS ENUM ( 'Spam' , 'Hate speach' , 'Terrorism' , 'Fake News' , 'Illegal Sales' , 'Violence' , 'Nudity' , 'Harassment' , 'Self Harm');
 

-- Tables

CREATE TABLE "person" (
    id SERIAL PRIMARY KEY,
    username text NOT NULL CONSTRAINT person_username_uk UNIQUE,
    email text NOT NULL CONSTRAINT person_email_uk UNIQUE,
    password text NOT NULL,
);
 
CREATE TABLE administrator (
    idPerson INTEGER PRIMARY KEY REFERENCES "person" (id) ON UPDATE CASCADE
);
 
CREATE TABLE member (
    idPerson INTEGER PRIMARY KEY REFERENCES "person" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    name text NOT NULL,
    biography text,
    points DEFAULT 0 CONSTRAINT points_ck CHECK (points > 0),
    idMedal INTEGER REFERENCES medal (id) CONSTRAINT medal_ck CHECK ((points<2020 AND idMedal == NULL) OR
   (idMedal != NULL AND ((points > 2020 AND points <=3999 AND idMedal.type == 'Bronze') 
   OR (points > 3999 AND points <=5999 AND idMedal.type == 'Silver') OR (points > 5999 AND idMedal.type == 'Gold')))),
    idLocation INTEGER REFERENCES member_location (id) ON UPDATE CASCADE,
    idPhoto INTEGER REFERENCES photo (id) CONSTRAINT photo_ck CHECK (photo.idPublication == NULL) ON UPDATE CASCADE
);

CREATE TABLE medal (
    id SERIAL PRIMARY KEY,
    TYPE medalType NOT NULL
);
 
CREATE TABLE memberLocation (
    id SERIAL PRIMARY KEY,
    city text,
    district text,
    country text
);

CREATE TABLE photo (
    id SERIAL PRIMARY KEY,
    idPublication INTEGER  REFERENCES "publicaton" (id) ON UPDATE CASCADE ON DELETE CASCADE,
    url text
);

CREATE TABLE publication (
    id SERIAL PRIMARY KEY,
    city text NOT NULL,
    "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    idOwner INTEGER REFERENCES "member" (id) NOT NULL
);

CREATE TABLE reported (
    idMember INTEGER NOT NULL REFERENCES "member" (id) ON UPDATE CASCADE,
    idPublication INTEGER NOT NULL REFERENCES "publication" (id) ON UPDATE CASCADE,
    TYPE reason NOT NULL,
    PRIMARY KEY (idMember, idPublication)
);

CREATE TABLE "commentablePublication" (
    idPublication INTEGER PRIMARY KEY REFERENCES "publication" (id) ON UPDATE CASCADE
);

CREATE TABLE comment (
    id SERIAL PRIMARY KEY,
    idPublication INTEGER NOT NULL REFERENCES "publication" (id) ON UPDATE CASCADE,
    idResponse INTEGER REFERENCES "response" (id) ON UPDATE CASCADE,
    idQuestion INTEGER REFERENCES "question" (id) ON UPDATE CASCADE CONSTRAINT comment_ck CHECK 
    (((idResponse IS NOT NULL AND idQuestion IS NULL) OR (idQuestion IS NOT NULL AND idResponse IS NULL)) 
    AND (question.idPublication.date < idPublication.date)
    AND (response.idPublication.date < idPublication.date))
    
);

CREATE TABLE "question" (
    id SERIAL PRIMARY KEY,
    idCommentablePublication INTEGER REFERENCES "commentablePublication" (id) ON UPDATE CASCADE,
    title NOT NULL
);

CREATE TABLE tagQuestion (
    idTag INTEGER NOT NULL REFERENCES tag (id) ON UPDATE CASCADE,
    idQuestion INTEGER NOT NULL REFERENCES "question" (id) ON UPDATE CASCADE,
    PRIMARY KEY (idTag, idQuestion)
);

 
/* -- Types
 
CREATE TYPE media AS ENUM ('CD', 'DVD', 'VHS', 'Slides', 'Photos', 'MP3');
 
-- Tables
 
 
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY,
    email text NOT NULL CONSTRAINT user_email_uk UNIQUE,
    name text NOT NULL,
    obs text,
    password text NOT NULL,
    img text,
    is_admin BOOLEAN NOT NULL
);
 
CREATE TABLE publisher (
    id SERIAL PRIMARY KEY,
    name text NOT NULL
);
 
CREATE TABLE location (
    id SERIAL PRIMARY KEY,
    name text NOT NULL,
    address text NOT NULL,
    gps text
);
 
CREATE TABLE author (
    id SERIAL PRIMARY KEY,
    name text NOT NULL,
    img text
);
 
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
);
);*/