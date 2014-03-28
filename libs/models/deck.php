<?php

class Deck {
    
    private $id;
    private $name;
    private $owner;
    private $class;
    
    public function __construct($id, $name, $owner, $class) {
        $this->id = $id;
        $this->name = $name;
        $this->owner = $owner;
        $this->class = $class;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function setOwner($owner) {
        $this->owner = $owner;
    }
    
    public function setClass($class) {
        $this->class = $class;
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