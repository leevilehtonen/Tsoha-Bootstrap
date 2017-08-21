<?php

require 'app/models/discussion.php';
require 'app/models/post.php';
require 'app/models/account.php';
require 'app/models/topic.php';
require 'app/models/tag.php';

  class BaseController{

    public static function get_user_logged_in(){

        if (isset($_SESSION['account'])) {
            $account_id = $_SESSION['account'];
            $account = Account::find($account_id);
            return $account;
        }
      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

  }
