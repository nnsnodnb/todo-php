<?php

require_once('../config.php');

$id = $_GET['id'];

date_default_timezone_set('Asia/Tokyo');
$date = date("Y/m/d");


$chk = 1;

$sql = 'UPDATE task SET FINISH_DATE = :fin_date , FINISH_CHECK = :finish_chk WHERE ID = :id';
$stmt = $dbh->prepare($sql);
$stmt->execute(array(':fin_date' => $date , ':finish_chk' => (int)$chk , ':id' => $id));

$dbh = null;

header("Location: ".SITE_URL."");

?>
