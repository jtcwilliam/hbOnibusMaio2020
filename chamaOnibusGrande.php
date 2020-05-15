<?php


include_once './classes/Onibus.php';

$objOnibus = new Onibus();

$onibus = $objOnibus->gerarOnibusMaior(1);


echo '<pre>';
print_r($onibus);
echo '</pre>';


$onibus = $objOnibus->gerarOnibusMaior(2);


echo '<pre>';
print_r($onibus);
echo '</pre>';

$onibus = $objOnibus->gerarOnibusMaior(3);


echo '<pre>';
print_r($onibus);
echo '</pre>';
 

$onibus = $objOnibus->gerarOnibusMaior(4);


echo '<pre>';
print_r($onibus);
echo '</pre>';
 