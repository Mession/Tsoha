<?php

class User {
  
  private $id;
  private $name;
  private $password;
  private $admin;

  public function __construct($id, $name, $password, $admin) {
    $this->id = $id;
    $this->name = $name;
    $this->password = $password;
    $this->admin = $admin;
  }
  
  public static function findUserByNameAndPassword($username, $password) {
        $sql = "SELECT id, name, password, admin FROM player where name = ? AND password = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($username, $password));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $user = new User($tulos->id, $tulos->name, $tulos->password, $tulos->admin);
            return $user;
        }
    }

    public static function findAllUsers() {
        $sql = "SELECT id, name, password, admin FROM player";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $user = new User($tulos->id, $tulos->name, $tulos->password, $tulos->admin);

            //$array[] = $muuttuja; lisää muuttujan arrayn perään. 
            //Se vastaa melko suoraan ArrayList:in add-metodia.
            $tulokset[] = $user;
        }
        return $tulokset;
    }

    /* Tähän gettereitä ja settereitä */

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function getAdmin() {
        return $this->admin;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function setAdmin($admin) {
        $this->admin = $admin;
    }
}
