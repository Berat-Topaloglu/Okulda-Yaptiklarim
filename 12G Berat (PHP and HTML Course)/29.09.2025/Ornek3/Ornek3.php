<?php
if ($_POST) {
    $Secim = $_POST["secim"];
    $Erkek = $_POST["erkek"];
    $Kız = $_POST["kız"];
    $Yas = $_POST["yas"];
    
    if ($Secim.$Erkek == true && $Yas==18) {
        echo "Askere gidiniz...";
    }
    else {
        echo "Askere gidemezsiniz...";
    }
}
else {
    echo "Lütfen veri ekleyiniz...";
}
?>