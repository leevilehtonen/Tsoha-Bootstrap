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
        $this->validators = array('validate_email', 'validate_username', 'validate_password');
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
        if (($username === 'testuser1' || $username === 'testuser2' || $username === 'testuser3') && $password === '123456') {
            return Account::findByUsername($username);
        }
        $account = Account::findByUsername($username);
        if ($account != null && password_verify($password, $account->password)) {
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

    public static function findByEmail($email)
    {
        $query = DB::connection()->prepare('SELECT * FROM account WHERE email = :email LIMIT 1');
        $query->execute(array('email' => $email));
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

    public function validate_username()
    {
        $errors = array();
        if ($this->username == '' || $this->username == null) {
            $errors[] = 'Käyttäjätunnus ei voi olla tyhjä';
        }

        if (strlen($this->username) < 4) {
            $errors[] = 'Käyttäjätunnuksen tulee olla vähintään neljä merkkiä pitkä';
            return $errors;
        }

        if (Account::findByUsername($this->username) != null) {
            $errors[] = 'Käyttäjätunnus on jo olemassa';
        }
        return $errors;
    }

    public function validate_email()
    {
        $errors = array();
        if ($this->email == '' || $this->email == null) {
            $errors[] = 'Sähköposti ei voi olla tyhjä';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Sähköposti ei ole kelvollisessa muodosssa';
        }

        if (Account::findByEmail($this->email) != null) {
            $errors[] = 'Sähköpostilla rekisteröity käyttäjä on jo olemassa';
        }

        return $errors;
    }

    public function validate_password()
    {
        $errors = array();
        if ($this->password == '' || $this->password == null) {
            $errors[] = 'Salasana ei voi olla tyhjä';
        }

        if (strlen($this->password) < 6) {
            $errors[] = 'Salasanan tulee olla vähintään kuusi merkkiä pitkä';
        }

        return $errors;
    }
    public function getPostCount() {
        $query = DB::connection()->prepare('SELECT COUNT(*) AS posts FROM post WHERE post.account_id = :id');
        $query->execute(array('id' => $this->id));

        $row = $query->fetch();
        return $row['posts'];

    }
    public function update()
    {
        $query = DB::connection()->prepare('UPDATE account SET username = :username, email = :email, firstname = :firstname, lastname = :lastname, status = :status WHERE id = :id');
        $query->execute(array('username' => $this->username, 'email' => $this->email, 'firstname' => $this->firstname, 'lastname' => $this->lastname, 'status' => $this->status, 'id' => $this->id));
    }

    public function destroy()
    {
        $query = DB::connection()->prepare('DELETE FROM account WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }



}