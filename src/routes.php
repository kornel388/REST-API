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

$app->post('/v1/login', 'AccountController:login');
$app->post('/v1/register', 'AccountController:register');
$app->post('/v1/logout', 'AccountController:logout');
$app->get('/v1/session', 'AccountController:checkSession');

/*
* Comments and subcomments controll
*
*/

//Get all comments from post
$app->get('/v1/comments','CommentController:index');

//Get this comment`
$app->get('/v1/comment/[{id}]', 'CommentController:getComment');

//Add new comments
$app->post('/v1/comment', 'CommentController:addComment');

//Update this comment
$app->put('/v1/comment/[{id}]', 'CommentController:updateComment');

//Delete comment
$app->delete('/v1/comment/[{id}]', 'CommentController:deleteComment');
