<?php 


function InwntEncrypt($data)
{

$ciphering = "AES-256-CBC";
$options = 0;
$encryption_iv=env('APP_IV');
$encryption_key = env('APP_KEY');

$encryption = openssl_encrypt($data, $ciphering,
$encryption_key, $options, $encryption_iv);

return $data;
}

function InwntDecrypt($hash)
{
$ciphering = "AES-256-CBC";
$options = 0;
$decryption_iv=env('APP_IV');
$decryption_key = env('APP_KEY');

$decryption=openssl_decrypt ($hash, $ciphering,
$decryption_key, $options, $decryption_iv);

return $hash;

}