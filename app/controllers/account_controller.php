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

    public static function handle_logout()
    {
        $_SESSION = array();
        unset($_SESSION);
        session_destroy();
        Redirect::to('/', array('message' => 'Kirjauduit ulos'));
    }

    public static function show($id) {
        $account = Account::find($id);
        View::make('account/profile.html', array('account' => $account));
    }

    public static function edit($id) {
        $account = Account::find($id);
        View::make('account/edit_profile.html', array('account' => $account));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'username' => $params['username'],
            'email' => $params['email'],
            'firstname' => $params['firstname'],
            'lastname' => $params['lastname'],
            'status' => $params['status'],
        );

        $account = new Account($attributes);
        $errors = $account->errors();

        if (count($errors) == 0) {
            $account->update();
            Redirect::to('/account/' . $account->id, array('message' => 'Muokkasit käyttäjätietojasi onnistuneesti'));
        } else {
            View::make('account/edit_profile.html', array('account' => $account, 'errors' => $errors));
        }
    }

    public static function destroy($id)
    {
        $account = Account::find($id);
        $account->destroy();
        $_SESSION = array();
        unset($_SESSION);
        session_destroy();
        Redirect::to('/', array('message' => 'Poistit käyttäjäsi onnistuneesti'));
    }

}