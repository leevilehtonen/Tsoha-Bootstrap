<?php
/**
 * Created by PhpStorm.
 * User: lleevi
 * Date: 9.8.2017
 * Time: 21.11
 */

class DefaultController extends BaseController {
    public static function index() {
        View::make('default/index.html');
    }
}