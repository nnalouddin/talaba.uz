<?php

$host = "localhost";  // Server manzili
$user = "root";       // MySQL foydalanuvchisi
$password = "";       // XAMPP da odatda parol bo‘sh
$database = "student"; // Baza nomi

$conn = mysqli_connect($host, $user, $password, $database);

mysqli_set_charset($conn, "utf8mb4");
