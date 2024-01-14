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
	$qInfo = "SELECT private, private_key FROM users WHERE username = :username";
	$qInfoPrepared = $dbh->prepare($qInfo);
	$qInfoPrepared->execute(array(':username' => $_POST['name']));
	$qInfoResults = $qInfoPrepared->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
	http_response_code(403);
	die();
}
if($qInfoResults['private'] == '1') {
	if(empty($_POST['key'])){
		http_response_code(403);
		die();
	}
		elseif($_POST['key'] == $qInfoResults['private_key']) {
	        http_response_code(200);
        	die();
	}
	else {
		http_response_code(403);
		die();
	}
}
?>
