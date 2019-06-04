<?php 
class DBi {
    public static $conn;
}
DBi::$conn = new mysqli(_DB_HOSTNAME, _DB_USERNAME, _DB_PASSWORD, _DB_NAME);
?>
