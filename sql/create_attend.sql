-- DROP TABLE attends;

CREATE TABLE attends (
    auto_id serial,
    card_id integer references cards(auto_id),
    attend_date timestamp NOT NULL,
    ip varchar(32) NOT NULL,
    sid integer references students(id),
    comment text
);

ALTER TABLE attends ADD PRIMARY KEY(auto_id);