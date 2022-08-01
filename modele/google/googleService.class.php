<?php

class googleService
{

    private static $adsense;
    private static $analytics;

    public static function initialise($config, $bdd)
    {
        if (self::isSearchConsoleEnable($config)) {
            require('modele/google/googleSearchConsole.class.php');
            googleSearchConsole::call($config, $bdd);
        }

        if (self::isAdsenseEnable($config)) {
            require('modele/google/googleAdsense.class.php');
            self::$adsense = new googleAdsense($config);
        }

        if (self::isAnalyticsEnable($config)) {
            require('modele/google/googleAnalytics.class.php');
            self::$analytics = new googleAnalytics($config);
        }

    }

    public static function getAdsense()
    {
        return self::$adsense;
    }

    public static function getAnalytics()
    {
        return self::$analytics;
    }

    public static function isSearchConsoleEnable($config)
    {
        return isset($config['googleService']['searchConsole']['enable']) && $config['googleService']['searchConsole']['enable'] == true;
    }

    public static function isAnalyticsEnable($config)
    {
        return isset($config['googleService']['analytics']['enable']) && $config['googleService']['analytics']['enable'] == true && isset($config['googleService']['analytics']['id']);
    }

    public static function isAdsenseEnable($config)
    {
        return isset($config['googleService']['adsense']['enable']) && $config['googleService']['adsense']['enable'] == true && isset($config['googleService']['adsense']['id']) && isset($config['googleService']['adsense']['pub']);
    }

    public static function isAnalyticsEnable2($config)
    {
        return isset($config['googleService']['analytics']['enable']) && $config['googleService']['analytics']['enable'] == true;
    }

    public static function isAdsenseEnable2($config)
    {
        return isset($config['googleService']['adsense']['enable']) && $config['googleService']['adsense']['enable'] == true;
    }

}

?>