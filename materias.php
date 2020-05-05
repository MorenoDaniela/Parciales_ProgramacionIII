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
}