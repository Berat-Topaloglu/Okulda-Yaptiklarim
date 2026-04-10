<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="ornek.php" method="post">
        <input type="text" name="ad" placeholder="Lütfen isminiz giriniz" />
        <input type="number" name="yil" placeholder="Lütfen doğum yılınızı giriniz" />
        <input type="submit" name="gonder" value="Yazdır" />
    </form>

    <?php
        if (isset($_POST["gonder"])) {
            $Isim = $_POST["ad"];
            $Yil = $_POST["yil"];
            
            echo "Hoş Geldins:".$Isim." ".(2025-$Yil)." yaşındasınız";
        }
    ?>
</body>
</html>