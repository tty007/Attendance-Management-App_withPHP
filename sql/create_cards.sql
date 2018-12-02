-- DROP TABLE cards;

CREATE TABLE cards (
    auto_id serial,
    cid integer references classes(auto_id),
    title varchar(32) NOT NULL,
    pdate timestamp NOT NULL,
    ip varchar(32) NOT NULL
);

ALTER TABLE cards ADD PRIMARY KEY(auto_id);