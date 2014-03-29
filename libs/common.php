<?php

session_start();
require_once 'tietokantayhteys.php';

function show($page, $title, $data = array()) {
    $data = (object) $data;
    require 'views/layout.php';
    exit();
}

function showOnlyIfLoggedIn($page, $title, $data = array()) {
    $data = (object) $data;
    if (loggedIn()) {
        show($page, $title, array());
    } else {
        show("views/login.php", "Login", array('error' => "You should be logged in"));
    }
}

function loggedIn() {
    return isset($_SESSION["user"]);
}

function admin() {
    if (!loggedIn()) {
        return false;
    }
    return $_SESSION["admin"];
}