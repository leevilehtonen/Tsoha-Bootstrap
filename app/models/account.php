<?php
/**
 * Created by PhpStorm.
 * User: lleevi
 * Date: 17.8.2017
 * Time: 0:11
 */

class Account extends BaseModel
{

    public $id, $username, $password, $email, $firstname, $lastname, $status;


    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->validators = array();
    }

    public static function find($id)
    {
        $query = DB::connection()->prepare('SELECT * FROM account WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $account = new Account(
                array(
                    'id' => $row['id'],
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'email' => $row['email'],
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'status' => $row['status']
                )
            );
            return $account;

        } else {
            return null;
        }
    }

    public static function authenticate($username, $password)
    {
        $account = Account::findByUsername($username);
        if (password_verify($password, $account->password)) {
            return $account;
        } else {
            return null;
        }
    }

    public static function findByUsername($username)
    {
        $query = DB::connection()->prepare('SELECT * FROM account WHERE username = :username LIMIT 1');
        $query->execute(array('username' => $username));
        $row = $query->fetch();

        if ($row) {
            $account = new Account(
                array(
                    'id' => $row['id'],
                    'username' => $row['username'],
                    'password' => $row['password'],
                    'email' => $row['email'],
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'status' => $row['status']
                )
            );
            return $account;

        } else {
            return null;
        }
    }

    public function save()
    {
        $query = DB::connection()->prepare('INSERT INTO account(username, password, email, firstname, lastname, status) VALUES(:username, :password, :email, :firstname, :lastname, :status) RETURNING id');
        $query->execute(array('username' => $this->username, 'password' => password_hash($this->password, PASSWORD_DEFAULT), 'email' => $this->email, 'firstname' => $this->firstname, 'lastname' => $this->lastname, 'status' => $this->status));

        $row = $query->fetch();
        $this->id = $row['id'];
    }


}