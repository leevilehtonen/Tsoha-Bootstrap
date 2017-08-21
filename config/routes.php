<?php

function check_logged_in()
{
    BaseController::check_logged_in();
}

//DEFAULT
$routes->get('/', function () {
    DefaultController::index();
});

//DISCUSSIONS
$routes->get('/discussion', function () {
    DiscussionController::index();
});
$routes->get('/discussion/search', function () {
    DiscussionController::search();
});
$routes->get('/discussion/:id', function ($id) {
    DiscussionController::show($id);
});
$routes->post('/discussion', 'check_logged_in', function () {
    DiscussionController::store();
});

//Topics
$routes->post('/discussion/:discussionId', 'check_logged_in', function ($discussionId) {
    TopicController::store($discussionId);
});
$routes->get('/discussion/:discussionId/topic/:topicId', function ($discussionId,$topicId ) {
    TopicController::show($topicId);
});


//Posts
$routes->post('/discussion/:discussionId/topic/:topicId', 'check_logged_in', function ($discussionId, $topicId) {
    PostController::store($topicId);
});
$routes->post('/discussion/:discussionId/topic/:topicId/post/:postId/edit', 'check_logged_in', function ($discussionId, $topicId, $postId) {
    PostController::edit($postId);
});
$routes->post('/discussion/:discussionId/topic/:topicId/post/:postId/update', 'check_logged_in', function ($discussionId, $topicId, $postId) {
    PostController::update($postId);
});
$routes->post('/discussion/:discussionId/topic/:topicId/post/:postId/destroy', 'check_logged_in', function ($discussionId, $topicId, $postId) {
    PostController::destroy($postId);
});


// Account
$routes->get('/login', function () {
    AccountController::login();
});
$routes->post('/login', function () {
    AccountController::handle_login();
});
$routes->get('/register', function () {
    AccountController::register();
});
$routes->post('/register', function () {
    AccountController::handle_register();
});
$routes->post('/logout', function () {
    AccountController::handle_logout();
});

//Profile
$routes->get('/account/:id', 'check_logged_in', function ($id) {
    AccountController::show($id);
});
$routes->post('/account/:id/edit', 'check_logged_in', function ($id) {
    AccountController::edit($id);
});
$routes->post('/account/:id/update', 'check_logged_in', function ($id) {
    AccountController::update($id);
});
$routes->post('/account/:id/destroy', 'check_logged_in', function ($id) {
    AccountController::destroy($id);
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