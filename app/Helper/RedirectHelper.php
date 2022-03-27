<?php
namespace App\Helper;

class RedirectHelper{
    public static function redirectRouteStatus(string $route,string $element, string $message){
        return redirect()->route($route)->with('status', notify()->$element($message,ucfirst($element),"topRight"));

    }

    public static function redirectBackStatus(string $element, string $message){
        return redirect()->back()->with('status', notify()->$element($message,ucfirst($element),"topRight"));
    }
}

