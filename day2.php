<?php
$vnos = fopen("day2.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day2.txt"));
fclose($vnos);
$razbito = preg_split("/\s\s/", $podatki);
$red = 12;
$green=13;
$blue=14; 
$igre = array();
//part 1
for($i=0;$i<count($razbito);$i++) {
	$trenutna = explode(':',$razbito[$i]);
	$igra = $trenutna[0];
	$vrednostIgre = trim($igra);
	$vrednostIgre = explode(' ', $vrednostIgre);
	$vrednostIgre = $vrednostIgre[1];
	$podatki = $trenutna[1];
	$vPodatki = explode(';', $podatki);
	$dobraIgra = true;
	foreach($vPodatki as $podatek) {
			$rdeca = 0;
			$zelena = 0;
			$modra = 0;
		$vIgre = trim($podatek);
		$vIgre = explode(',', $podatek);
		foreach($vIgre as $pIgra) {
			$vrednost = trim($pIgra);
			$vrednost = explode(' ', $pIgra);
			if($vrednost[2] === 'red') {
				$rdeca += intval($vrednost[1]);
			}
			if($vrednost[2] === 'blue') {
				$modra += intval($vrednost[1]);
			}
			if($vrednost[2] === 'green') {
				$zelena += intval($vrednost[1]);
			}
		}
		if(($rdeca <= $red) && ($zelena <= $green) && ($modra <= $blue)) {
			$dobraIgra = true;			
		} else {
			$dobraIgra = false;
			break;
		}
	}
	if($dobraIgra) {
		$igre[] = intval($vrednostIgre);		
	}
}
var_dump($igre);
var_dump('part 1: '.array_sum($igre));

//part 2 
$sestevki = [];
for($i=0;$i<count($razbito);$i++) {
	$trenutna = explode(':',$razbito[$i]);
	$igra = $trenutna[0];
	$vrednostIgre = trim($igra);
	$vrednostIgre = explode(' ', $vrednostIgre);
	$vrednostIgre = $vrednostIgre[1];
	$podatki = $trenutna[1];
	$vPodatki = explode(';', $podatki);
	$dobraIgra = true;
	$rdeca = [];
	$zelena = [];
	$modra = [];
	foreach($vPodatki as $podatek) {
		$vIgre = trim($podatek);
		$vIgre = explode(',', $podatek);
		foreach($vIgre as $pIgra) {
			$vrednost = trim($pIgra);
			$vrednost = explode(' ', $pIgra);
			if($vrednost[2] === 'red') {
				$rdeca[] = intval($vrednost[1]);
			}
			if($vrednost[2] === 'blue') {
				$modra[] = intval($vrednost[1]);
			}
			if($vrednost[2] === 'green') {
				$zelena[] = intval($vrednost[1]);
			}
		}
	}
	$maxRdeca = max($rdeca);
	$maxModra = max($modra);
	$maxZelena = max($zelena);
	$sestevki[] = $maxRdeca*$maxModra*$maxZelena;
}
var_dump('part 2: '.array_sum($sestevki));
?>
