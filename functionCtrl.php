<?php
function fnumber($fharga){
    $harga = number_format($fharga,0,',','.');
    return $harga;
}
?>