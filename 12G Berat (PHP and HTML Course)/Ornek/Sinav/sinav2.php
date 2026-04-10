<?php
if ($_POST) {
    $Sayi = $_POST["sayi"];
    $Sayi2 = $_POST["sayi2"];
    $Bolunen = $_POST["bolunen"];
    $sayac=0;
    $bolme=0;
    for ($i=$Sayi; $i < $Sayi2; $i++) { 
        if ($i%$Bolunen==0) {
            echo $i."<br>";
            $sayac=$sayac+$i;
            $bolme++;
        }
    }
    echo "Sayıların toplamı:".$sayac."<br>";
    echo "Sayıların ortalaması:".($sayac/$bolme);
}
else {
    echo "Lütfen düzgün gel";
}
?>