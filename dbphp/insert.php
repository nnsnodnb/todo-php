<?php

require_once('../config.php');

$title = $_POST['title'];
$scheduled = $_POST['scheduled'];
$rank = $_POST['rank'];
$chk = 0;

$sql = $dbh->prepare("INSERT INTO task (TITLE , SCHEDULE_DATE , RANK , FINISH_CHECK) VALUES (:title , :scheduled , :rank , :finish_chk)");

$sql->bindValue(':title' , $title , PDO::PARAM_STR);
$sql->bindValue(':scheduled' , $scheduled , PDO::PARAM_STR);
$sql->bindValue(':rank' , $rank , PDO::PARAM_STR);
$sql->bindValue(':finish_chk' , (int) $chk , PDO::PARAM_INT);

$sql->execute();

$dbh = null;

header("Location: ".SITE_URL."");

?>
