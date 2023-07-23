<?php

use PHPUnit\Framework\TestCase;
use FurkanAlkan\UTS;

class UTSTest extends TestCase
{
    private $uts;

    protected function setUp(): void
    {
        $this->uts = new UTS(['token' => 'test-token', 'test' => true]);
    }

    public function testSetAndGetErrorReporting()
    {
        $this->uts->setErrorReporting('E_ALL');
        $this->assertSame('E_ALL', $this->uts->getErrorReporting());
    }

    public function testSetAndGetDisplayErrors()
    {
        $this->uts->setDisplayErrors(1);
        $this->assertSame(1, $this->uts->getDisplayErrors());
    }

    // Test other methods here...
    public function testUretimBildirimi()
    {
        $uno='1111111110324';
        $lno='250515186001';
        $urt=new DateTime('14.07.2023 23:00');
        $adt=1;
        $skt=new DateTime('14.07.2026');
        $response=$this->uts->UretimBildirimi($uno, $lno, '', $urt, $skt, $adt, '', '', '', '', '', '');
        $this->assertEquals('Expected Response', $response);
    }

    public function testIthalatBildirimi()
    {
        $uno='1111111110324';
        $lno='250515186001';
        $urt=new DateTime('14.07.2023 23:00');
        $adt=1;
        $skt=new DateTime('14.07.2026');
        $itt=new DateTime('15.07.2023'); // İthalat tarihi
        $ieu=10; // İthal edilen ürün birim miktarı
        $meu=100; // İthal edilen ürün miktarı
        $gbn='Sample'; // Gümrük beyan numarası

        $response=$this->uts->IthalatBildirimi($uno, $lno, '', $urt, $skt, $itt, $adt, '', $ieu, $meu, $gbn, '', '');
        $this->assertEquals('Expected Response', $response);
    }

    public function testYetkiliBayiIleIthalatBildirimi()
    {
        $uik = 123456; // UIK değeri
        $uno = '1111111110324';
        $lno = '250515186001';
        $urt = new DateTime('14.07.2023 23:00');
        $adt = 1;
        $skt = new DateTime('14.07.2026');
        $itt = new DateTime('15.07.2023');
        $ieu = 10;
        $meu = 100;
        $gbn = 'Sample';

        $response = $this->uts->YetkiliBayiIleIthalatBildirimi($uik, $uno, $lno, '', $urt, $skt, $itt, $adt, '', $ieu, $meu, $gbn, '', '', '');
        $this->assertEquals('Expected Response', $response);
    }

    public function testVermeBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $adt = 1;
        $kun = 5;
        $bno = '123456';
        $git = new DateTime('15.07.2023');

        $response = $this->uts->VermeBildirimi($uno, $lno, '', $adt, $kun, '', $bno, $git);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikBilgisiIleVermeBildirimi()
    {
        $udi = 'unique_id';
        $adt = 1;
        $kun = 5;
        $bno = '123456';

        $response = $this->uts->EssizKimlikBilgisiIleVermeBildirimi($udi, $adt, $kun, $bno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testKozmetikFirmayaVermeBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $adt = 1;
        $kun = 5;
        $bno = '123456';
        $git = new DateTime('15.07.2023');

        $response = $this->uts->KozmetikFirmayaVermeBildirimi($uno, $lno, '', $adt, $kun, $bno, $git);
        $this->assertEquals('Expected Response', $response);
    }

    public function testAlmaBildirimi()
    {
        $vbi = 123456;
        $adt = 1;
        $gkk = 10;
        $udi = 'unique_id';
        $uno = '1111111110324';
        $lno = '250515186001';

        $response = $this->uts->AlmaBildirimi($vbi, $adt, $gkk, $udi, $uno, $lno, '');
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikIleAlmaBildirimi()
    {
        $udi = 'unique_id';
        $adt = 1;
        $gkk = 10;

        $response = $this->uts->EssizKimlikIleAlmaBildirimi($udi, $adt, $gkk);
        $this->assertEquals('Expected Response', $response);
    }

    public function testTanimsizYereVermeBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $adt = 1;
        $ben = 'Sample';
        $vkn = 123456789;
        $bno = '123456';

        $response = $this->uts->TanimsizYereVermeBildirimi($uno, $lno, '', $adt, $ben, $vkn, $bno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikBilgisiIleTanimsizYereVermeBildirimi()
    {
        $udi = 'unique_id';
        $adt = 1;
        $ben = 'Sample';
        $vkn = 123456789;
        $men = 100;
        $tkn = 10;
        $mek = 1000;
        $odk = 10000;
        $bno = '123456';

        $response = $this->uts->EssizKimlikBilgisiIleTanimsizYereVermeBildirimi($udi, $adt, $ben, $vkn, $men, $tkn, $mek, $odk, $bno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testTanimsizYerdenIadeAlmaBildirimi()
    {
        $uti = 123456;
        $adt = 1;
        $udi = 'unique_id';
        $uno = '1111111110324';
        $lno = '250515186001';

        $response = $this->uts->TanimsizYerdenIadeAlmaBildirimi($uti, $adt, $udi, $uno, $lno, '');
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlimBilgisiIleTanimsizYerdenIadeAlmaBildirimi()
    {
        $udi = 'unique_id';
        $adt = 1;

        $response = $this->uts->EssizKimlimBilgisiIleTanimsizYerdenIadeAlmaBildirimi($udi, $adt);
        $this->assertEquals('Expected Response', $response);
    }

    public function testKullanimBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $adt = 1;
        $haa = 'Sample';
        $has = 'Sample';
        $pan = '123456';
        $git = new DateTime('15.07.2023');
        $tur = 'Sample';
        $dta = 'Sample';
        $ydm = 'EVET';

        $response = $this->uts->KullanimBildirimi($uno, $lno, '', $adt, $haa, $has, null, null, $pan, $git, null, $tur, $dta, $ydm);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikBilgisiIleKullanimBildirimi()
    {
        $udi = 'unique_id';
        $adt = 1;
        $haa = 'Sample';
        $has = 'Sample';
        $pan = '123456';
        $git = new DateTime('15.07.2023');
        $tur = 'Sample';
        $dta = 'Sample';
        $ydm = 'EVET';

        $response = $this->uts->EssizKimlikBilgisiIleKullanimBildirimi($udi, $adt, $haa, $has, null, null, $pan, $git, null, $tur, $dta, $ydm);
        $this->assertEquals('Expected Response', $response);
    }

    public function testTuketiciyeVermeBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $adt = 1;
        $ben = 'Sample';
        $tua = 'Sample';
        $tus = 'Sample';
        $pan = '123456';
        $git = new DateTime('15.07.2023');
        $tur = 'Sample';
        $dta = 'Sample';
        $ydm = 'EVET';

        $response = $this->uts->TuketiciyeVermeBildirimi($uno, $lno, '', $adt, $ben, $tua, $tus, null, '', $pan, $git, null, $tur, $dta, $ydm);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikBilgisiIleTuketiciyeVermeBildirimi()
    {
        $udi = 'unique_id';
        $adt = 1;
        $ben = 'Sample';
        $tua = 'Sample';
        $tus = 'Sample';
        $pan = '123456';
        $git = new DateTime('15.07.2023');
        $tur = 'Sample';
        $dta = 'Sample';
        $ydm = 'EVET';

        $response = $this->uts->EssizKimlikBilgisiIleTuketiciyeVermeBildirimi($udi, $adt, $ben, $tua, $tus, null, '', $pan, $git, null, $tur, $dta, $ydm);
        $this->assertEquals('Expected Response', $response);
    }

    public function testTuketicidenIadeAlmaBildirimi()
    {
        $tid = 123456;
        $adt = 1;
        $vkn = 123456;
        $udi = 'unique_id';
        $uno = '1111111110324';
        $lno = '250515186001';

        $response = $this->uts->TuketicidenIadeAlmaBildirimi($tid, $adt, $vkn, $udi, $uno, $lno, '');
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikBilgisiIleTuketicidenIadeAlma()
    {
        $udi = 'unique_id';
        $vkn = 123456;
        $adt = 1;

        $response = $this->uts->EssizKimlikBilgisiIleTuketicidenIadeAlma($udi, $vkn, $adt);
        $this->assertEquals('Expected Response', $response);
    }

    public function testGeciciKullanimaVermeBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $adt = 1;
        $tua = 'Sample';
        $tus = 'Sample';
        $pan = '123456';
        $git = new DateTime('15.07.2023');
        $tur = 'Sample';
        $dta = 'Sample';
        $ydm = 'EVET';

        $response = $this->uts->GeciciKullanimaVermeBildirimi($uno, $lno, '', $adt, $tua, $tus, null, null, $pan, $git, null, $tur, $dta, $ydm);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikBilgisiIleGeciciKullanimaVermeBildirimi()
    {
        $udi = 'unique_id';
        $adt = 1;
        $tua = 'Sample';
        $tus = 'Sample';
        $pan = '123456';
        $git = new DateTime('15.07.2023');
        $tur = 'Sample';
        $dta = 'Sample';
        $ydm = 'EVET';

        $response = $this->uts->EssizKimlikBilgisiIleGeciciKullanimaVermeBildirimi($udi, $adt, $tua, $tus, null, null, $pan, $git, null, $tur, $dta, $ydm);
        $this->assertEquals('Expected Response', $response);
    }

    public function testKullanimdanAlmaBildirimi()
    {
        $gki = 123456;
        $adt = 1;
        $udi = 'unique_id';
        $uno = '1111111110324';
        $lno = '250515186001';

        $response = $this->uts->KullanimdanAlmaBildirimi($gki, $adt, $udi, $uno, $lno, '');
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikBilgisiIleKullanimdanAlma()
    {
        $udi = 'unique_id';
        $adt = 1;

        $response = $this->uts->EssizKimlikBilgisiIleKullanimdanAlma($udi, $adt);
        $this->assertEquals('Expected Response', $response);
    }

    public function testYenidenIslemeBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $adt = 1;

        $response = $this->uts->YenidenIslemeBildirimi($uno, $lno, '', $adt);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikIleYenidenIslemeBildirimi()
    {
        $udi = 'unique_id';
        $adt = 1;

        $response = $this->uts->EssizKimlikIleYenidenIslemeBildirimi($udi, $adt);
        $this->assertEquals('Expected Response', $response);
    }

    public function testIhracatBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $adt = 1;
        $ben = 'Sample';
        $gbn = 'Sample';

        $response = $this->uts->IhracatBildirimi($uno, $lno, '', $adt, $ben, $gbn);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikBilgisiIleIhracatBildirimi()
    {
        $udi = 'unique_id';
        $adt = 1;
        $ben = 'Sample';
        $gbn = 'Sample';

        $response = $this->uts->EssizKimlikBilgisiIleIhracatBildirimi($udi, $adt, $ben, $gbn);
        $this->assertEquals('Expected Response', $response);
    }

    public function testMahrecineIadeEtmeBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $adt = 1;
        $gbn = 'Sample';

        $response = $this->uts->MahrecineIadeEtmeBildirimi($uno, $lno, '', $adt, $gbn);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikBilgisiIleMahrecineIadeEtmeBildirimi()
    {
        $udi = 'unique_id';
        $adt = 1;
        $gbn = 'Sample';

        $response = $this->uts->EssizKimlikBilgisiIleMahrecineIadeEtmeBildirimi($udi, $adt, $gbn);
        $this->assertEquals('Expected Response', $response);
    }

    public function testHekZaiatBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $adt = 1;
        $tur = 'Sample';
        $dta = 'Sample';

        $response = $this->uts->HekZaiatBildirimi($uno, $lno, '', $adt, $tur, $dta);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikBilgisiIleHekZaiatBildirimi()
    {
        $udi = 'unique_id';
        $adt = 1;
        $tur = 'Sample';
        $dta = 'Sample';

        $response = $this->uts->EssizKimlikBilgisiIleHekZaiatBildirimi($udi, $adt, $tur, $dta);
        $this->assertEquals('Expected Response', $response);
    }

    public function testGeriCekmeVermeBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $adt = 1;
        $kun = 2;
        $bno = 'Sample';

        $response = $this->uts->GeriCekmeVermeBildirimi($uno, $lno, '', $adt, $kun, $bno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikBilgisiIleGeriCekmeVermeBildirimi()
    {
        $udi = 'unique_id';
        $adt = 1;
        $kun = 2;
        $bno = 'Sample';

        $response = $this->uts->EssizKimlikBilgisiIleGeriCekmeVermeBildirimi($udi, $adt, $kun, $bno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testGeriCekmeAlmaBildirimi()
    {
        $gvi = 'Sample';
        $adt = 1;
        $udi = 'unique_id';
        $uno = '1111111110324';
        $lno = '250515186001';

        $response = $this->uts->GeriCekmeAlmaBildirimi($gvi, $adt, null, $udi, $uno, $lno, '');
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikBilgisiIleGeriCekmeAlmaBildirimi()
    {
        $udi = 'unique_id';
        $adt = 1;
        $gkk = null;

        $response = $this->uts->EssizKimlikBilgisiIleGeriCekmeAlmaBildirimi($udi, $adt, $gkk);
        $this->assertEquals('Expected Response', $response);
    }

    public function testIslahDuzelticiFaaliyetBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $sno = '';
        $adt = 1;
        $kun = null;

        $response = $this->uts->IslahDuzelticiFaaliyetBildirimi($uno, $lno, $sno, $adt, $kun);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikIleIslahDuzelticiFaaliyetBildirimi()
    {
        $udi = 'unique_id';
        $adt = 1;
        $kun = null;

        $response = $this->uts->EssizKimlikIleIslahDuzelticiFaaliyetBildirimi($udi, $adt, $kun);
        $this->assertEquals('Expected Response', $response);
    }

    public function testImhaBertarafBildirim()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $sno = '';
        $adt = 1;
        $grk = '';
        $dga = '';
        $bno = 'sample_bno';

        $response = $this->uts->ImhaBertarafBildirim($uno, $lno, $sno, $adt, $grk, $dga, $bno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikIleImhaBertarafBildirim()
    {
        $udi = 'unique_id';
        $adt = 1;
        $grk = '';
        $dga = '';
        $bno = 'sample_bno';

        $response = $this->uts->EssizKimlikIleImhaBertarafBildirim($udi, $adt, $grk, $dga, $bno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testHastaninVucudundanCikarmaBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $sno = '';
        $haa = 'sample_haa';
        $has = 'sample_has';
        $tkn = null;
        $ykn = null;
        $pan = 'sample_pan';
        $grk = 'sample_grk';
        $dga = '';
        $git = new DateTime('2023-07-23');
        $ktn = null;
        $tur = 'sample_tur';
        $dta = '';
        $ydm = 'sample_ydm';

        $response = $this->uts->HastaninVucudundanCikarmaBildirimi($uno, $lno, $sno, $haa, $has, $tkn, $ykn, $pan, $grk, $dga, $git, $ktn, $tur, $dta, $ydm);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikIleHastaninVucudundanCikarmaBildirimi()
    {
        $udi = 'unique_id';
        $haa = 'sample_haa';
        $has = 'sample_has';
        $tkn = null;
        $ykn = null;
        $pan = 'sample_pan';
        $grk = 'sample_grk';
        $dga = '';
        $git = new DateTime('2023-07-23');
        $ktn = null;
        $tur = 'sample_tur';
        $dta = '';
        $ydm = 'sample_ydm';

        $response = $this->uts->EssizKimlikIleHastaninVucudundanCikarmaBildirimi($udi, $haa, $has, $tkn, $ykn, $pan, $grk, $dga, $git, $ktn, $tur, $dta, $ydm);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEnvanterBildirimi()
    {
        $uik = 123456;
        $uno = '1111111110324';
        $lno = '250515186001';
        $sno = 'sample_sno';
        $ent = new DateTime('2023-07-01');
        $skt = new DateTime('2023-08-01');
        $sbt = new DateTime('2023-09-01');

        $response = $this->uts->EnvanterBildirimi($uik, $uno, $lno, $sno, $ent, $skt, $sbt);
        $this->assertEquals('Expected Response', $response);
    }

    public function testTuketimBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $sno = 'sample_sno';
        $tyk = null;
        $git = new DateTime('2023-07-23');
        $adt = 1;

        $response = $this->uts->TuketimBildirimi($uno, $lno, $sno, $tyk, $git, $adt);
        $this->assertEquals('Expected Response', $response);
    }

    public function testHizmetSunumBildirimi()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $sno = 'sample_sno';
        $git = new DateTime('2023-07-23');
        $kun = 123;
        $bno = 12345;

        $response = $this->uts->HizmetSunumBildirimi($uno, $lno, $sno, $git, $kun, $bno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testHizmetSunumSonlandirmaBildirimi()
    {
        $bid = 'sample_bid';

        $response = $this->uts->HizmetSunumSonlandirmaBildirimi($bid);
        $this->assertEquals('Expected Response', $response);
    }

    public function testTekilUrunSorgula()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $sno = 'sample_sno';

        $response = $this->uts->TekilUrunSorgula($uno, $lno, $sno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEssizKimlikBilgisiIleTekilUrunSorgula()
    {
        $udi = 'unique_id';

        $response = $this->uts->EssizKimlikBilgisiIleTekilUrunSorgula($udi);
        $this->assertEquals('Expected Response', $response);
    }

    public function testUreticiIthalatciTekilUrunSorgula()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $sno = 'sample_sno';
        $san = 1;

        $response = $this->uts->UreticiIthalatciTekilUrunSorgula($uno, $lno, $sno, $san);
        $this->assertEquals('Expected Response', $response);
    }

    public function testUreticiIthalatciSisteminDisinaCikmisTekilUrunSorgula()
    {
        $uno = '1111111110324';
        $lno = '250515186001';
        $sno = 'sample_sno';
        $san = 1;

        $response = $this->uts->UreticiIthalatciSisteminDisinaCikmisTekilUrunSorgula($uno, $lno, $sno, $san);
        $this->assertEquals('Expected Response', $response);
    }

    public function testAskidakiTekilUrunSorgula()
    {
        $kun = 123456;
        $uno = '1111111110324';
        $lno = '250515186001';
        $sno = 'sample_sno';
        $san = 1;

        $response = $this->uts->AskidakiTekilUrunSorgula($kun, $uno, $lno, $sno, $san);
        $this->assertEquals('Expected Response', $response);
    }

    public function testBildirimSorgula()
    {
        $uno = 'test_uno';
        $lno = 'test_lno';
        $sno = 'test_sno';
        $san = 1;

        $response = $this->uts->BildirimSorgula($uno, $lno, $sno, $san);
        $this->assertEquals('Expected Response', $response);
    }

    public function testKabulEdilecekTekilUrunSorgula()
    {
        $gkk = 1;
        $bno = 'test_bno';
        $uno = 'test_uno';
        $bid = 'test_bid';
        $san = 1;

        $response = $this->uts->KabulEdilecekTekilUrunSorgula($gkk, $bno, $uno, $bid, $san);
        $this->assertEquals('Expected Response', $response);
    }

    public function testKabulEdilecekGeriCekilmisTekilUrunSorgula()
    {
        $gkk = 1;
        $bno = 'test_bno';
        $uno = 'test_uno';
        $bid = 'test_bid';
        $san = 1;

        $response = $this->uts->KabulEdilecekGeriCekilmisTekilUrunSorgula($gkk, $bno, $uno, $bid, $san);
        $this->assertEquals('Expected Response', $response);
    }

    public function testTekilUrununKaynaginiSorgula()
    {
        $uno = 'test_uno';
        $sno = 'test_sno';

        $response = $this->uts->TekilUrununKaynaginiSorgula($uno, $sno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testPiyasayaArzBilgileriSorgula()
    {
        $pab = 'test_pab';
        $urt = 1;

        $response = $this->uts->PiyasayaArzBilgileriSorgula($pab, $urt);
        $this->assertEquals('Expected Response', $response);
    }

    public function testBildirimveTekilUrunDetaySorgula()
    {
        $bid = 'test_bid';

        $response = $this->uts->BildirimveTekilUrunDetaySorgula($bid);
        $this->assertEquals('Expected Response', $response);
    }

    public function testStokYapilabilirTekilUrunBilgileriniSorgula()
    {
        $uno = 'test_uno';
        $sno = 'test_sno';
        $lno = 'test_lno';
        $adt = 10;
        $off = 'test_off';

        $response = $this->uts->StokYapilabilirTekilUrunBilgileriniSorgula($uno, $sno, $lno, $adt, $off);
        $this->assertEquals('Expected Response', $response);
    }

    public function testAyrintiliTekilUrunSorgulama()
    {
        $uno = 'test_uno';
        $sno = 'test_sno';
        $lno = 'test_lno';
        $udi = 'test_udi';
        $uik = null;
        $adt = 15;
        $say = 0;

        $response = $this->uts->AyrintiliTekilUrunSorgulama($uno, $sno, $lno, $udi, $uik, $adt, $say);
        $this->assertEquals('Expected Response', $response);
    }

    public function testAyrintiliBildirimSorgulama()
    {
        $uno='1111111110324';
        $sno='250515186001';
        $lno='250515186001';
        $adt=10;
        $say=1;
        $response = $this->uts->AyrintiliBildirimSorgulama($uno,$sno,$lno,'','','','','','','','','',$adt,$say);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEksikAlmaBildirimleriniGoruntule()
    {
        $adt = 10;
        $off = 'offset_example';
        $response = $this->uts->EksikAlmaBildirimleriniGoruntule($adt, $off);
        $this->assertEquals('Expected Response', $response);
    }

    public function testEksikAlmaBildirimiGorulmeDurumunuGuncelle()
    {
        $bid = 'bid_example';
        $gdr = 'gdr_example';
        $response = $this->uts->EksikAlmaBildirimiGorulmeDurumunuGuncelle($bid, $gdr);
        $this->assertEquals('Expected Response', $response);
    }

    public function testAlmakIstemiyorumOlarakIsaretle()
    {
        $bid = 'bid_example';
        $response = $this->uts->AlmakIstemiyorumOlarakIsaretle($bid);
        $this->assertEquals('Expected Response', $response);
    }

    public function testAlmakIstiyorumOlarakIsaretle()
    {
        $bid = 'bid_example';
        $response = $this->uts->AlmakIstiyorumOlarakIsaretle($bid);
        $this->assertEquals('Expected Response', $response);
    }

    public function testAlinmakIstenmeyenVermeBildirimlerimiSorgula()
    {
        $adt = 10;
        $off = 'offset_example';
        $response = $this->uts->AlinmakIstenmeyenVermeBildirimlerimiSorgula($adt, $off);
        $this->assertEquals('Expected Response', $response);
    }

    public function testAlmakIStemedigimVermeBildirimleriniSorgula()
    {
        $adt = 10;
        $off = 'offset_example';
        $response = $this->uts->AlmakIStemedigimVermeBildirimleriniSorgula($adt, $off);
        $this->assertEquals('Expected Response', $response);
    }

    public function testPaketEkle()
    {
        $pno = 'pno_example';
        $tip = 'tip_example';
        $kno = 1;
        $pli = 'pli_example';
        $tul = ['tul_example'];
        $response = $this->uts->PaketEkle($pno, $tip, $kno, $pli, $tul);
        $this->assertEquals('Expected Response', $response);
    }

    public function testPaketSil()
    {
        $pno = 'pno_example';
        $response = $this->uts->PaketSil($pno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testPaketGetir()
    {
        $pno = 'pno_example';
        $response = $this->uts->PaketGetir($pno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testKurumaGelenPaketiOkunduIsaretle()
    {
        $pno = 'pno_example';
        $kno = 1;
        $response = $this->uts->KurumaGelenPaketiOkunduIsaretle($pno, $kno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testKurumaGelenPaketiGetir()
    {
        $pno = 'pno_example';
        $kno = 1;
        $response = $this->uts->KurumaGelenPaketiGetir($pno, $kno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testKurumaGelenPaketleriSorgula()
    {
        $ekt = new DateTime('2023-08-01');
        $ebt = new DateTime('2023-08-10');
        $okb = 'okb_example';
        $kno = 1;
        $response = $this->uts->KurumaGelenPaketleriSorgula($ekt, $ebt, $okb, $kno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testFirmaSorgulama()
    {
        $mrs = 'mrs_example';
        $vrg = 'vrg_example';
        $unv = 'unv_example';
        $krn = 1;
        $cky = 'cky_example';
        $response = $this->uts->FirmaSorgulama($mrs, $vrg, $unv, $krn, $cky);
        $this->assertEquals('Expected Response', $response);
    }

    public function testUrunSorgulama()
    {
        $uno = 'uno_example';
        $response = $this->uts->UrunSorgulama($uno);
        $this->assertEquals('Expected Response', $response);
    }

    public function testButunUrunleriSorgulama()
    {
        $sayfabuyuklugu = 10;
        $sayfaindeksi = 1;
        $baslangictarihi = new DateTime('2023-08-01');
        $bitistarihi = new DateTime('2023-08-10');
        $response = $this->uts->ButunUrunleriSorgulama($sayfabuyuklugu, $sayfaindeksi, $baslangictarihi, $bitistarihi);
        $this->assertEquals('Expected Response', $response);
    }


    protected function tearDown(): void
    {
        $this->uts = NULL;
    }
}

?>