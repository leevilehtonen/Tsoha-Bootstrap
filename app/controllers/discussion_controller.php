<?php
/**
 * Created by PhpStorm.
 * User: lleevi
 * Date: 9.8.2017
 * Time: 21.03
 */
require 'app/models/discussion.php';
class DiscussionController extends BaseController{
    public static function index(){
        $discussions = Discussion::all();
        View::make('discussion/index.html', array('discussions' => $discussions));
    }
}