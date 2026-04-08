<?php 

namespace App\Controllers;


class ErrorController{

    public static function error404($message='Not found'){
        http_response_code(404);

        loadView('error', ['status' => '404', 'message' => $message]);
    }

    public static function error403($message='Unauthorized'){
       http_response_code(403);

        loadView('error', ['status' => '403', 'message' => $message]);
    }
}