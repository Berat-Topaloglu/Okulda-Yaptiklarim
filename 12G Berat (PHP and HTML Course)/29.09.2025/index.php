<?php
if ($_POST) {
    $gelen_isim = $_POST["isim"];
    $gelen_soyisim = $_POST["soyisim"];

    echo "Gelen kişi:".$gelen_isim." Soyisim:".$gelen_soyisim;
}
else {
    echo "Lütfen bir veri ekleyiniz!!";
}
?>