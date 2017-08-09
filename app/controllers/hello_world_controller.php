<?php

require 'app/models/post.php';
require 'app/models/discussion.php';
class HelloWorldController extends BaseController
{

    public static function index()
    {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        echo 'Tämä on etusivu!';
    }

    public static function sandbox()
    {
        $discussion = Discussion::find(1);
        $discussions = Discussion::all();
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        Kint::dump($discussions);
        Kint::dump($discussion);
    }

    public static function home()
    {
        View::make('suunnitelmat/etusivu.html');
    }

    public static function discussions()
    {
        View::make('suunnitelmat/alueet.html');
    }

    public static function topics()
    {
        View::make('suunnitelmat/keskustelut.html');
    }

    public static function topic()
    {
        View::make('suunnitelmat/keskustelu.html');
    }

    public static function profile()
    {
        View::make('suunnitelmat/profiili.html');
    }

    public static function profileEdit()
    {
        View::make('suunnitelmat/profiilimuokkaus.html');
    }

    public static function login()
    {
        View::make('suunnitelmat/kirjaudu.html');
    }

    public static function signup()
    {
        View::make('suunnitelmat/rekisteröidy.html');
    }
}
