<?php
$vnos = fopen("day4.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day4.txt"));
fclose($vnos);
$razbito = preg_split("/\n/", $podatki);

//part 1 
$igre = [];
foreach($razbito as $vrstica) {
	$tocke = 0;
	$zm_tocke = 0;
	$zmage = 0;
	$card = explode('|', $vrstica); 
	$zmagovalne = $card[0];
	$moje = $card[1];
	$zmagovalne = explode(':', $zmagovalne);
	$zmagovalne = trim($zmagovalne[1]);
	$zmagovalne = explode(' ', $zmagovalne);
	$dobitne = [];
	foreach($zmagovalne as $zmagovalna) {
		if($zmagovalna !== '') {
			$dobitne[] = $zmagovalna;
		}
	}
	$moje = trim($moje);
	$moje = explode(' ',$moje);
	$moje = array_unique($moje);
	$moje = array_values($moje);
	foreach($moje as $st) {
		if(in_array($st, $dobitne)) {
			$zmage++;
			$tocke = $zmage > 1 ? pow(2, $zmage - 1) : $zmage;
		}
	}
	$zm_tocke += $tocke;
	$igre[]  = $zm_tocke;
}
var_dump('skupaj part1:'.array_sum($igre));

//part 2

$igre = [];
foreach($razbito as $vrstica) {
	$tocke = 0;
	$zm_tocke = 0;
	$zmage = 0;
	$card = explode('|', $vrstica); 
	$zmagovalne = $card[0];
	$moje = $card[1];
	$zmagovalne = explode(':', $zmagovalne);
	$zmagovalne = trim($zmagovalne[1]);
	$zmagovalne = explode(' ', $zmagovalne);
	$dobitne = [];
	foreach($zmagovalne as $zmagovalna) {
		if($zmagovalna !== '') {
			$dobitne[] = $zmagovalna;
		}
	}
	$moje = trim($moje);
	$moje = explode(' ',$moje);
	$moje = array_unique($moje);
	$moje = array_values($moje);
	$igralne = [];
	foreach($moje as $moja) {
		if($moja !== '') {
			$igralne[] = $moja;
		}
	}
	$igre[] = array(
		'zmagovalne' => $dobitne,
		'igralne' => $igralne,
		'stetje' => 1,
	);
}

$tocke = 0;
$skupaj = 0;
for($i=0;$i<count($igre);$i++) {
	$zmagovalne = $igre[$i]['zmagovalne'];
	$igralne = $igre[$i]['igralne'];
	$zmage = count(array_intersect($zmagovalne, $igralne));
	for($e=1; $e <= $zmage; $e++) {
		$naslednja = $i+$e;
		if($naslednja >= count($igre)) {
			break;
		}
		$igre[$naslednja]['stetje'] += $igre[$i]['stetje'];
	}
	$skupaj += $igre[$i]['stetje'];
}
var_dump('skupaj part2:'.$skupaj);

?>
