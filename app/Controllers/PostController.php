<?php

namespace App\Controllers;

class PostController extends Controller
{


  public function index($request, $response,$args) {
    try {
      $query = $this->db->prepare("SELECT * FROM posts ORDER BY id_post DESC");
      $query->execute();
      $posts = $query->fetchAll();
      return $this->response->withJson($posts);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
  }

  public function getPost($request, $response,$args) {
    try {
      $query = $this->db->prepare("SELECT * FROM posts WHERE id_post=:id");
      $query->bindParam("id", $args['id']);
      $query->execute();
      $posts = $query->fetchObject();
      return $this->response->withJson($posts);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

  }

  public function addPost($request, $response,$arg) {
    try {
      $session = new \RKA\Session();
        $id_user = $session->id_user;
        $input = $request->getParsedBody();
        $sql = "INSERT INTO posts (`title`,`content`,`id_user`) VALUES (:title, :content, :id_user)";
        $query = $this->db->prepare($sql);
        $query->bindParam("title", $input['title']);
        $query->bindParam("content", $input['content']);
        $query->bindParam("id_user", $input['id_user']);
        $query->execute();
    //    $input['id'] = $this->db->lastInsertId();
        return $this->response->withJson("Post został pomyślnie dodany");
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

  }

  public function updatePost($request,$response,$arg) {
    try {
            $input = $request->getParsedBody();
            $sql = "UPDATE posts SET title=:title, content=:content WHERE id_post=:id";
            $query = $this->db->prepare($sql);
            $query->bindParam("id", $args['id']);
            $query->bindParam("title", $input['title']);
            $query->bindParam("content", $input['content']);
            $query->execute();
            $input['id'] = $args['id'];
            return $this->response->withJson("Post został pomyślnie zaktualizowany");
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
  public function deletePost($request, $response,$arg) {
    try {
      $sth = $this->db->prepare("DELETE FROM posts WHERE id_post=:id");
      $sth->bindParam("id", $args['id']);
      $sth->execute();
      return $this->response->withJson("Post are deleted  ");

    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

}
