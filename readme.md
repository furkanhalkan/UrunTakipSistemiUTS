
# Ürün Takip Sistemi (UTS) 

Ürün Takip Sistemi (UTS) [saglik.gov.tr](https://saglik.gov.tr)'nin Bir Portalıdır. Bu Portala PHP API İle Bağlanıp İşlemlerinizi Gerçekleştirebilirsiniz.



[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)

  
## Kurulum

Gerekli paketleri yükleyin

```bash
  composer install
```

Test İçin

```bash
  composer test
```

  
## Dikkat!

- Test İçin Lütfen Test Adresinden Token Alınız ve tests klasörü içindeki `UTSTest.php` içerisindeki `"test-token"` alanına token kodunuzu giriniz.



  
## Kullanımı

#### Dosyayı İçe Aktarma

```
  include_once('src/UTS.php');
```


#### Kullanımı

```
  use FurkanAlkan\UTS;
  $uts=new UTS(['token' => 'token', 'test' => false]);
```

| Parametre | Tip     | Açıklama                       |
| :-------- | :------- | :-------------------------------- |
| `token`      | `string` | **saglik.gov.tr** Adresinden Alınan Token |
| `test`      | `boolen` | Test Ortamında veya Gerçek Ortamda Test Edilmesi Gereken Alan |

#### Örnek Kullanım

```
$uno='1111111110324';
$lno='250515186001';
$urt=new DateTime('14.07.2023 23:00');
$adt=1;
$skt=new DateTime('14.07.2026');
$response=$uts->UretimBildirimi($uno, $lno, '', $urt, $skt, $adt, '', '', '', '', '', '');
```

## Uyarı !
**Aşağıdaki Dökümantasyon Kısmını Okuyup Veri Tiplerinin Ne İşe Yaradığını Görebilirsiniz.**  
## Dökümantasyon

[Pdf Dökümantasyon](https://github.com/furkanhalkan/UrunTakipSistemiUTS/blob/main/doc/UTS-PRJ-TakipVeIzlemeWebServisTanimlariDokumani.pdf) ile saglik.gov.tr'nin yayınladığı API gereksinimlerini isteyen ve kullanım örneği olan dökümantasyona gidebilirsiniz.

  