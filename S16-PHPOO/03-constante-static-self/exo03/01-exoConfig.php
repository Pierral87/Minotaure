<?php 

/* 

Exercice 1 : Configuration d'une classe Config pour une Application Web avec static, self et const

Objectif : Créer une classe Config pour gérer la configuration générale d'une application web. Cette classe contiendra des constantes et des méthodes statiques permettant d'accéder aux informations comme le nom de l'application et les paramètres globaux.

Énoncé :

    Créez une classe Config qui contiendra :
        Une constante APP_NAME qui stockera le nom de l'application.
        Une propriété statique $settings qui contiendra les paramètres globaux de l'application sous forme de key=>value (comme le mode de débogage, ou l'URL de la base de données, mettez des infos aléatoires).
        Une méthode statique setSetting($key, $value) pour ajouter une valeur dans $settings.
        Une méthode statique getSetting($key) pour récupérer une valeur de $settings.
        Une méthode statique getAppName() qui retourne le nom de l'application.

*/

class Config
{
    public const APP_NAME = 'MaSuperApplication';

   
    private static array $settings = [
        'debug' => true,
        'db_url' => 'https://urldemabdd.ovh',
    ];

    public static function setSetting(string $key, $value): void
    {
        self::$settings[$key] = $value;
    }

    
    public static function getSetting(string $key)
    {
        return self::$settings[$key] ?? null;
    }

    
    public static function getAppName(): string
    {
        return self::APP_NAME;
    }
}

Config::setSetting("mode", "dev");

echo Config::getSetting("mode");