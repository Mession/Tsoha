<?php

class Deck {
    
    private $id;
    private $name;
    private $owner;
    private $class;
    private $errors = array();
    
    public function __construct($id, $name, $owner, $class) {
        $this->id = $id;
        $this->name = $name;
        $this->owner = $owner;
        $this->class = $class;
    }
    
    public static function findDeckByName($name) {
        $sql = "SELECT id, name, owner, class FROM deck where name = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($name));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $card = new Deck($tulos->id, $tulos->name, $tulos->owner, $tulos->class);
            return $card;
        }
    }
    
    public static function findDecksByOwner($id) {
        $sql = "SELECT id, name, owner, class FROM deck where owner = ? ORDER BY name";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
        
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $deck = new Deck($tulos->id, $tulos->name, $tulos->owner, $tulos->class);

            //$array[] = $muuttuja; lisää muuttujan arrayn perään. 
            //Se vastaa melko suoraan ArrayList:in add-metodia.
            $tulokset[] = $deck;
        }
        return $tulokset;
    }
    
    public static function findDeckById($id) {
        $sql = "SELECT id, name, owner, class FROM deck where id = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $deck = new Deck($tulos->id, $tulos->name, $tulos->owner, $tulos->class);
            return $deck;
        }
    }

    public static function findAllDecks() {
        $sql = "SELECT id, name, owner, class FROM deck ORDER BY name";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $deck = new Deck($tulos->id, $tulos->name, $tulos->owner, $tulos->class);

            //$array[] = $muuttuja; lisää muuttujan arrayn perään. 
            //Se vastaa melko suoraan ArrayList:in add-metodia.
            $tulokset[] = $deck;
        }
        return $tulokset;
    }
    
    public function insert() {
        $sql = "INSERT INTO Deck(name, owner, class) VALUES(?,?,?) RETURNING id";
        $kysely = getTietokantayhteys()->prepare($sql);
        
        $ok = $kysely->execute(array($this->getName(), $this->getOwner(), $this->getClass()));
        if ($ok) {
            $this->id = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    public function update() {
        $sql = "UPDATE Deck SET name = ?, owner = ?, class = ? WHERE id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getName(), $this->getOwner(), $this->getClass(), $this->getId()));
    }
    
    public function destroy() {
        $sql = "DELETE from Deck WHERE id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getId()));
    }
    
    public static function tableIsEmpty() {
        $sql = "SELECT id, name, owner, class FROM Deck ORDER BY name";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        
        return $kysely->rowCount() == 0;
    }
    
    public static function amount() {
        $sql = "SELECT id, name, owner, class FROM Deck ORDER BY name";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        
        return $kysely->rowCount();
    }
    
    public function attributesCorrect() {
        return empty($this->errors);
    }
    
    public function getErrors() {
        return $this->errors;
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
        } elseif (strlen($name) > 20) {
            $this->errors['name'] = "Name cannot be over 20 characters long";
        } else {
            unset($this->errors['name']);
        }
    }
    
    public function setOwner($owner) {
        $this->owner = $owner;
        if (!is_numeric($owner)) {
            $this->errors['owner'] = "Owner id should be a number";
        } else if ($owner < 1) {
            $this->errors['owner'] = "Owner id must be greater than or equal to one";
        } else if (!preg_match('/^\d+$/', $owner)) {
            $this->errors['owner'] = "Owner id should be an integer";
        } else {
            unset($this->errors['owner']);
        }
    }
    
    public function setClass($class) {
        $this->class = $class;
        if (strlen($class) > 15) {
            $this->errors['class'] = "Class cannot be over 15 characters long";
        } else {
            unset($this->errors['class']);
        }
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getOwner() {
        return $this->owner;
    }
    
    public function getClass() {
        return $this->class;
    }
}