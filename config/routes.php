<?php

$routes->get('/', function () {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function () {
    HelloWorldController::sandbox();
});
$routes->get('/home', function () {
    HelloWorldController::home();
});

