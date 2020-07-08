<?php


class Format
{
    public static function deutschesZeitformat(string $datum):string {
        //'2014-12-20' explode => array('2014', '12', '20'), Trenner ist "-"
        $datumArray = explode('-',$datum);
        // array_reserve dreht die Reihenfolge der Elemente im Array um
        // array => array ('20', '12', '20')
        $datumArrayUmgekehrt = array_reverse($datumArray);
        // implode => '20.12.2014' mit "." als Trenner
        $datumDeutsch = implode('.', $datumArrayUmgekehrt);
        return $datumDeutsch;
    }
    public static function sqlZeitformat(string $datum):string {
        // explode wandelt in ein array um aus 2014-12-20 wird 2014,12,20, Trenner ist "-"
        $datumArray = explode('.',$datum);
        // array_reserve dreht die Reihenfolge der Elemente im Array um
        // array => array ('20', '12', '20')
        $datumArrayUmgekehrt = array_reverse($datumArray);
        // implode wandelt ein array in einen string um
        $datumDeutsch = implode('-', $datumArrayUmgekehrt);
        return $datumDeutsch;
    }
}