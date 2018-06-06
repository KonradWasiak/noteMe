<?php
session_start();
$word = $_POST['word'];
if(isset($_SESSION['userID']))
{
$panel = './../../panelClass/panel.php';
require $panel;

$pane = new panel();
$config = './../../../accounts/config.php';
require $config;
$pdo = new PDO("mysql:host=$server;dbname=$database", $usr, $passwd);
$pdo->exec("set names utf8");
}
else
{
    //cookies ze zlego logowania
    header('Location:./../../../../index.php');
}
if(strlen($word) > 0 ) $pane->showUsernamesbyLetter($pdo,$word);
else echo json_encode("");
?>