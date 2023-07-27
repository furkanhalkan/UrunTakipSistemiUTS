<?php
include_once '../src/UTS.php';
include_once '../vendor/autoload.php';

use FurkanAlkan\UTS;
$uts=new UTS(['token' => 'token-kodu', 'test' => true]);

print_r($uts->KabulEdilecekTekilUrunSorgulaKayitSayisi());
/* 
Kabul Edilecek Tekil Ürün Sorgula Servis Adresi (Kayıt Sayısı Parametresi ile)
Dökümantasyon Sayfası 3.4.11 Madde (Sayfa:138)
*/

?>