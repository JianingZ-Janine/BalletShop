<?php

$link = mysqli_connect('localhost','root','JN0119z..','BalletShop');

if (!$link) { 

die('Could not connect to MySQL: ' . mysqli_error($link)); 

} 

echo 'Connected to the database successfully!';  

?> 

