<?php
require_once __DIR__ .'/vendor/autoload.php';
include_once './datos.php';
class Materia
{
    public $nombre;
    public $cuatrimestre;
    public $id;

    public function __construct($nombre,$cuatrimestre,$id)
    {
        $this->nombre=$nombre;
        $this->cuatrimestre=$cuatrimestre;
        $this->id=$id;
    }

    public static function Singin($nombre,$cuatrimestre)
     {
        $return=false;
        $newMateria = new Materia($nombre,$cuatrimestre, strtotime("now"));
        if (Datos::GuardarJSON("materias.json",$newMateria))
        {
            $return=true;
        }
        return $return;
     }

     public static function MateriaAlreadyExists($materia)
     {
        $return = false;
        $lista = Datos::TraerJson("materias.json");

        if ($lista==true)
        {
            foreach ($lista as $unamateria)
            {
                if ($unamateria->id == $materia->id)
                {
                    $return = true;
                }
            }
        }
        return $return;
     }

     public static function Verificar($id)
     {
        $return = false;
        $lista = Datos::TraerJson("materias.json");

        if ($lista==true)
        {
            foreach ($lista as $materia)
            {
                if ($materia->id == $id)
                {
                    $return = true;
                }
            }
        }
        return $return;
     }
}