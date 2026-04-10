<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="sinav2.php">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Adı</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="adı">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Soyadı</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="soyadı">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Sınıfı</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="sinifi">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Dosya Adı</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="dosya">
        </div>
        <input type="submit" class="btn btn-primary" name="yaz" placeholder="Dosyaya Yaz" />

        <?php
        if (isset($_POST["yaz"])) {
            $olustur = mkdir("amp12g");
            $ac = fopen("amp12g/".$_POST["dosya"].".txt", "a+");
            fwrite($ac, $_POST["sinifi"]." - ".$_POST["adı"]." ".$_POST["soyadı"]);
            fclose($ac);
            echo "işlem başarılı...";
        }
        ?>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>