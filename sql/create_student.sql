-- DROP TABLE students;

CREATE TABLE students (
    id integer NOT NULL,
    name varchar(32) NOT NULL,
    email varchar(255) NOT NULL,
    sex integer,
    password varchar(255) NOT NULL,
    faculty varchar(32),
    grade int
);

ALTER TABLE students ADD PRIMARY KEY(id);