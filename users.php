<?php
use \Firebase\JWT\JWT;
require_once __DIR__ .'/vendor/autoload.php';
include_once './datos.php';
class User
 {
     public $email;
     public $clave;

     public function __construct($email,$clave)
     {
        $this->email=$email;
        $this->clave=$clave;
     }

     public static function Singin($email,$clave)
     {
        $return=false;
        $newUser = new User($email,$clave);
        if (Datos::GuardarJSON("users.json",$newUser))
        {
            $return=true;
        }
        return $return;
     }

     public static function Login($email,$clave)
     {
        $return=false;
        $response = Datos::TraerJSON("users.json");

        if ($response!=false)
        {
            
            $key = "prog3-parcial";
            foreach ($response as $user)
            {
            if (User::validar($email, $clave, $user->email, $user->clave))
                {
                    $payload = array(
                        "email" => $email,
                        "clave" => $clave,
                    );
                    $return=true;
                break;
                }
            }
            if ($return)
            {
                $return = JWT::encode($payload, $key);
            }
        }
        return $return;
     }

     public static function validar($email,$clave, $emailNew, $passNew)
    {
        $return = false;
         if ($passNew == $clave && $email==$emailNew)
         {
             
            $return = true;
         }
        return $return;
    }

    public static function IsAdmin($token)
     {
        $response=false;
        try
        {
            $users = JWT::decode($token,"prog3-parcial", array("HS256"));
        }catch(Exception $ex)
        {
            $response = false;
        }
        
        $lista = Datos::TraerJson('users.json');
        
        if($users)
        {
            
            $response=true;
        }
        return $response;
     }

}

