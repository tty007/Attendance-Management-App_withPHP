DROP TABLE pids;

CREATE TABLE pids (
    auto_id serial,
    pid integer UNIQUE
);

ALTER TABLE pids ADD PRIMARY KEY(auto_id);