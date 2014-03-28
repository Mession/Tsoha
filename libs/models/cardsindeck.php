<?php

class CardsInDeck {
    private $id;
    private $deck_id;
    private $card_id;
    
    public function __construct($id, $deck_id, $card_id) {
        $this->id = $id;
        $this->deck_id = $deck_id;
        $this->card_id = $card_id;
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