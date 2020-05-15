<?php


include_once './classes/Onibus.php';

$objOnibus = new Onibus();

$onibus = $objOnibus->gerarOnibusMenor(44,1);


echo '<pre>';
print_r($onibus);
echo '</pre>';


$onibus = $objOnibus->gerarOnibusMenor(44,2);


echo '<pre>';
print_r($onibus);
echo '</pre>';

$onibus = $objOnibus->gerarOnibusMenor(44,3);


echo '<pre>';
print_r($onibus);
echo '</pre>';
 

$onibus = $objOnibus->gerarOnibusMenor(44,4);


echo '<pre>';
print_r($onibus);
echo '</pre>';
 