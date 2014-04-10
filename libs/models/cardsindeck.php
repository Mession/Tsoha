<?php
require_once "libs/models/card.php";
require_once "libs/models/deck.php";

class CardsInDeck {
    private $id;
    private $deck_id;
    private $card_id;
    
    public function __construct($id, $deck_id, $card_id) {
        $this->id = $id;
        $this->deck_id = $deck_id;
        $this->card_id = $card_id;
    }
    
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
    
    public static function amountOfCardsInDeckByDeckId($id) {
        $sql = "SELECT id, deck_id, card_id FROM cardsindeck where deck_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));
         
        return $kysely->rowCount();
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
    }

    public function setDeck_id($deck_id) {
        $this->deck_id = $deck_id;
    }

    public function setCard_id($card_id) {
        $this->card_id = $card_id;
    }
}