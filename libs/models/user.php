<?php

class User {

    private $id;
    private $name;
    private $password;
    private $admin;
    private $errors = array();

    public function __construct($id, $name, $password, $admin) {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
        $this->admin = $admin;
    }

    public function attributesCorrect() {
        return empty($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }

    public function insert() {
        $sql = "INSERT INTO Player(name, password, admin) VALUES(?,?,?) RETURNING id";
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($this->getName(), $this->getPassword(), $this->getAdmin()));
        if ($ok) {
            $this->id = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    public function update() {
        $sql = "UPDATE Player SET name = ?, password = ? WHERE id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getName(), $this->getPassword(), $this->getId()));
    }
    
    public function destroy() {
        $sql = "DELETE from Player WHERE id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getId()));
    }
    
    public static function tableIsEmpty() {
        return User::amount() == 0;
    }
    
    public static function amount() {
        $sql = "SELECT id, name, password, admin FROM Player ORDER BY name";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        
        return $kysely->rowCount();
    }

    public static function findUserByName($username) {
        $sql = "SELECT id, name, password, admin FROM player where name = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($username));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $user = new User($tulos->id, $tulos->name, $tulos->password, $tulos->admin);
            return $user;
        }
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

    public static function findUserById($id) {
        $sql = "SELECT id, name, password, admin FROM player where id = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $user = new User($tulos->id, $tulos->name, $tulos->password, $tulos->admin);
            return $user;
        }
    }

    public static function findAllUsers() {
        $sql = "SELECT id, name, password, admin FROM player ORDER BY id";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $user = new User($tulos->id, $tulos->name, $tulos->password, $tulos->admin);
            $tulokset[] = $user;
        }
        return $tulokset;
    }

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

    public function setPassword($password) {
        $this->password = $password;
        if (trim($this->password) == "") {
            $this->errors['password'] = "Password cannot be blank";
        } elseif (strlen($password) > 20) {
            $this->errors['password'] = "Password cannot be over 20 characters long";
        } else {
            unset($this->errors['password']);
        }
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
    }
}
