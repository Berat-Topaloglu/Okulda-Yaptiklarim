<?php
if ($_POST) {
    $Sayi = $_POST["sayi"];
    
    if ($Sayi%2==0) {
        echo "Bu sayı çifttir: ".$Sayi;
    }
    else {
        echo "Bu bir tek sayıdır: ".$Sayi;
    }
}
else {
    echo "Lütfen veri ekleyiniz...";
}
?>