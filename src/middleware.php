<?php
// Application middleware

 // $app->add(new \Slim\Csrf\Guard);
$app->add(new \RKA\SessionMiddleware(['name' => 'AnonimoweApp']));
