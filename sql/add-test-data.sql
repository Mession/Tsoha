insert into player(name, password, admin)
values('Pena', 'qwerty', FALSE);

insert into player(name, password, admin)
values('Admin', 'salasana', TRUE);

insert into card(name, manacost, class, description, attack, health)
values('Amani Berserker', 2, 'Neutral', 'Enrage: +3 Attack', 2, 3);

insert into card(name, manacost, class, description, attack, health)
values('Fireball', 4, 'Mage', 'Deal 6 damage.', 0, 0);

insert into card(name, manacost, class, description, attack, health)
values('Doomguard', 5, 'Warlock', 'Charge. Battlecry: Discard two random cards.', 5, 7);

insert into card(name, manacost, class, description, attack, health)
values('Defender of Argus', 4, 'Neutral', 'Battlecry: Give adjacent minions +1/+1 and Taunt.', 2, 3);

insert into deck(name, owner, class)
values('Penan pakka', 1, 'Mage');

insert into deck(name, owner, class)
values('Warlock deck', 2, 'Warlock');

insert into cardsindeck(deck_id, card_id)
values(1, 232);

insert into cardsindeck(deck_id, card_id)
values(1, 232);

insert into cardsindeck(deck_id, card_id)
values(1, 59);

insert into cardsindeck(deck_id, card_id)
values(1, 59);

insert into cardsindeck(deck_id, card_id)
values(1, 265);

insert into cardsindeck(deck_id, card_id)
values(2, 180);

insert into cardsindeck(deck_id, card_id)
values(2, 265);
