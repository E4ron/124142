<?php
require_once("connect.php");
$hash = $_GET['hash'];

$sql = "SELECT * FROM `link` WHERE `hash` = '$hash'";

if(!$con->query($sql)) {
exit("Ой какаята осибочка");
} 

$check = true;

if(strlen($hash) != 32) {
	exit("Не правильныая ссылка");
}

if($check) {
	echo "<h3>Добро пожаловать</h3>";
	$sql = "DELETE FROM `link` WHERE `hash` = '$hash'";
	$con->query($sql);
} else{
	exit("Ой что-то пошло не так :D");
}


?>