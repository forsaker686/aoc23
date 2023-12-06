<?php
$vnos = fopen("day6.txt", "r") or die("Unable to open file!");
$podatki = fread($vnos,filesize("day6.txt"));
fclose($vnos);
$razbito = preg_split("/\n/", $podatki);

//part 1
$casi = [];
$razdalje = [];
$cas = $razbito[0];
$razdalja = $razbito[1];
$cas = explode(':', $cas);
$cas = trim($cas[1]);
$cas = explode(' ', $cas);
$razdalja = explode(':', $razdalja);
$razdalja = trim($razdalja[1]);
$razdalja = explode(' ', $razdalja);
foreach($cas as $c) {
	if($c !== '') {
		$casi[] = $c;
	}
}
foreach($razdalja as $r) {
	if($r !== '') {
		$razdalje[] = $r;
	}
}
$moznosti = [];
for($i=0;$i<count($casi);$i++) {
	echo 'Igra '.$i;
	$zmage = 0;
	for($e=1;$e<=intval($casi[$i]);$e++) {
		$tRazdalja = $e*(intval($casi[$i])-$e);
		if($tRazdalja > $razdalje[$i]) {
			$zmage++;
		}
	}
	$moznosti[] = $zmage;
}
var_dump('part1:'.array_product($moznosti));

//part2 
$cas = $razbito[0];
$razdalja = $razbito[1];
$cas = explode(':', $cas);
$cas = trim($cas[1]);
$cas = explode(' ', $cas);
$razdalja = explode(':', $razdalja);
$razdalja = trim($razdalja[1]);
$razdalja = explode(' ', $razdalja);
$sCas = '';
$sRazdalja = '';
foreach($cas as $c) {
	if($c !== '') {
		$sCas .= $c;
	}
}
foreach($razdalja as $r) {
	if($r !== '') {
		$sRazdalja .= $r;
	}
}
$moznosti = [];
	$zmage = 0;
	for($e=1;$e<=intval($sCas);$e++) {
		$tRazdalja = $e*(intval($sCas)-$e);
		if($tRazdalja > $sRazdalja) {
			$zmage++;
		}
	}
var_dump('part2:'.$zmage);
?>
