<?php  

define( 'DB_HOST', 'localhost' );
define( 'DB_USER', '' );
define( 'DB_PASS', '' );
define( 'DB_NAME', '' );
define( 'DB_CHARSET', 'utf8mb4' );

$conn = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME );
mysqli_set_charset($conn, DB_CHARSET);

?>