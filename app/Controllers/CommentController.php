<?php

namespace App\Controllers;

class CommentController extends Controller
{
  public function index($request, $response,$args) {
    try {
      $input = $request->getParsedBody();
      $query = $this->db->prepare("SELECT * FROM comments WHERE id_post=:id_post");
      $query->bindParam("id_post", $input['id_post']);
      $query->execute();
      $posts = $query->fetchAll();
      return $this->response->withJson($posts);
    } catch (Exception $e) {
        echo $e;
    }
  }

  public function getComment($request, $response,$args) {
    try {
      $query = $this->db->prepare("SELECT * FROM comments WHERE id_comment=:id");
      $query->bindParam("id", $args['id']);
      $query->execute();
      $posts = $query->fetchObject();
      return $this->response->withJson($posts);
    } catch (Exception $e) {
      echo $e;
    }

  }

  public function addComment($request, $response,$arg) {
    try {


        $input = $request->getParsedBody();
        $sql = "INSERT INTO comments (`id_user`,`id_post`,`content`) VALUES (:id_user, :id_post, :content)";
        $query = $this->db->prepare($sql);
        $query->bindParam("id_user", $input['id_user']);
        $query->bindParam("id_post", $input['id_post']);
        $query->bindParam("content", $input['content']);
        $query->execute();
    //    $input['id'] = $this->db->lastInsertId();
        return $this->response->withJson("Komentarz został pomyślnie dodany");
    } catch (Exception $e) {
      echo $e;
    }

  }

  public function updateComment($request,$response,$arg) {
    try {
            $input = $request->getParsedBody();
            $sql = "UPDATE comments SET content=:content WHERE id_comment=:id";
            $query = $this->db->prepare($sql);
            $query->bindParam("id", $arg['id']);
            $query->bindParam("content", $input['content']);
            $query->execute();
            $input['id'] = $args['id'];
            return $this->response->withJson("Komentarz został pomyślnie zaktualizowany");
    } catch (Exception $e) {
      echo $e;
    }
  }
  public function deleteComment($request, $response,$arg) {
    try {
      $sth = $this->db->prepare("DELETE FROM comments WHERE id_comment=:id");
      $sth->bindParam("id", $arg['id']);
      $sth->execute();
      return $this->response->withJson("Komentarz usunięty");
    } catch (Exception $e) {
      echo $e;
    }
  }


}
