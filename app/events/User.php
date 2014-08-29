<?php  namespace events;


class User
{
    public function __construct() {
        return "burek";
    }

    public function hasRegistered($user)
    {
        echo "HAS REGISTERED from USER EVENT <br/>";

        echo "<pre>";
        var_dump($user);
        echo "</pre>";
    }
} 