<?php
namespace FurkanAlkan;

use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class UTS
{
    protected $errorReporting = 'E_ALL';
    
    protected $displayErrors = 0;

    public function setErrorReporting($value)
    {
        $this->errorReporting = $value;
    }

    public function setDisplayErrors($value)
    {
        $this->displayErrors = $value;
    }

    public function getErrorReporting()
    {
        return $this->errorReporting;
    }

    public function getDisplayErrors()
    {
        return $this->displayErrors;
    }

    public $Token='';
    public $Test=false;
    public $Url='https://utsuygulama.saglik.gov.tr/';

    public function __construct(array $request)
    {
        if(isset($request['token']))
        {
            $this->Token=$request['token'];
            if(isset($request['test']))
            {
                if($request["test"]==true)
                {
                    $this->Test=true;
                    $this->Url='https://utstest.saglik.gov.tr/';
                }
                else
                {
                    $this->Test=false;
                    $this->Url='https://utsuygulama.saglik.gov.tr/';
                }
            }
        }
        else
        {
            $errorReporting="Error: Missing or incorrect entry";
        }
    }

    public function UretimBildirimi(string $uno,string $lno='',string $sno='',DateTime $urt, DateTime $skt='',int $adt,string $udi='',array $sip='',array $kus='',array $gtk='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/uretim/ekle';
        $data = array(
            'UNO' => $uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'URT'=>$urt->format('Y-m-d'),
            'SKT'=>$skt->format('Y-m-d H'),
            'ADT'=>$adt,
            'UDI'=>$udi,
            'SIP'=>$sip,
            'KUS'=>$kus,
            'GTK'=>$gtk,
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function IthalatBildirimi(string $uno, string $lno='',string $sno='',DateTime $urt,DateTime $skt='',DateTime $itt='',int $adt='',string $udi='',int $ieu,int $meu,string $gbn='',array $kus='',array $gtk='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/ithalat/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'URT'=>$urt->format('Y-m-d'),
            'SKT'=>$skt->format('Y-m-d H'),
            'ITT'=>$itt->format('Y-m-d'),
            'ADT'=>$adt,
            'UDI'=>$udi,
            'IEU'=>$ieu,
            'MEU'=>$meu,
            'GBN'=>$gbn,
            'KUS'=>$kus,
            'GTK'=>$gtk
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function YetkiliBayiIleIthalatBildirimi(int $uik, string $uno, string $lno='', string $sno='', DateTime $urt, DateTime $skt='', DateTime $itt='', int $adt, string $udi='', int $ieu, int $meu, string $gbn='', array $sip='', array $kus='', array $gtk='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/ithalat/yetkiliBayiIle/ekle';
        $data=array(
            'UIK'=>$uik,
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'URT'=>$urt->format('Y-m-d'),
            'SKT'=>$skt->format('Y-m-d H'),
            'ITT'=>$itt->format('Y-m-d'),
            'ADT'=>$adt,
            'UDI'=>$udi,
            'IEU'=>$ieu,
            'MEU'=>$meu,
            'GBN'=>$gbn,
            'SIP'=>$sip,
            'KUS'=>$kus,
            'GTK'=>$gtk
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function VermeBildirimi(string $uno, string $lno='', string $sno='', int $adt, int $kun, string $ben='', string $bno, DateTime $git='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/verme/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'ADT'=>$adt,
            'KUN'=>$kun,
            'BEN'=>$ben,
            'BNO'=>$bno,
            'GIT'=>$git->format('Y-m-d')
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikBilgisiIleVermeBildirimi(string $udi, int $adt, int $kun, string $bno)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/verme/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt,
            'KUN'=>$kun,
            'BNO'=>$bno
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function KozmetikFirmayaVermeBildirimi(string $uno, string $lno='', string $sno='', int $adt, int $kun, string $bno, DateTime $git)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/kozmetikFirmayaVerme/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'ADT'=>$adt,
            'KUN'=>$kun,
            'BNO'=>$bno,
            'GIT'=>$git->format('Y-m-d')
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function AlmaBildirimi(int $vbi='', int $adt, int $gkk='', string $udi='', string $uno='', string $lno='', string $sno='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/alma/ekle';
        $data=array(
            'VBI'=>$vbi,
            'ADT'=>$adt,
            'GKK'=>$gkk,
            'UDI'=>$udi,
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikIleAlmaBildirimi(string $udi,int $adt, int $gkk='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/alma/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt,
            'GKK'=>$gkk
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function TanimsizYereVermeBildirimi(string $uno, string $lno='', string $sno='', int $adt, string $ben='', int $vkn, string $bno)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/utsdeTanimsizYereVerme/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'ADT'=>$adt,
            'BEN'=>$ben,
            'VKN'=>$vkn,
            'BNO'=>$bno
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikBilgisiIleTanimsizYereVermeBildirimi(string $udi, int $adt, string $ben='', int $vkn, int $men='', int $tkn='', int $mek='', int $odk='', string $bno)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/utsdeTanimsizYereVerme/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt,
            'BEN'=>$ben,
            'VKN'=>$vkn,
            'MEN'=>$men,
            'TKN'=>$tkn,
            'MEK'=>$mek,
            'ODK'=>$odk,
            'BNO'=>$bno
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function TanimsizYerdenIadeAlmaBildirimi(int $uti='', int $adt, string $udi='', string $uno='', string $lno='',  string $sno='', )
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/utsdeTanimsizYerdenIadeAlma/ekle';
        $data=array(
            'UTI'=>$uti,
            'ADT'=>$adt,
            'UDI'=>$udi,
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlimBilgisiIleTanimsizYerdenIadeAlmaBildirimi(string $udi, int $adt)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/utsdeTanimsizYerdenIadeAlma/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function KullanimBildirimi(string $uno, string $lno='', string $sno='', int $adt, string $haa='', string $has='', int $tkn='', int $ykn='', string $pan='', DateTime $git, int $ktn='', string $tur='', string $dta='', string $ydm='')
    {
        if ($ydm !== 'EVET' && $ydm !== 'HAYIR' && $ydm!=='') {
            throw new \InvalidArgumentException('$ydm should be either "EVET" or "HAYIR"');
        }

        $urls=$this->Url.'UTS/uh/rest/bildirim/kullanim/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'ADT'=>$adt,
            'HAA'=>$haa,
            'HAS'=>$has,
            'TKN'=>$tkn,
            'YKN'=>$ykn,
            'PAN'=>$pan,
            'GIT'=>$git->format('Y-m-d'),
            'KTN'=>$ktn,
            'TUR'=>$tur,
            'DTA'=>$dta,
            'YDM'=>$ydm
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikBilgisiIleKullanimBildirimi(string $udi, int $adt, string $haa='', string $has='', int $tkn='', int $ykn='', string $pan='', DateTime $git='', int $ktn='', string $tur='', string $dta='', string $ydm='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/kullanim/ekle';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt,
            'HAA'=>$haa,
            'HAS'=>$has,
            'TKN'=>$tkn,
            'YKN'=>$ykn,
            'PAN'=>$pan,
            'GIT'=>$git->format('Y-m-d'),
            'KTN'=>$ktn,
            'TUR'=>$tur,
            'DTA'=>$dta,
            'YDM'=>$ydm
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function TuketiciyeVermeBildirimi(string $uno, string $lno='', string $sno='', int $adt, string $ben='', string $tua='', string $tus='', int $tkn='', string $ykn='', string $pan='', DateTime $git='', int $ktn='', string $tur='', string $dta='', string $ydm='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/tuketiciyeVerme/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'ADT'=>$adt,
            'BEN'=>$ben,
            'TUA'=>$tua,
            'TUS'=>$tus,
            'TKN'=>$tkn,
            'YKN'=>$ykn,
            'PAN'=>$pan,
            'GIT'=>$git->format('Y-m-d'),
            'KTN'=>$ktn,
            'TUR'=>$tur,
            'DTA'=>$dta,
            'YDM'=>$ydm
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikBilgisiIleTuketiciyeVermeBildirimi(string $udi,int $adt, string $ben='', string $tua='', string $tus='', int $tkn='', string $ykn='', string $pan='', DateTime $git='', int $ktn='', string $tur='', string $dta='', string $ydm='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/tuketiciyeVerme/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt,
            'BEN'=>$ben,
            'TUA'=>$tua,
            'TUS'=>$tus,
            'TKN'=>$tkn,
            'YKN'=>$ykn,
            'PAN'=>$pan,
            'GIT'=>$git->format('Y-m-d'),
            'KTN'=>$ktn,
            'TUR'=>$tur,
            'DTA'=>$dta,
            'YDM'=>$ydm
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function TuketicidenIadeAlmaBildirimi(int $tid, int $adt, int $vkn='', string $udi='', string $uno='', string $lno='', string $sno='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/tuketicidenIadeAlma/ekle';
        $data=array(
            'TID'=>$tid,
            'ADT'=>$adt,
            'VKN'=>$vkn,
            'UDI'=>$udi,
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikBilgisiIleTuketicidenIadeAlma(string $udi, int $vkn='', int $adt)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/tuketicidenIadeAlma/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'VKN'=>$vkn,
            'ADT'=>$adt
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }
    
    public function GeciciKullanimaVermeBildirimi(string $uno, string $lno='', string $sno='', int $adt, string $tua, string $tus, int $tkn='', int $ykn='', string $pan='', DateTime $git='', int $ktn='', string $tur='', string $dta='', string $ydm='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/geciciKullanimaVerme/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'ADT'=>$adt,
            'TUA'=>$tua,
            'TUS'=>$tus,
            'TKN'=>$tkn,
            'YKN'=>$ykn,
            'PAN'=>$pan,
            'GIT'=>$git->format('Y-m-d'),
            'KTN'=>$ktn,
            'TUR'=>$tur,
            'DTA'=>$dta,
            'YDM'=>$ydm
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikBilgisiIleGeciciKullanimaVermeBildirimi(string $udi, int $adt, string $tua, string $tus, int $tkn='', int $ykn='', string $pan='', DateTime $git='', int $ktn='', string $tur='', string $dta='', string $ydm='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/geciciKullanimaVerme/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt,
            'TUA'=>$tua,
            'TUS'=>$tus,
            'TKN'=>$tkn,
            'YKN'=>$ykn,
            'PAN'=>$pan,
            'GIT'=>$git->format('Y-m-d'),
            'KTN'=>$ktn,
            'TUR'=>$tur,
            'DTA'=>$dta,
            'YDM'=>$ydm
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function KullanimdanAlmaBildirimi(int $gki, int $adt, string $udi='', string $uno='', string $lno='', string $sno='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/kullanimdanAlma/ekle';
        $data=array(
            'GKI'=>$gki,
            'ADT'=>$adt,
            'UDI'=>$udi,
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikBilgisiIleKullanimdanAlma(string $udi, int $adt)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/kullanimdanAlma/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function YenidenIslemeBildirimi(string $uno, string $lno='', string $sno='', int $adt)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/yenidenIsleme/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'ADT'=>$adt
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikIleYenidenIslemeBildirimi(string $udi, int $adt)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/yenidenIsleme/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function IhracatBildirimi(string $uno, string $lno='', string $sno='', int $adt, string $ben='', string $gbn)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/ihracat/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'ADT'=>$adt,
            'BEN'=>$ben,
            'GBN'=>$gbn
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikBilgisiIleIhracatBildirimi(string $udi, int $adt, string $ben='', string $gbn)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/ihracat/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt,
            'BEN'=>$ben,
            'GBN'=>$gbn
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function MahrecineIadeEtmeBildirimi(string $uno, string $lno='', string $sno='', int $adt, string $gbn)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/mahrecineIadeEtme/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'ADT'=>$adt,
            'GBN'=>$gbn
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikBilgisiIleMahrecineIadeEtmeBildirimi(string $udi, int $adt, string $gbn)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/mahrecineIadeEtme/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt,
            'GBN'=>$gbn
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function HekZaiatBildirimi(string $uno, string $lno='', string $sno='', int $adt, string $tur='', string $dta='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/hekZayiat/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'ADT'=>$adt,
            'TUR'=>$tur,
            'DTA'=>$dta
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikBilgisiIleHekZaiatBildirimi(string $udi, int $adt, string $tur='', string $dta='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/hekZayiat/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt,
            'TUR'=>$tur,
            'DTA'=>$dta
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function GeriCekmeVermeBildirimi(string $uno, string $lno='', string $sno='', int $adt, int $kun, string $bno)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/geriCekmeVerme/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'ADT'=>$adt,
            'KUN'=>$kun,
            'BNO'=>$bno
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikBilgisiIleGeriCekmeVermeBildirimi(string $udi, int $adt, int $kun, string $bno)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/geriCekmeVerme/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt,
            'KUN'=>$kun,
            'BNO'=>$bno
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function GeriCekmeAlmaBildirimi(string $gvi, int $adt, int $gkk='', string $udi='', string $uno='', string $lno='', string $sno='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/geriCekmeAlma/ekle';
        $data=array(
            'GVI'=>$gvi,
            'ADT'=>$adt,
            'GKK'=>$gkk,
            'UDI'=>$udi,
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikBilgisiIleGeriCekmeAlmaBildirimi(string $udi, int $adt, int $gkk='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/geriCekmeAlma/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt,
            'GKK'=>$gkk,
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function IslahDuzelticiFaaliyetBildirimi(string $uno, string $lno='', string $sno='', int $adt, int $kun='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/islahDuzelticiFaaliyet/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'ADT'=>$adt,
            'KUN'=>$kun
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function EssizKimlikIleIslahDuzelticiFaaliyetBildirimi(string $udi, int $adt, int $kun='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/islahDuzelticiFaaliyet/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt,
            'KUN'=>$kun
        );

        $response=$this->PostMethod($data,$urls);

        return $response;
    }

    public function ImhaBertarafBildirim(string $uno, string $lno='', string $sno='', int $adt, string $grk='', string $dga='', string $bno)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/imhaBertaraf/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'ADT'=>$adt,
            'GRK'=>$grk,
            'DGA'=>$dga,
            'BNO'=>$bno
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function EssizKimlikIleImhaBertarafBildirim(string $udi, int $adt, string $grk='', string $dga='', string $bno)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/imhaBertaraf/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'ADT'=>$adt,
            'GRK'=>$grk,
            'DGA'=>$dga,
            'BNO'=>$bno
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    private function PostMethod($data, $url)
    {
        if (empty($data) || empty($url)) 
        {
            return [
                'success' => false,
                'message' => 'No data available or url does not exist'
            ];
        }

        $headers = [
            'utsToken' => $this->Token,
            'Content-Type' => 'application/json'
        ];

        $client = new Client();

        try 
        {
            $response = $client->post($url, [
                'headers' => $headers,
                'json' => $data
            ]);

            return $response->getBody()->getContents();
        } 
        catch (RequestException $e) 
        {
            return $e->getMessage();
        }
    }

}

?>