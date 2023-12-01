<?php
$vnos = fopen("day1.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day1.txt"));
fclose($vnos);
$razbito = preg_split("/\s\s/", $podatki);
//PART1
$stevilke = array();
for($i=0;$i<count($razbito);$i++) {
	$stevilka = '';
	for($e=0;$e<strlen($razbito[$i]);$e++) {
		if(intval($razbito[$i][$e]) > 0) {
			$stevilka = $stevilka.''.$razbito[$i][$e];
		}
	}
	$stevilke[] = $stevilka;
}
$stevilke2 = array();
for($i = 0; $i<count($stevilke);$i++) {
	$st1 = $stevilke[$i][0];
	if(strlen($stevilke[$i]) > 1) {
		$st2 = $stevilke[$i][strlen($stevilke[$i])-1];
	} else {
		$st2 = $stevilke[$i][0];
	}
	$stevilka = $st1.''.$st2;
	$stevilke2[] = intval($stevilka);
}
echo 'part1:'.array_sum($stevilke2);
echo '<br/>';
//PART2
$imenaST = array(
	1 => 'one', 
	2 => 'two', 
	3 => 'three', 
	4 => 'four', 
	5 => 'five', 
	6 => 'six', 
	7 => 'seven', 
	8 => 'eight', 
	9 => 'nine'
);
$stevilke3 = array();

function cmp($a, $b)
{
    if ($a['pozicija'] == $b['pozicija']) {
        return 0;
    }
    return ($a['pozicija'] < $b['pozicija']) ? -1 : 1;
}
foreach ($razbito as $pLine) {
    $stevilka = '';
    $pozicije = array();
    $pLine = strtolower($pLine); //za vsak slučaj / just in case

    foreach ($imenaST as $vrednost => $vsebina) { //loop čez imena
        if (strpos($pLine, $vsebina) !== false) { //preverjanje prve omembe
        	$pozicije[] = array('pozicija' => strpos($pLine, $vsebina), 'stevilka' => $vrednost);
            $stevilka .= $vrednost;
        } 
        if(strrpos($pLine, $vsebina) !== false) { //preveranje zadnje omembe
        	$pozicije[] = array('pozicija' => strrpos($pLine, $vsebina), 'stevilka' => $vrednost);
            $stevilka .= $vrednost;	
        }
    }
    for($i=0; $i<strlen($pLine);$i++) {
    	if(intval($pLine[$i]) > 0) {
			$pozicije[] = array('pozicija' => $i, 'stevilka' => $pLine[$i]);
		}
    }
    usort($pozicije, 'cmp');
    if (!empty($pozicije)) {
        $st3 = $pozicije[0]['stevilka'];
        $st4 = $pozicije[count($pozicije)-1]['stevilka'];
        
        $pStevilka = $st3 . $st4;
        $stevilke3[] = intval($pStevilka);
    }
}
$skupaj = array_sum($stevilke3);

// echo "številke: " . implode(', ', $stevilke3) .PHP_EOL; //samo za pomoč
echo "part2: " . $skupaj . "\n";
?>