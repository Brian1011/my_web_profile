<?php
//create connection
$conn = mysqli_connect("localhost","root","developers","football");

if(!$conn){
	die("connection failed".mysqli_connect_error());
}