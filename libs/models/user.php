<?php

class User {
  
  private $id;
  private $name;
  private $password;

  public function __construct($id, $name, $password) {
    $this->id = $id;
    $this->name = $name;
    $this->password = $password;
  }
  
  public static function etsiKaikkiKayttajat() {
        $sql = "SELECT id, name, password FROM player";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $user = new User($tulos->id, $tulos->name, $tulos->password);

            //$array[] = $muuttuja; lisää muuttujan arrayn perään. 
            //Se vastaa melko suoraan ArrayList:in add-metodia.
            $tulokset[] = $user;
        }
        return $tulokset;
    }

    /* Tähän gettereitä ja settereitä */
    
    public function getName() {
        return $this->name;
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
}
