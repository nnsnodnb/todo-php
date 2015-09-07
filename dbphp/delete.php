<?php

require_once('../config.php');

$del_key = $_POST['delete-key'];

$sql = 'DELETE FROM task WHERE ID = :del_key';
$stmt = $dbh->prepare($sql);
$stmt->execute(array(':del_key' => $del_key));

$dbh = null;

header("Location: ".SITE_URL."");

?>
