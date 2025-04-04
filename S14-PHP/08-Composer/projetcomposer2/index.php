<?php

use Ramsey\Uuid\Uuid;

require ("vendor/autoload.php");
/* 

Manipulation de la librairie ramsey/uuid importée par composer 

*/

$uuid = Uuid::uuid4();

var_dump($uuid);

$products = [
    ['id' => 1, 'name' => 'Produit 1', 'price' => 19.99],
    ['id' => 2, 'name' => 'Produit 2', 'price' => 24.99],
    ['id' => 3, 'name' => 'Produit 3', 'price' => 15.99],
    ['id' => 4, 'name' => 'Produit 4', 'price' => 29.99],
];
var_dump($products);
dump($products);