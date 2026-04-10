<?php
if ($_POST) {
    $Vize_Notu = $_POST["vize_notu"];
    $Final_Notu = $_POST["final_notu"];
    $sonuc=($Vize_Notu+$Final_Notu)/2;
    if ($sonuc>=65) {
        echo "Notu:".$sonuc.", Geçtiniz..";
    }
    else {
        echo "Notu:".$sonuc.", Kalıdınız..";
    }
}

?>