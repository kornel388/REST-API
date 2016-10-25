<?php

namespace App\Controllers;

class AccountController extends Controller
{

  public function login($request, $response,$args) {
  //  $input = $request->getParsedBody();
  //   $login = $input['login'];
  //   $password = sha1($input['password']);
  //   // $password = $input['password'];
   //
  //   $query = $this->db->prepare("SELECT * FROM account WHERE login=:login AND password=:password");
  //   $query->bindParam("login", $login);
  //   $query->bindParam("password", $password);
  //   $query->execute();
  //   $account = $query->fetchObject();
  //   if ($account) {
  //     $session = new \RKA\Session();
  //     $session->id_user = $account->id;
  //   }else {
   //
  //   }
  //   return $this->response->withJson($account);
  phpinfo();
  }

   public function register($request, $response,$args)
  {
    $input = $request->getParsedBody();
    $login = $input['login'];
    $email = $input['email'];
    $password = sha1($input['password']);
    // $password = $input['password'];

    $query = $this->db->prepare("SELECT * FROM account WHERE login=:login OR email=:email");
    $query->bindParam("login", $login);
    $query->bindParam("email", $email);
    $query->execute();
    $account = $query->fetchObject();

    if (!$account) {
        $sth = $this->db->prepare("INSERT INTO account (`login`, `email`, `password`) VALUES (:login, :email, :password)");
        $sth->bindParam("login", $login);
        $sth->bindParam("email", $email);
        $sth->bindParam("password", $password);
        $sth->execute();
        echo 'Konto utworzone pomyślnie';
    }else {
      echo 'Email lub login zajety';
    }
  }
  public function logout($request, $response,$args) {
    \RKA\Session::destroy();
  }
  public function checkSession($request, $response,$args) {
    $session = new \RKA\Session();
    $id_user = $session->id_user;
      if($id_user > 0) {
          echo $id_user;
      }else {
          echo "Niezalogowany";
      }
  }
}
