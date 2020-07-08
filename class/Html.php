<?php


class Html
{
    public static function getPullDown(array $idName, string $varName): string
    {
        $html = '';
        $html .= '<select name=" ' . $varName . '[]" multiple size = "4">';
        $html .= '<option value="0"></option>';
        for ($i = 0; $i < count($idName); $i++) {
            $html .= '<option value=" ' . $idName[$i]->getId() . '">' . $idName[$i]->getName() . '</options>';
        }
        $html .= '</select>';
        return $html;
    }

    public static function getPullDownPreSelected(array $idName, string $varName, Restaurant $restaurant): string
    {
        $restauranttypIds = self::getRestauranttypIdAsSelected($restaurant);

        $html = '';
        $html .= '<select name=" ' . $varName . '[]" multiple size = "4">';
        $html .= '<option value="0"></option>';
        for ($i = 0; $i < count($idName); $i++) {
//            if ($i === 3){
//                $html .= '<option value=" ' . $idName[$i]->getId() . '" selected >' . $idName[$i]->getName() . '</options>';
//            } else {
//                $html .= '<option value=" ' . $idName[$i]->getId() . '">' . $idName[$i]->getName() . '</options>';
//            }
            $html .= '<option value=" ' . $idName[$i]->getId() . '" ' . $restauranttypIds[$i] .'>' . $idName[$i]-> getName() . '</options>';
        }
        $html .= '</select>';
        return $html;
    }

    public static function getRestauranttypIdAsSelected(Restaurant $r) : array {

        $ids = [];
        $restauranttypIds = [];
        for ($i = 0; $i < count($r->getRestauranttypen()); $i++){
            array_push($ids, $r->getRestauranttypen()[$i]->getId());
        }
//        echo'<pre>';
//        print_r($ids);
//        echo '</pre>';
        // Ziel: ein Array, welches Leerstrings enthält, nur an den Stellen, die in ids vorkommen. Dort soll '' selected drin stehen
        // diese Array heisst $rTypIds

        $rTypIds = [];


        for ($i = 1; $i < count(Restauranttyp::getDataFromDatabase()) + 1; $i++){

//            //brauche Funktion, die mir die sagt, ob $i in $ids() drin ist
            if (in_array($i, $ids)) {
                array_push($rTypIds, 'selected');
            } else{
                array_push($rTypIds, '');
            }
        }
        //echo count(Restauranttyp::getDataFromDatabase());
//        echo'<pre>';
//        print_r($rTypIds);
//        echo '</pre>';
        return $rTypIds;
    }

}