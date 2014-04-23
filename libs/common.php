<?php

session_start();
require_once 'tietokantayhteys.php';

function show($page, $title, $data = array()) {
    $data = (object) $data;
    require 'views/layout.php';
    exit();
}

function redirect($page) {
    header('Location: ' . $page);
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

function logout() {
    unset($_SESSION["user"]);
    unset($_SESSION["userid"]);
    unset($_SESSION["name"]);
    unset($_SESSION["admin"]);
}

function login($user) {
    $_SESSION["user"] = $user;
    $_SESSION["userid"] = $user->getId();
    $_SESSION["name"] = $user->getName();
    $_SESSION["admin"] = $user->getAdmin();
}