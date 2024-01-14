<?php
$host = "109.123.240.123";
$username = "sql_ostream_onli";
$password = "GF2jmi82JLsFGcLc";
$dbname = "sql_ostream_onli";

try {
	$dbh = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $username, $password);
}
catch(PDOException $e) {
	http_response_code(403);
	die();
}
if(empty($_POST['name'])) {
	http_response_code(403);
	die();
}
try {
	$qUpdate = "UPDATE users SET live_status=0 WHERE stream_key = :stream_key";
	$qUpdatePrep = $dbh->prepare($qUpdate);
	$qUpdatePrep->execute(array(':stream_key' => $_POST['name']));
}
catch(PDOException $e) {
	http_response_code(403);
	die();
}
?>
