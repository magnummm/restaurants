<?php


class pre
{

    public static function pretest($alexa){
        echo'<pre>';
        print_r($alexa);
        echo'</pre>';
    }

    public static function multiplizieren ($zahl1, $zahl2, $zahl3): int {
        $ergebnis = $zahl1 * $zahl2 * $zahl3;
        pre::pretest($ergebnis);
        return $ergebnis;
    }//zeile 13 -> zeile 14 -> zeile 15 -> zeile 7-11 -> zeile 16

    public static function multiplizieren2 ($zahle1, $zahle2, $zahle3): int {
        $ergebnis2 = $zahle1 * $zahle2 * $zahle3;
        pre::pretest($ergebnis2);
        return $ergebnis2;
    }

    public static function leistenkoennen ($kikki): bool {

        //wenn wert kleiner als 5000 -> nicht leistenkoennen
       $grenze = 5000;
        if ($kikki <= $grenze){
            echo 'nochmal jut jejangen';
            return true;
        }else {
            echo ' Ihr Guthaben reicht nicht...Erhöhen Sie es! ;) ';
            return false;
        }
    }

    public static function farbefuerzahl ($farbvoll) : string {
        //wenn zahl1 = rot, wenn zahl2 = blau, wenn zahl3 = gruen, wenn zahl 4 = gelb, sonst schwarz

        if($farbvoll === 1){
            $rot = 'rot';
            return $rot;
        }elseif ($farbvoll === 2){
            $blau = 'blau';
            return $blau;
        }elseif ($farbvoll === 3){
            return 'gruen';
        }elseif ($farbvoll === 4){
            return 'gelb';
        }else{
            return 'schwarz';
        }

    }




}

