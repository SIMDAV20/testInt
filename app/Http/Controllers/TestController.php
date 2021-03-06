<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request) {
        /*  USE ESTE JSON PARA EL POSTMAN
            {
                "origin": [[1,2,3,4],[5,6,7,8], [9,10,11,12], [13,14,15,16]]
            }
        */

        $arrayOrigin = $request->origin;
        
        $qqt = count($arrayOrigin);

        // VALIDO SI NO CUMPLE CON LA MATRIX NXN
        foreach ($arrayOrigin as $key => $eachArray) {
            if (count($eachArray) !== $qqt) {
                return 'No cumple como matriz N X N'; // TERMINA
            }
        }
        // SINO, CREO UN ARREGLO 
        $arrayFirst = [];
        //DONDE PRIMERO GUARDO TODOS LOS ELEMENTOS DE LA MATRIZ DE FORMA ORIGINAL O COMO HAN LLEGADO
        foreach ($arrayOrigin as $eachArray) {
            foreach ($eachArray as $number) {
                array_push($arrayFirst, $number);
            }
        }
        //CREO UN ARREGLO DESTINO DONDE SERÁ MI NUEVA MATRIZ
        $arrayDestiny = [];
        // ITERO CON UN FOR - ME PARECIO MAS COMODO
        for ($j=0; $j < $qqt; $j++) {
            $getArray = $this->changeValues($arrayFirst, $j, $qqt);
            array_unshift($arrayDestiny, $getArray); // INGRESO DEL BLOQUE ADELANTE DEL ANTERIOR
        }

        return $arrayDestiny;
    }

    private function changeValues($arrayFirst, $j, $qqt) {
        // CON ESTE NUEVO ARREGLO EACH, SE REFIERE A CADA ARREGLO DEL ARREGLO GRANDE DONDE
        // CADA POCISION $j SE REFIERE A LA PRIMERA POSICION DE CADA $EACH
        // SUMANDOLE $qqt EN $i EN EL FOR, PARA ENCONTRAR LA MISMA POSICION DEL SIGUIENTE BLOQUE
        $each = [];
        for ($i = 0; $i < count($arrayFirst); $i = $i + $qqt) {
            array_push($each, $arrayFirst[$i + $j]);
        }
        return $each;
    }
}
