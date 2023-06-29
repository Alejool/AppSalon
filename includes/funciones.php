<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function mostrarErrores(){
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

}

function verificarAuth ():void{
    if (!isset($_SESSION['login'] )){
        header('location: /');
    }
    
}

function isAdmin():void{
    if (!isset($_SESSION['admin'])){
        header('location: /');
    }
}

function verificarAdmin():void{
    if (isset($_SESSION['admin'] )){
        header('location: /admin');
    }
}