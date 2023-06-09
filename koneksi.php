<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "register";

$koneksi    = new mysqli ($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

?>