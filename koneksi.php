<?php 
 
$host = "localhost";
$user = "root";
$password = "";
$database = "program_akademik";
 
$koneksi = mysqli_connect($host,$user,$password,$database);
 
if($koneksi->connect_error){
	die("Koneksi gagal");
}
 
?>