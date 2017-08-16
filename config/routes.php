<?php

//DEFAULT
$routes->get('/', function () {
    DefaultController::index();
});

//DISCUSSIONS
$routes->get('/discussion', function () {
    DiscussionController::index();
});
$routes->get('/discussion/:id', function ($id) {
    DiscussionController::show($id);
});
$routes->post('/discussion', function () {
    DiscussionController::store();
});

//Topics
$routes->get('/discussion/:discussionId/topic/:topicId', function ($discussionId,$topicId ) {
    TopicController::show($topicId);
});



//SUUNNITELMAT JA TESTIT
$routes->get('/hiekkalaatikko', function () {
    HelloWorldController::sandbox();
});
$routes->get('/home', function () {
    HelloWorldController::home();
});
$routes->get('/discussions', function () {
    HelloWorldController::discussions();
});
$routes->get('/topics', function () {
    HelloWorldController::topics();
});
$routes->get('/topics/1', function () {
    HelloWorldController::topic();
});
$routes->get('/profile/1', function () {
    HelloWorldController::profile();
});
$routes->get('/profile/1/edit', function () {
    HelloWorldController::profileEdit();
});
$routes->get('/login', function () {
    HelloWorldController::login();
});
$routes->get('/signup', function () {
    HelloWorldController::signup();
});