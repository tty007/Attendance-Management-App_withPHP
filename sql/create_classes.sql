-- DROP TABLE classes;

CREATE TABLE classes (
    auto_id serial,
    name varchar(32) NOT NULL,
    pname varchar(32) NOT NULL,
    content text NOT NULL
);

ALTER TABLE classes ADD PRIMARY KEY(auto_id);