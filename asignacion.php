<?php
include_once './profesores.php';
include_once './materias.php';
include_once './datos.php';

class Asignacion
{
    public $legajo;
    public $id;
    public $turno;

    public function __construct($legajo,$id,$turno)
    {
        $this->legajo=$legajo;
        $this->id=$id;
        $this->turno=$turno;
    }

    public static function Singin($legajo, $id,$turno)
     {
        $return=false;
        $asig = new Asignacion($legajo, $id, $turno);
        $lista = Datos::TraerJson("materias-profesores.json");
        if (Asignacion::AsignacionAlreadyExists($asig))
        {
            $return = "No se puede asignar el mismo legajo en el mismo turno y materia.";
        }else
        {
            if (Datos::GuardarJSON("materias-profesores.json",$asig))
            {
                $return=true;
            }
        }
        return $return;
     }

     public static function AsignacionAlreadyExists($asig)
     {
        $return = false;
        $lista = Datos::TraerJson("materias-profesores.json");

        if ($lista==true)
        {
            foreach ($lista as $unaasignacion)
            {
                if ($unaasignacion->legajo == $asig->legajo && $unaasignacion->id == $asig->id && $unaasignacion->turno == $asig->turno)
                {
                    $return = true;
                }
            }
        }
        return $return;
     }

     public static function MostrarMateriasAsignadas()
     {
         $return = false;
         $materias = Datos::TraerJson("materias-profesores.json");
         $profesores = Datos::TraerJson("profesores.json");
         if ($materias==true && $profesores==true)
         {
            foreach ($materias as $materia)
            {
                foreach ($profesores as $profe)
                {
                    if ($profe->legajo == $materia->legajo)
                    {
                        echo "Profesor: {$profe->nombre} dicta la materia con id: {$materia->id}.";
                        $return=true;
                    }
                }
            }
         }
         return $return;
     }
     
}