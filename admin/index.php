<?php

$klein = new \Klein\Klein();
$klein->with('/', function () use ($klein) {
	$controller = new \Controllers\HurricaneData($klein);
});

?>