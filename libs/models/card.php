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