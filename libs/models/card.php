<?php

class Card {
    
    private $id;
    private $name;
    private $manacost;
    private $class;
    private $description;
    private $attack;
    private $health;
    private $errors = array();
    
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
        $sql = "SELECT id, name, manacost, class, description, attack, health FROM card ORDER BY name";
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
    
    public function insert() {
        $sql = "INSERT INTO Card(name, manacost, class, description, attack, health) VALUES(?,?,?,?,?,?) RETURNING id";
        $kysely = getTietokantayhteys()->prepare($sql);
        
        $ok = $kysely->execute(array($this->getName(), $this->getManacost(), $this->getClass(), $this->getDescription(), $this->getAttack(), $this->getHealth()));
        if ($ok) {
            $this->id = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    public function update() {
        $sql = "UPDATE Card SET name = ?, manacost = ?, class = ?, description = ?, attack = ?, health = ? WHERE id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getName(), $this->getManacost(), $this->getClass(), $this->getDescription(), $this->getAttack(), $this->getHealth(), $this->getId()));
    }
    
    public function destroy() {
        $sql = "DELETE from Card WHERE id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getId()));
    }
    
    public static function tableIsEmpty() {
        $sql = "SELECT id, name, manacost, class, description, attack, health FROM card ORDER BY name";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        return $kysely->rowCount() == 0;
    }
    
    public function attributesCorrect() {
        return empty($this->errors);
    }
    
    public function getErrors() {
        return $this->errors;
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
        if (!is_numeric($id)) {
            $this->errors['id'] = "Id should be a number";
        } else if ($id <= 0) {
            $this->errors['id'] = "Id should be greater than one";
        } else if (!preg_match('/^\d+$/', $id)) {
            $this->errors['id'] = "Id should be an integer";
        } else {
            unset($this->errors['id']);
        }
    }

    public function setName($name) {
        $this->name = $name;
        if (trim($this->name) == "") {
            $this->errors['name'] = "Name cannot be blank";
        } else {
            unset($this->errors['name']);
        }
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