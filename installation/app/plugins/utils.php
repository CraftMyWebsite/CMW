<?php

function isWindows(): bool
{
    return PHP_OS_FAMILY === "Windows" ? "true" : "false";
}

function setWindows(): void
{
    $config = new Lire('../modele/config/config.yml');
    $config = $config->GetTableau();

    $config['General']['Windows'] = isWindows();

    new Ecrire('../modele/config/config.yml', $config);
}