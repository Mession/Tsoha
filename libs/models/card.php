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
    
    // apumetodi, joka pitää suorittaa aina, kun kortit tuodaan jsonista, eli populate.php:n jälkeen (muuten luokat eivät toimi)
    public static function trimClass() {
        $cards = Card::findAllCards();
        foreach ($cards as $card) {
            $card->setClass(trim($card->getClass()));
            $card->update();
        }
    }
    
    // etsitään kaikki tietyn luokan kortit + neutral kortit, jotta nämä voidaan tarjota käyttäjälle pakkaan
    public static function findAllCardsByClassIncludeNeutrals($class) {
        $sql = "SELECT id, name, manacost, class, description, attack, health FROM card WHERE class = ? or class = ? ORDER BY name";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($class, "Neutral"));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $card = new Card($tulos->id, $tulos->name, $tulos->manacost, $tulos->class, $tulos->description, $tulos->attack, $tulos->health);
            $tulokset[] = $card;
        }
        return $tulokset;
    }

    public static function findAllCards() {
        $sql = "SELECT id, name, manacost, class, description, attack, health FROM card ORDER BY name";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $card = new Card($tulos->id, $tulos->name, $tulos->manacost, $tulos->class, $tulos->description, $tulos->attack, $tulos->health);
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
        return Card::amount() == 0;
    }
    
    public static function amount() {
        $sql = "SELECT id, name, manacost, class, description, attack, health FROM card ORDER BY name";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        
        return $kysely->rowCount();
    }
    
    public static function amountByClassIncludeNeutrals($class) {
        $sql = "SELECT id, name, manacost, class, description, attack, health FROM card WHERE class = ? or class = ? ORDER BY name";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($class, "Neutral"));
        
        return $kysely->rowCount();
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
        $this->name = trim($name);
        if (trim($this->name) == "") {
            $this->errors['name'] = "Name cannot be blank";
        } elseif (strlen($name) > 50) {
            $this->errors['name'] = "Name cannot be over 50 characters long";
        } else {
            unset($this->errors['name']);
        }
    }

    public function setManacost($manacost) {
        $this->manacost = $manacost;
        if (!is_numeric($manacost)) {
            $this->errors['manacost'] = "Mana cost should be a number";
        } else if ($manacost < 0) {
            $this->errors['manacost'] = "Mana cost cannot be negative";
        } else if (!preg_match('/^\d+$/', $manacost)) {
            $this->errors['manacost'] = "Mana cost should be an integer";
        } else {
            unset($this->errors['manacost']);
        }
    }

    public function setClass($class) {
        $this->class = trim($class);
        if (strlen($class) > 15) {
            $this->errors['class'] = "Class cannot be over 15 characters long";
        } else {
            unset($this->errors['class']);
        }
    }

    public function setDescription($description) {
        $this->description = $description;
        if (strlen($description) > 255) {
            $this->errors['description'] = "Description cannot be over 255 characters long";
        } else {
            unset($this->errors['description']);
        }
    }

    public function setAttack($attack) {
        $this->attack = $attack;
        if (!is_numeric($attack)) {
            $this->errors['attack'] = "Attack should be a number";
        } else if ($attack < 0) {
            $this->errors['attack'] = "Attack cannot be negative";
        } else if (!preg_match('/^\d+$/', $attack)) {
            $this->errors['attack'] = "Attack should be an integer";
        } else {
            unset($this->errors['attack']);
        }
    }

    public function setHealth($health) {
        $this->health = $health;
        if (!is_numeric($health)) {
            $this->errors['health'] = "Health should be a number";
        } else if ($health < 0) {
            $this->errors['health'] = "Health cannot be negative";
        } else if (!preg_match('/^\d+$/', $health)) {
            $this->errors['health'] = "Health should be an integer";
        } else {
            unset($this->errors['health']);
        }
    }
}