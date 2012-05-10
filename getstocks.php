<?php

$connection = mysql_connect('localhost', 'username', 'password');
$database = mysql_select_db('fap');

function getPopular($array) {
	asort($array);
	end($array);
	return key($array);
}

function getNewPrice($price) {
	$new = $price + rand(-10,10);
	if ($new < 1) {
		return getNewPrice($price);
	}
	return $new;
}

function getNewPopularPrice($price) {
	$new = $price - rand(0,20);
	if ($new < 1) {
		return getNewPopularPrice($price);
	}
	return $new;
}

function updatePrice($row, $popular) {
	if ($row['id'] != $popular) {
	    $new = getNewPrice($row['price']);
	}
	else {
		$new = getNewPrice($row['price']);
	}
}

$stocks = array();
$sql = "SELECT * FROM stocks_owned";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result)) {
	if (!array_key_exists($row['s_id'], $stocks)) {
		$stocks[$row['s_id']] += $row['amount'];
	}
	else {
		$stocks[$row['s_id']] += $row['amount'];
	}
}

$popular = getPopular($stocks);

$sql = "SELECT * FROM stocks";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result)) {
	if ($row['id'] != $popular) {
		$newprice = getNewPrice($row['price']);
	}
	else {
		$newprice = getNewPopularPrice($row['price']);
	}
	
	$sql = "UPDATE stocks SET price = $newprice WHERE id = '".$row['id']."'";
	mysql_query($sql);
	$sql = "UPDATE stocks SET old_price = '".$row['price']. "' WHERE id = '".$row['id']."'";
	mysql_query($sql);
}
	
			

?>
