<?php 
include_once("open_ssl.php");
$security = New Security();

$data = [];

for ($i=0; $i < 100 ; $i++) { 
    $data[] = [
        'name' => 'user '.$i,
        'password' => 'user'.$i,
    ]; 
}

$dataEncrypt = [];
foreach ($data as $key => $value) {
    $value['password'] = $security->encrypt($value['password']); 
    $dataEncrypt[] = $value;
}

$dataDecrypt = [];
foreach ($dataEncrypt as $key => $value) {
    $value['password'] = $security->decrypt($value['password']); 
    $dataDecrypt[] = $value;
}

echo '<pre>';
echo 'data Awal <br>';
print_r($data);
echo 'data ENKRIP =================================================================================<br>';
print_r($dataEncrypt);
echo 'data DEKRIP =================================================================================<br>';
print_r($dataDecrypt);
echo '</pre>';