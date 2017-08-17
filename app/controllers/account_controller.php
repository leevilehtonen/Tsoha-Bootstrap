<?php


class AccountController extends BaseController
{

    public static function login()
    {
        View::make('account/login.html');
    }

    public static function handle_login()
    {
        $params = $_POST;
        $account = Account::authenticate($params['username'], $params['password']);

        if (!$account) {
            View::make('account/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana', 'username' => $params['username']));
        } else {
            $_SESSION['account'] = $account->id;
            Redirect::to('/', array('message' => 'Tervetuloa ' . $account->firstname . ' ' . $account->lastname));
        }
    }

    public static function register()
    {
        View::make('account/register.html');
    }

    public static function handle_register()
    {
        $params = $_POST;

        $attributes = array(
            'email' => $params['email'],
            'username' => $params['username'],
            'firstname' => $params['firstname'],
            'lastname' => $params['lastname'],
            'password' => $params['password'],
            'status' => 'Lisää oma statuksesi'
        );

        $account = new Account($attributes);
        $errors = $account->errors();

        if (count($errors) == 0) {
            $account->save();
            Redirect::to('/login', array('message' => 'Loit käytttäjän onnistuneesti'));
        } else {
            View::make('account/register.html', array('attributes' => $attributes, 'errors' => $errors));
        }
    }

}