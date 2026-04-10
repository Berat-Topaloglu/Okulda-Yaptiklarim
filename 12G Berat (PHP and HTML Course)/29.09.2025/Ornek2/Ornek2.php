<?php
if ($_POST) {
    $not_1 = $_POST["not1"];
    $not_2 = $_POST["not2"];
    $not_3 = $_POST["not3"];
    $ort = ($not_1+$not_2+$not_3)/3;
    
    if ($ort <= 49) {
        echo "Kaldınız..".$ort;
    }
    else {
        echo "Geçtiniz... Ortalamanız: ".$ort;
    }
}
else {
    echo "Lütfen veri ekleyiniz...";
}
?>