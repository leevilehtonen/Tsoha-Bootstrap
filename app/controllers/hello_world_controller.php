<?php


class HelloWorldController extends BaseController
{

    public static function index()
    {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        echo 'Tämä on etusivu!';
    }

    public static function sandbox()
    {
        $account = self::get_user_logged_in();
        Kint::dump(Topic::findByQuery('ruoka'));
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
