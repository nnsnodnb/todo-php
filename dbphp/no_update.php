<?php

require_once('../config.php');

session_start();

$title = $_POST['title'];
$scheduled = $_POST['scheduled'];
$rank = $_POST['rank'];

$sql = 'UPDATE task SET TITLE = :title , SCHEDULE_DATE = :schedule , RANK = :rank WHERE ID = :id';
$stmt = $dbh->prepare($sql);
$stmt->execute(array(':title' => $title , ':schedule' => $scheduled , ':rank' => $rank , 'id' => $_SESSION['noid']));

$dbh = null;

header("Location: ".SITE_URL."");

?>
