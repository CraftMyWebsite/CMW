<?php 
class googleAdsense
{
    
    private $id;
    
    public function __construct($_Serveur_)  {
        $this->id = $_Serveur_['googleService']['adsense']['id'];
    }
    
    
    public function writeHead() {
        echo '<script data-ad-client="ca-'.$this->id.'" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>';
    }
    
    public function writePub() {
        echo '<ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-'.$this->id.'"
             data-ad-slot="3128942591"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>';
    }
    
    public static function generateAds($id) {
        file_put_contents ("ads.txt", "google.com, ".id.", DIRECT, f08c47fec0942fa0");
    }
}
?>