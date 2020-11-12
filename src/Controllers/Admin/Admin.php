<?php
namespace Controllers\Admin;

class Admin {

    public static function routes($klein)
    {
        $klein->with("/admin", function () use ($klein) {
            $klein->respond("GET","*",function($request, $response, $service, $app){
                $service->partial('templates/admin/components/core/head.php');
                $service->render('templates/admin/layout.php');
            });

            $klein->respond('GET', '/states', function ($request, $response, $service, $app) {
                $service->states = \Models\Models\StatesQuery::create()->find();    
                $service->render('templates/admin/states/layout.php');
            });

            $klein->respond('GET', '/states/[:state]/counties/', function ($request, $response, $service, $app) {
                $service->counties = \Models\Models\CountiesQuery::create()->filterByStateId($request->state)->find();
                $service->render('templates/admin/counties/layout.php');
            });

            $klein->respond('GET', '/states/[:state]/counties/[:county]/cities/', function ($request, $response, $service, $app) {
                $service->cities = \Models\Models\CitiesQuery::create()->filterByCountyId($request->county)->find();
                $service->render('templates/admin/cities/layout.php');
            });
        });
    }
}

?>