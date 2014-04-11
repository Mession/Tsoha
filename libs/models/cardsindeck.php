<?php
require_once "libs/models/card.php";
require_once "libs/models/deck.php";

class CardsInDeck {
    private $id;
    private $deck_id;
    private $card_id;
    private $errors = array();
    
    public function __construct($id, $deck_id, $card_id) {
        $this->id = $id;
        $this->deck_id = $deck_id;
        $this->card_id = $card_id;
    }
    
    // kuinka monta tiettyä korttia on pakassa, tällä tarkistetaan, ettei samaa korttia ole yli kahta kertaa samassa pakassa
    public static function howManySpecificCardsInDeck($did, $cid) {
        $sql = "SELECT id, deck_id, card_id FROM cardsindeck where deck_id = ? and card_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($did, $cid));
         
        return $kysely->rowCount();
    }
    
    // etsitään yhden pakan kaikki kortit
    public static function findCardsByDeckId($id) {
        $sql = "SELECT id, deck_id, card_id FROM cardsindeck where deck_id = ? ORDER BY card_id";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
        
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $card = Card::findCardById($tulos->card_id);

            if ($card != null) {
                $tulokset[] = $card;
            }
        }
        return $tulokset;
    }
    
    // etsitään yksittäinen tietoalkio tietokannasta
    public static function findEntryByDeckAndCardId($id, $cid) {
        $sql = "SELECT id, deck_id, card_id FROM cardsindeck where deck_id = ? and card_id = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id, $cid));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $cardsindeck = new CardsInDeck($tulos->id, $tulos->deck_id, $tulos->card_id);
            return $cardsindeck;
        }
    }
    
    // pakan koko
    public static function amountOfCardsInDeckByDeckId($id) {
        $sql = "SELECT id, deck_id, card_id FROM cardsindeck where deck_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
         
        return $kysely->rowCount();
    }
    
    // onko pakka täynnä
    public static function deckIsFull($id) {
        if (CardsInDeck::amountOfCardsInDeckByDeckId($id) == 30) {
            return true;
        }
        return false;
    }
    
    public function attributesCorrect() {
        return empty($this->errors);
    }
    
    public function getErrors() {
        return $this->errors;
    }
    
    public function insert() {
        $sql = "INSERT INTO CardsInDeck(deck_id, card_id) VALUES(?,?) RETURNING id";
        $kysely = getTietokantayhteys()->prepare($sql);
        
        $ok = $kysely->execute(array($this->getDeck_id(), $this->getCard_id()));
        if ($ok) {
            $this->id = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    public function destroy() {
        $sql = "DELETE from CardsInDeck WHERE id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getId()));
    }
    
    public function getId() {
        return $this->id;
    }

    public function getDeck_id() {
        return $this->deck_id;
    }

    public function getCard_id() {
        return $this->card_id;
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

    public function setDeck_id($deck_id) {
        $this->deck_id = $deck_id;
        if (!is_numeric($deck_id)) {
            $this->errors['did'] = "Deck id should be a number";
        } else if ($deck_id <= 0) {
            $this->errors['did'] = "Deck id should be greater than one";
        } else if (!preg_match('/^\d+$/', $deck_id)) {
            $this->errors['did'] = "Deck id should be an integer";
        } else {
            unset($this->errors['did']);
        }
    }

    public function setCard_id($card_id) {
        $this->card_id = $card_id;
        if (!is_numeric($card_id)) {
            $this->errors['cid'] = "Card id should be a number";
        } else if ($card_id <= 0) {
            $this->errors['cid'] = "Card id should be greater than one";
        } else if (!preg_match('/^\d+$/', $card_id)) {
            $this->errors['cid'] = "Card id should be an integer";
        } else {
            unset($this->errors['cid']);
        }
        $cardclass = Card::findCardById($card_id)->getClass();
        $deckclass = Deck::findDeckById($this->deck_id)->getClass();
        if ($cardclass != "Neutral" && $cardclass != $deckclass) {
            $this->errors['cid'] = "Card should be from the neutral or the " . strtolower($deckclass) . " class";
        } else {
            unset($this->errors['cid']);
        }
    }
}