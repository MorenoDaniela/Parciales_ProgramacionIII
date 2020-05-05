<?php
include_once './datos.php';
class Profesor
{
    public $nombre;
    public $legajo;
    public $foto;

    public function __construct($nombre,$legajo, $foto)
    {
        $this->nombre = $nombre;
        $this->legajo = $legajo;
        $this->foto = $foto;
    }

    public static function Singin($nombre,$legajo, $foto)
     {
        $return=false;
        $profe = new Profesor($nombre,$legajo, $foto);
        $lista = Datos::TraerJson("profesores.json");
        if (Profesor::ProfesorAlreadyExists($profe))
        {
            $return = "Un profesor no puede tener el mismo legajo que otro.";
        }else
        {
            if (Datos::GuardarJSON("profesores.json",$profe))
            {
                $return=true;
            }
        }
        return $return;
     }

     public static function ProfesorAlreadyExists($profe)
     {
        $return = false;
        $lista = Datos::TraerJson("profesores.json");

        if ($lista==true)
        {
            foreach ($lista as $unprofe)
            {
                if ($unprofe->legajo == $profe->legajo)
                {
                    $return = true;
                }
            }
        }
        return $return;
     }

     public static function Verificar($legajo)
     {
        $return = false;
        $lista = Datos::TraerJson("profesores.json");

        if ($lista==true)
        {
            foreach ($lista as $unprofe)
            {
                if ($unprofe->legajo == $legajo)
                {
                    $return = true;
                }
            }
        }
        return $return;
     }
}

