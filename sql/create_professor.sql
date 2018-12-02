-- DROP TABLE professors;

CREATE TABLE professors (
    id integer NOT NULL,
    name varchar(32) NOT NULL,
    email varchar(255) NOT NULL,
    sex integer,
    password varchar(255) NOT NULL
);

ALTER TABLE professor ADD PRIMARY KEY(id);