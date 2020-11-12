<?php
$loader = require($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require_once ('generated-conf/config.php');
$klein = new \Klein\Klein();

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

\Controllers\Admin\Admin::routes($klein);


// $klein->with("/", function () use ($klein) {
//     // echo 'hi';
// });

$klein->dispatch();
// $query = \Models\Models\StatesQuery::create()
//     ->filterByState('Florida')
//     ->findOne();
    
// $query = $query->getCountiess(\Models\Models\CountiesQuery::create()->filterByName('Brevard'));


// foreach ($query as $county) {
//     foreach ($county->getCitiess() as $city) {
//         $places = $city->getPlacess(\Models\Models\PlacesQuery::create()->filterByPlaceSubType(8));
//         foreach ($places as $place) {
//             echo $place->getPlace() . "<br>";
//         }
//     } 
// }
