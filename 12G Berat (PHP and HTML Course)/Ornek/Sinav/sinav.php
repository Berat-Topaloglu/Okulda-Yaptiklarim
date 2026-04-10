<?php
if ($_POST) {
    $Grup_Adi = $_POST["grup_adi"];
    $Fiyat = $_POST["fiyat"];
    if ($Grup_Adi=='A') {
        echo "KDV'li fiyatı:".($Fiyat+3);
    }
    else if ($Grup_Adi=='B') {
        echo "KDV'li fiyatı:".($Fiyat+5);
    }
    else if ($Grup_Adi=='C') {
        echo "KDV'li fiyatı:".($Fiyat+8);
    }
    else {
        echo "Vergi yok..".$Fiyat;
    }
}
else {
    echo "Lütfen düzgün gel";
}
?>