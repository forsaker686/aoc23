<?php
$input = file_get_contents("day15.txt");
$input = explode(',', $input);
//part1
$skupaj = 0;
foreach($input as $inp) {
	$stevec = 0;
	for($i=0;$i<strlen($inp);$i++) {
		$zacetna = $stevec+= ord($inp[$i]);
		$st = ($zacetna*17)%256;
		$stevec = $st;
	}
	$skupaj+= $stevec;
}

var_dump('Part1: '.$skupaj);

//part2
function label($input) {
	if(str_contains($input, '=')) {
		$inp = explode('=', $input);
	}else {
		$inp = explode('-', $input);
	}
	return $inp;
}
function hmap($input) {
	$stevec = 0;
	$skupaj = 0;
	for($i=0;$i<strlen($input);$i++) {
		$zacetna = $stevec+= ord($input[$i]);
		$st = ($zacetna*17)%256;
		$stevec = $st;
	}
	$skupaj+= $stevec;
	return $skupaj;
}

$luci = [];
foreach($input as $inp) {
	$vrednost = label($inp);
	$hash = hmap($vrednost[0]);
	if(str_contains($inp, '-')) {
		unset($luci[$hash][$vrednost[0]]);
		continue;
	}

	$luci[$hash][$vrednost[0]] = $vrednost[1] ?? null;
}
$skupaj = 0;
foreach($luci as $kljuc => $vrednost) {
	if(empty($vrednost)) {
		continue;
	}
	$moc = 0;
	foreach($vrednost as $v) {
		$moc = $moc+1;
		$skupaj += ($kljuc+1) * ($moc) * $v;
	}
}
var_dump('Part2: '.$skupaj);
?>
