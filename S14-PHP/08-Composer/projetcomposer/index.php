<?php

use Ramsey\Uuid\Uuid;

require ("vendor/autoload.php");
/* 

Manipulation de la librairie ramsey/uuid importée par composer 

*/

$uuid = Uuid::uuid4();

var_dump($uuid);