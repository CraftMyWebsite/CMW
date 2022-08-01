<?php

class googleAnalytics
{

    private $id;

    public function __construct($_Serveur_)
    {
        $this->id = $_Serveur_['googleService']['analytics']['id'];
    }


    public function writeHead()
    {
        echo '<script async src="https://www.googletagmanager.com/gtag/js?id=' . $this->id . '"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag("js", new Date());
        
          gtag("config", "' . $this->id . '");
        </script>';
    }
}

?>