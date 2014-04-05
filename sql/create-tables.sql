CREATE TABLE player
(
id serial primary key,
name varchar(20),
password varchar(20),
admin boolean
);

CREATE TABLE card
(
id serial primary key,
name varchar(50),
manacost integer,
class varchar(15),
description varchar(255),
attack integer,
health integer
);

CREATE TABLE deck
(
id serial primary key,
name varchar(20),
owner integer references player(id) on delete cascade on update cascade,
class varchar(15)
);

CREATE TABLE cardsindeck
(
id serial primary key,
deck_id integer references deck(id) on delete cascade on update cascade,
card_id integer references card(id) on delete cascade on update cascade
);





