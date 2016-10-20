<?php
//Get all posts
$app->get('/v1/posts','PostController:index');

//Get this post
$app->get('/v1/post/[{id}]', 'PostController:getPost');

//Add new post
$app->post('/v1/post', 'PostController:addPost');

//Update this posts
$app->put('/v1/post/[{id}]', 'PostsController:updatePost');

//Delete post
$app->delete('/v1/post/[{id}]', 'PostController:deletePost');


/*
* Account control - Login,Register and account delete
* Later maybe password resend
*/

$app->post('/v2/login', 'AccountController:login');
$app->post('/v2/register', 'AccountController:register');

/*
* Comments and subcomments controll
*
/*
