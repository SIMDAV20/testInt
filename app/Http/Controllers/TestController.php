<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request) {

        $arrayOrigin = $request->origin;
        
        $qqt = count($arrayOrigin);

        foreach ($arrayOrigin as $key => $eachArray) {
            if (count($eachArray) !== $qqt) {
                return 'No cumple como matriz N X N';
            }
        }

        $arrayFirst = [];
        foreach ($arrayOrigin as $eachArray) {
            foreach ($eachArray as $number) {
                array_push($arrayFirst, $number);
            }
        }
        
        $arrayDestiny = [];
        for ($j=0; $j < $qqt; $j++) {
            $getArray = $this->changeValues($arrayFirst, $j, $qqt);
            array_unshift($arrayDestiny, $getArray);
        }
        

        return $arrayDestiny;
    }

    private function changeValues($arrayFirst, $j, $qqt) {
        $one = [];
        for ($i = 0; $i < count($arrayFirst); $i = $i + $qqt) {
            array_push($one, $arrayFirst[$i + $j]);
        }
        return $one;
    }
}
