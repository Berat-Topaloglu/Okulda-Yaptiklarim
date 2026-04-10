<?php
if ($_POST) {
    $kullaniciadi = $_POST["isim"];
    $sifre = $_POST["sifre"];
    
    if ($sifre == "Tuzla123" && $kullaniciadi=="Tuzla") {
        echo "Tebrikler giriş başarılı..";
    }
    else {
        echo "Lütfen tekrar deneyin!!";
    }
}
else {
    echo "Lütfen veri ekleyiniz...";
}
?>