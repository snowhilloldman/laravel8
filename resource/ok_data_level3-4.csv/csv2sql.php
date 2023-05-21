<?php

$file = fopen("cities_for_import.csv", "r");

//id, pid, deep, name
//cities_for_import
$sql = "INSERT INTO cities VALUES ";
while (($line = fgets($file)) !== false) {
  $r = str_getcsv($line);
  // $row 是csv行中的各栏位,可以进行处理
  $sql .= "( {$r[0]}, {$r[1]}, {$r[2]}, '{$r[3]}'),";
}

echo $sql . "\r\n";

fclose($file);



// make sql
$file = fopen("cities_for_import.csv", "r");

//id, pid, deep, name
//cities_for_import
$sql = "INSERT INTO cities VALUES ";
while (($line = fgets($file)) !== false) {
  $r = str_getcsv($line);
  // $row 是csv行中的各栏位,可以进行处理
  $sql .= "( {$r[0]}, {$r[1]}, {$r[2]}, '{$r[3]}'),";
}

echo $sql . "\r\n";

fclose($file);