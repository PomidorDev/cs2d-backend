<?php

include ('Number.php');



class Convert {
    function ConvertTo($value, $systemFrom, $systemTo) {

        $conv = new Number($value, $systemFrom, $systemTo);
        return  $conv->convert();
    }
}

