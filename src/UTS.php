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

    public function UretimBildirimi(string $uno,string $lno='',string $sno='',DateTime $urt, DateTime $skt=null,int $adt,string $udi='',string $sip='',string $kus='',string $gtk='')
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

    public function IthalatBildirimi(string $uno, string $lno='',string $sno='',DateTime $urt,DateTime $skt=null,DateTime $itt=null,int $adt=null,string $udi='',int $ieu,int $meu,string $gbn='',string $kus='',string $gtk='')
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

    public function YetkiliBayiIleIthalatBildirimi(int $uik, string $uno, string $lno='', string $sno='', DateTime $urt, DateTime $skt=null, DateTime $itt=null, int $adt, string $udi='', int $ieu, int $meu, string $gbn='', string $sip='', string $kus='', string $gtk='')
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

    public function VermeBildirimi(string $uno, string $lno='', string $sno='', int $adt, int $kun, string $ben='', string $bno, DateTime $git=null)
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

    public function AlmaBildirimi(int $vbi=null, int $adt, int $gkk=null, string $udi='', string $uno='', string $lno='', string $sno='')
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

    public function EssizKimlikIleAlmaBildirimi(string $udi,int $adt, int $gkk=null)
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

    public function EssizKimlikBilgisiIleTanimsizYereVermeBildirimi(string $udi, int $adt, string $ben='', int $vkn, int $men=null, int $tkn=null, int $mek=null, int $odk=null, string $bno)
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

    public function TanimsizYerdenIadeAlmaBildirimi(int $uti=null, int $adt, string $udi='', string $uno='', string $lno='',  string $sno='')
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

    public function KullanimBildirimi(string $uno, string $lno='', string $sno='', int $adt, string $haa='', string $has='', int $tkn=null, int $ykn=null, string $pan='', DateTime $git, int $ktn=null, string $tur='', string $dta='', string $ydm='')
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

    public function EssizKimlikBilgisiIleKullanimBildirimi(string $udi, int $adt, string $haa='', string $has='', int $tkn=null, int $ykn=null, string $pan='', DateTime $git=null, int $ktn=null, string $tur='', string $dta='', string $ydm='')
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

    public function TuketiciyeVermeBildirimi(string $uno, string $lno='', string $sno='', int $adt, string $ben='', string $tua='', string $tus='', int $tkn=null, string $ykn='', string $pan='', DateTime $git=null, int $ktn=null, string $tur='', string $dta='', string $ydm='')
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

    public function EssizKimlikBilgisiIleTuketiciyeVermeBildirimi(string $udi,int $adt, string $ben='', string $tua='', string $tus='', int $tkn=null, string $ykn='', string $pan='', DateTime $git=null, int $ktn=null, string $tur='', string $dta='', string $ydm='')
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

    public function TuketicidenIadeAlmaBildirimi(int $tid, int $adt, int $vkn=null, string $udi='', string $uno='', string $lno='', string $sno='')
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

    public function EssizKimlikBilgisiIleTuketicidenIadeAlma(string $udi, int $vkn=null, int $adt)
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
    
    public function GeciciKullanimaVermeBildirimi(string $uno, string $lno='', string $sno='', int $adt, string $tua, string $tus, int $tkn=null, int $ykn=null, string $pan='', DateTime $git=null, int $ktn=null, string $tur='', string $dta='', string $ydm='')
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

    public function EssizKimlikBilgisiIleGeciciKullanimaVermeBildirimi(string $udi, int $adt, string $tua, string $tus, int $tkn=null, int $ykn=null, string $pan='', DateTime $git=null, int $ktn=null, string $tur='', string $dta='', string $ydm='')
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

    public function GeriCekmeAlmaBildirimi(string $gvi, int $adt, int $gkk=null, string $udi='', string $uno='', string $lno='', string $sno='')
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

    public function EssizKimlikBilgisiIleGeriCekmeAlmaBildirimi(string $udi, int $adt, int $gkk=null)
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

    public function IslahDuzelticiFaaliyetBildirimi(string $uno, string $lno='', string $sno='', int $adt, int $kun=null)
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

    public function EssizKimlikIleIslahDuzelticiFaaliyetBildirimi(string $udi, int $adt, int $kun=null)
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

    public function HastaninVucudundanCikarmaBildirimi(string $uno, string $lno='', string $sno='', string $haa='', string $has='', int $tkn=null, int $ykn=null, string $pan='', string $grk, string $dga='', DateTime $git, int $ktn=null, string $tur, string $dta='', string $ydm='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/hastaninVucudundanCikarma/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'HAA'=>$haa,
            'HAS'=>$has,
            'TKN'=>$tkn,
            'YKN'=>$ykn,
            'PAN'=>$pan,
            'GRK'=>$grk,
            'DGA'=>$dga,
            'GIT'=>$git->format('Y-m-d'),
            'KTN'=>$ktn,
            'TUR'=>$tur,
            'DTA'=>$dta,
            'YDM'=>$ydm
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function EssizKimlikIleHastaninVucudundanCikarmaBildirimi(string $udi, string $haa='', string $has='', int $tkn=null, int $ykn=null, string $pan='', string $grk, string $dga='', DateTime $git, int $ktn=null, string $tur, string $dta='', string $ydm='')
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/hastaninVucudundanCikarma/ekle/essizKimlik';
        $data=array(
            'UDI'=>$udi,
            'HAA'=>$haa,
            'HAS'=>$has,
            'TKN'=>$tkn,
            'YKN'=>$ykn,
            'PAN'=>$pan,
            'GRK'=>$grk,
            'DGA'=>$dga,
            'GIT'=>$git->format('Y-m-d'),
            'KTN'=>$ktn,
            'TUR'=>$tur,
            'DTA'=>$dta,
            'YDM'=>$ydm
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function EnvanterBildirimi(int $uik, string $uno, string $lno='', string $sno, DateTime $ent, DateTime $skt, DateTime $sbt)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/envanter/ekle';
        $data=array(
            'UIK'=>$uik,
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'ENT'=>$ent->format('Y-m-d'),
            'SKT'=>$skt->format('Y-m-d'),
            'SBT'=>$sbt->format('Y-m-d')
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function TuketimBildirimi(string $uno, string $lno='', string $sno, int $tyk=null, DateTime $git, int $adt)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/tuketim/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'TYK'=>$tyk,
            'GIT'=>$git->format('Y-m-d'),
            'ADT'=>$adt,
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function HizmetSunumBildirimi(string $uno, string $lno='', string $sno, DateTime $git=null, int $kun, int $bno)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/hizmetSunum/ekle';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'GIT'=>$git->format('Y-m-d'),
            'KUN'=>$kun,
            'BNO'=>$bno,
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function HizmetSunumSonlandirmaBildirimi(string $bid)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/hizmetSunum/sonlandir';
        $data=array(
            'BID'=>$bid
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    /*
    TODO: Iptal Bildirim Alanlari Eklenecek Sayfa:96
    */

    public function TekilUrunSorgula(string $uno, string $lno='', string $sno='')
    {
        $urls=$this->Url.'UTS/uh/rest/tekilUrun/sorgula';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function EssizKimlikBilgisiIleTekilUrunSorgula(string $udi)
    {
        $urls=$this->Url.'UTS/uh/rest/tekilUrun/sorgula/essizKimlik';
        $data=array(
            'UDI'=>$udi
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function UreticiIthalatciTekilUrunSorgula(string $uno, string $lno='', string $sno='', int $san=1)
    {
        $urls=$this->Url.'UTS/uh/rest/tekilUrun/uretici/sorgula';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'SAN'=>$san
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function UreticiIthalatciSisteminDisinaCikmisTekilUrunSorgula(string $uno, string $lno='', string $sno='', int $san=1)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/ureticiIthalatci/tekilUrun/sistemDisinaCikan/sorgula';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'SAN'=>$san
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function AskidakiTekilUrunSorgula(int $kun, string $uno='', string $lno='', string $sno='', int $san=1)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/verme/askidakiler';
        $data=array(
            'KUN'=>$kun,
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'SAN'=>$san
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function BildirimSorgula(string $uno, string $lno='', string $sno='', int $san=1)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/sorgula';
        $data=array(
            'UNO'=>$uno,
            'LNO'=>$lno,
            'SNO'=>$sno,
            'SAN'=>$san
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function KabulEdilecekTekilUrunSorgula(int $gkk, string $bno, string $uno='', string $bid='', int $san=1)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/alma/bekleyenler/sorgula';
        $data=array(
            'GKK'=>$gkk,
            'BNO'=>$bno,
            'UNO'=>$uno,
            'BID'=>$bid,
            'SAN'=>$san
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function KabulEdilecekTekilUrunSorgulaKayitSayisi(int $gkk=null, string $bno='', string $uno='', int $adt=20, int $off=null)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/alma/bekleyenler/sorgula/offset';
        $data=array(
            'GKK'=>$gkk,
            'BNO'=>$bno,
            'UNO'=>$uno,
            'ADT'=>$adt,
            'OFF'=>$off
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function KabulEdilecekGeriCekilmisTekilUrunSorgula(int $gkk, string $bno, string $uno="", string $bid="", int $san=1)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/geriCekmeAlma/bekleyenler';
        $data=array(
            'GKK'=>$gkk,
            'BNO'=>$bno,
            'UNO'=>$uno,
            'BID'=>$bid,
            'SAN'=>$san
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function TekilUrununKaynaginiSorgula(string $uno, string $sno)
    {
        $urls=$this->Url.'UTS/uh/rest/tekilUrun/kaynak/sorgula';
        $data=array(
            'UNO'=>$uno,
            'SNO'=>$sno
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function PiyasayaArzBilgileriSorgula(string $pab, int $urt)
    {
        $urls=$this->Url.'UTS/uh/rest/piyasayaArzBilgisi/sorgula';
        $data=array(
            'PAB'=>$pab,
            'URT'=>$urt
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function BildirimveTekilUrunDetaySorgula(string $bid)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/detay/sorgula';
        $data=array(
            'BID'=>$bid
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function StokYapilabilirTekilUrunBilgileriniSorgula(string $uno, string $sno='', string $lno='', int $adt=10, string $off='')
    {
        $urls=$this->Url.'UTS/uh/rest/stokYapilabilirTekilUrun/sorgula';
        $data=array(
            'UNO'=>$uno,
            'SNO'=>$sno,
            'LNO'=>$lno,
            'ADT'=>$adt,
            'OFF'=>$off
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function AyrintiliTekilUrunSorgulama(string $uno, string $sno='', string $lno='', string $udi='', int $uik=null, int $adt=15, int $say=0)
    {
        $urls=$this->Url.'UTS/rest/ayrintiliTekilUrun/sorgula';
        $data=array(
            'UNO'=>$uno,
            'SNO'=>$sno,
            'LNO'=>$lno,
            'UDI'=>$udi,
            'UIK'=>$uik,
            'ADT'=>$adt,
            'SAY'=>$say
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function AyrintiliBildirimSorgulama(string $uno, string $sno='', string $lno='', string $udi='', string $bti='', string $bdr='', string $bkt='', string $tkn='', int $dkn=null, string $bno='', string $bid='', string $bzb='', string $bzs='', int $adt=null, int $say=0)
    {
        $urls=$this->Url.'UTS/uh/rest/ayrintiliBildirim/sorgula';
        $data=array(
            'UNO'=>$uno,
            'SNO'=>$sno,
            'LNO'=>$lno,
            'UDI'=>$udi,
            'BTI'=>$bti,
            'BDR'=>$bdr,
            'BKT'=>$bkt,
            'TKN'=>$tkn,
            'DKN'=>$dkn,
            'BNO'=>$bno,
            'BID'=>$bid,
            'BZB'=>$bzb,
            'BZS'=>$bzs,
            'ADT'=>$adt,
            'SAY'=>$say
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function EksikAlmaBildirimleriniGoruntule(int $adt, string $off)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/verme/eksikAlma/sorgula/offset';
        $data=array(
            'ADT'=>$adt,
            'OFF'=>$off
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function EksikAlmaBildirimiGorulmeDurumunuGuncelle(string $bid, string $gdr)
    {
        $urls=$this->Url.'UTS/uh/rest/bildirim/verme/eksikAlma/gorulmeDurumunuGuncelle';
        $data=array(
            'BID'=>$bid,
            'GDR'=>$gdr
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function AlmakIstemiyorumOlarakIsaretle(string $bid)
    {
        $urls=$this->Url.'UTS/uh/rest/almakIstemiyorum/almakIstemiyorumOlarakIsaretle';
        $data=array(
            'BID'=>$bid
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function AlmakIstiyorumOlarakIsaretle(string $bid)
    {
        $urls=$this->Url.'UTS/uh/rest/almakIstemiyorum/almakIstiyorumOlarakIsaretle';
        $data=array(
            'BID'=>$bid
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function AlinmakIstenmeyenVermeBildirimlerimiSorgula(int $adt, string $off='')
    {
        $urls=$this->Url.'UTS/uh/rest/almakIstemiyorum/sorgula/alinmakIstenmeyenVermeBildirimlerim';
        $data=array(
            'ADT'=>$adt,
            'OFF'=>$off
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function AlmakIStemedigimVermeBildirimleriniSorgula(int $adt, string $off='')
    {
        $urls=$this->Url.'UTS/uh/rest/almakIstemiyorum/sorgula/almakIstemedigimVermeBildirimlerim';
        $data=array(
            'ADT'=>$adt,
            'OFF'=>$off
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function PaketEkle(string $pno, string $tip='', int $kno, string $pli='', array $tul=null)
    {
        $urls=$this->Url.'UTS/uh/rest/pts/paket/ekle';
        $data=array(
            'PNO'=>$pno,
            'TIP'=>$tip,
            'KNO'=>$kno,
            'PLI'=>$pli,
            'TUL'=>$tul
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function PaketSil(string $pno)
    {
        $urls=$this->Url.'UTS/uh/rest/pts/paket/sil';
        $data=array(
            'PNO'=>$pno
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function PaketGetir(string $pno)
    {
        $urls=$this->Url.'UTS/uh/rest/pts/paket/getir';
        $data=array(
            'PNO'=>$pno
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function KurumaGelenPaketiOkunduIsaretle(string $pno, int $kno)
    {
        $urls=$this->Url.'UTS/uh/rest/pts/gelenPaket/oku';
        $data=array(
            'PNO'=>$pno,
            'KNO'=>$kno
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function KurumaGelenPaketiGetir(string $pno, int $kno)
    {
        $urls=$this->Url.'UTS/uh/rest/pts/gelenPaket/getir';
        $data=array(
            'PNO'=>$pno,
            'KNO'=>$kno
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function KurumaGelenPaketleriSorgula(DateTime $ekt=null, DateTime $ebt=null, string $okb='', int $kno=null)
    {
        $urls=$this->Url.'UTS/uh/rest/pts/gelenPaket/sorgula';
        $data=array(
            'EKT'=>$ekt->format('Y-m-d'),
            'EBT'=>$ebt->format('Y-m-d'),
            'OKB'=>$okb,
            'KNO'=>$kno
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function FirmaSorgulama(string $mrs='', string $vrg, string $unv='', int $krn=null, string $cky='')
    {
        $urls=$this->Url.'UTS/rest/kurum/firmaSorgula';
        $data=array(
            'MRS'=>$mrs,
            'VRG'=>$vrg,
            'UNV'=>$unv,
            'KRN'=>$krn,
            'CKY'=>$cky
        );

        $response=$this->PostMethod($data,$urls);

        return $response; 
    }

    public function UrunSorgulama(string $uno)
    {
        $urls=$this->Url.'UTS/rest/tibbiCihaz/urunSorgula';
        $data=array(
            'UNO'=>$uno
        );

        $response=$this->PostMethod($data,$urls);

        return $response;  
    }

    public function ButunUrunleriSorgulama(int $sayfabuyuklugu, int $sayfaindeksi, DateTime $baslangictarihi=null, DateTime $bitistarihi=null)
    {
        $urls=$this->Url.'UTS/rest/tibbiCihaz/tibbiCihazSorgula';
        $data=array(
            'sayfaBuyuklugu'=>$sayfabuyuklugu,
            'sayfaIndeksi'=>$sayfaindeksi,
            'baslangicTarihi'=>$baslangictarihi->format('d/m/Y'),
            'bitisTarihi'=>$bitistarihi->format('d/m/Y')
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
                'json' => $data,
                'verify' => !$this->Test
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