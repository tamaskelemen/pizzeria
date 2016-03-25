
<?php
$host = 'localhost';
$user = 'root';
$password = '';


$connect = @mysql_connect( $host, $user, $password ) or die ( "Error: Can not connect to server" );
 mysql_set_charset('utf8', $connect);
mysql_select_db( "gerla_kiskakas_db", $connect ) or die ( "Can not connect to database" );

?>