<?php
require_once("connect.php");

$hash = md5(microtime());


$sql = "INSERT INTO link (hash) VALUES ('$hash')";
if($con->query($sql)){
} else{
    echo "Ошибка: " . $con->error;
}

$file = "get_url.txt";

$fd = fopen($file,"a");
if(!$fd) {
	exit("Не возможно открыть файл");
}
if(!flock($fd,LOCK_EX)) {
	exit("Блокировка файла не удалась");
}
fwrite($fd,$hash."\n");

if(!flock($fd,LOCK_UN)) {
	exit("Не возможно разблокировать файл");
}
fclose($fd);

$path = substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],"/"));
echo "<p>Ссылка для перехода</p>";
echo "<a href='http://".$_SERVER['HTTP_HOST'].$path."/get_file.php?hash=".$hash."'>http://".$_SERVER['HTTP_HOST'].$path."/get_file.php?hash=".$hash."</a>";
?>