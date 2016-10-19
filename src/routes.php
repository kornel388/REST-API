<?php
// Routes

//Get all posts
$app ->get('/posts', function ($request, $response,$args) {

try {
  $query = $this->db->prepare("SELECT * FROM posts");
  $query->execute();
  $posts = $query->fetchAll();
  return $this->response->withJson($posts);

} catch (Exception $e) {
    echo $e;
}
});
//Get this post
$app->get('/post/[{id}]', function ($request, $response, $args) {
  try {
    $query = $this->db->prepare("SELECT * FROM posts WHERE id_post=:id");
    $query->bindParam("id", $args['id']);
    $query->execute();
    $posts = $query->fetchObject();

    return $this->response->withJson($posts);
  } catch (Exception $e) {
    echo $e;
  }

});

//Add new post
$app->post('/post', function ($request, $response,$args) {
  try {
      $input = $request->getParsedBody();
      $sql = "INSERT INTO posts (`title`,`content`) VALUES (:title, :content)";
      $query = $this->db->prepare($sql);
      $query->bindParam("title", $input['title']);
      $query->bindParam("content", $input['content']);
      $query->execute();
  //    $input['id'] = $this->db->lastInsertId();
      return $this->response->withJson("Post został pomyślnie dodany");
  } catch (Exception $e) {
    echo $e;
  }

});

//Update this posts

$app->put('/post/[{id}]', function ($request, $response, $args) {
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
    echo $e;
  }

    });


//Delete post
$app->delete('/post/[{id}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("DELETE FROM posts WHERE id_post=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        return $this->response->withJson("Post are deleted  ");
    });
