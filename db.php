<?php
$conn = new mysqli("localhost", "root", "", "travelguide_db");
if ($conn->connect_error) {
  die("Database connection failed");
}
?>
