<?php

class Card {
    
    private $id;
    private $name;
    private $manacost;
    private $class;
    private $description;
    private $attack;
    private $health;
    
    public function __construct($id, $name, $manacost, $class, $description, $attack, $health) {
        $this->id = $id;
        $this->name = $name;
        $this->manacost = $manacost;
        $this->class = $class;
        $this->description = $description;
        $this->attack = $attack;
        $this->health = $health;
    }
    
    public static function findCardByName($name) {
        $sql = "SELECT id, name, manacost, class, description, attack, health FROM card where name = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($name));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $card = new Card($tulos->id, $tulos->name, $tulos->manacost, $tulos->class, $tulos->description, $tulos->attack, $tulos->health);
            return $card;
        }
    }
    
    public static function findCardById($id) {
        $sql = "SELECT id, name, manacost, class, description, attack, health FROM card where id = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $card = new Card($tulos->id, $tulos->name, $tulos->manacost, $tulos->class, $tulos->description, $tulos->attack, $tulos->health);
            return $card;
        }
    }

    public static function findAllCards() {
        $sql = "SELECT id, name, manacost, class, description, attack, health FROM card";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $card = new Card($tulos->id, $tulos->name, $tulos->manacost, $tulos->class, $tulos->description, $tulos->attack, $tulos->health);

            //$array[] = $muuttuja; lisää muuttujan arrayn perään. 
            //Se vastaa melko suoraan ArrayList:in add-metodia.
            $tulokset[] = $card;
        }
        return $tulokset;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getManacost() {
        return $this->manacost;
    }

    public function getClass() {
        return $this->class;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getAttack() {
        return $this->attack;
    }

    public function getHealth() {
        return $this->health;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setManacost($manacost) {
        $this->manacost = $manacost;
    }

    public function setClass($class) {
        $this->class = $class;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setAttack($attack) {
        $this->attack = $attack;
    }

    public function setHealth($health) {
        $this->health = $health;
    }
}