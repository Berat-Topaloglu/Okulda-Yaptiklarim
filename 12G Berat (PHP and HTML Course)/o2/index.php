<!DOCTYPE html>
<!-- saved from url=(0052)https://getbootstrap.com/docs/5.3/examples/checkout/ -->
<html lang="en" data-bs-theme="light">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta
    name="author"
    content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
  <meta name="generator" content="Astro v5.13.2" />
  <title>Checkout example · Bootstrap v5.3</title>
  <link
    rel="canonical"
    href="https://getbootstrap.com/docs/5.3/examples/checkout/" />
  <script src="./index_files/color-modes.js.indir"></script>
  <link
    href="./index_files/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" />
  <link
    rel="apple-touch-icon"
    href="https://getbootstrap.com/docs/5.3/assets/img/favicons/apple-touch-icon.png"
    sizes="180x180" />
  <link
    rel="icon"
    href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon-32x32.png"
    sizes="32x32"
    type="image/png" />
  <link
    rel="icon"
    href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon-16x16.png"
    sizes="16x16"
    type="image/png" />
  <link
    rel="manifest"
    href="https://getbootstrap.com/docs/5.3/assets/img/favicons/manifest.json" />
  <link
    rel="mask-icon"
    href="https://getbootstrap.com/docs/5.3/assets/img/favicons/safari-pinned-tab.svg"
    color="#712cf9" />
  <link
    rel="icon"
    href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon.ico" />
  <meta name="theme-color" content="#712cf9" />
  <link href="./index_files/checkout.css" rel="stylesheet" />
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: #0000001a;
      border: solid rgba(0, 0, 0, 0.15);
      border-width: 1px 0;
      box-shadow: inset 0 0.5em 1.5em #0000001a,
        inset 0 0.125em 0.5em #00000026;
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -0.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }

    .bd-mode-toggle .bi {
      width: 1em;
      height: 1em;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }
  </style>
</head>

<body class="bg-body-tertiary">
  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
      <path
        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
      <path
        d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
      <path
        d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
      <path
        d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
      <path
        d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
    </symbol>
  </svg>
  <div
    class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
    <button
      class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
      id="bd-theme"
      type="button"
      aria-expanded="false"
      data-bs-toggle="dropdown"
      aria-label="Toggle theme (light)">
      <svg class="bi my-1 theme-icon-active" aria-hidden="true">
        <use href="#sun-fill"></use>
      </svg>
      <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
    </button>
    <ul
      class="dropdown-menu dropdown-menu-end shadow"
      aria-labelledby="bd-theme-text">
      <li>
        <button
          type="button"
          class="dropdown-item d-flex align-items-center active"
          data-bs-theme-value="light"
          aria-pressed="true">
          <svg class="bi me-2 opacity-50" aria-hidden="true">
            <use href="#sun-fill"></use>
          </svg>
          Light
          <svg class="bi ms-auto d-none" aria-hidden="true">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
      <li>
        <button
          type="button"
          class="dropdown-item d-flex align-items-center"
          data-bs-theme-value="dark"
          aria-pressed="false">
          <svg class="bi me-2 opacity-50" aria-hidden="true">
            <use href="#moon-stars-fill"></use>
          </svg>
          Dark
          <svg class="bi ms-auto d-none" aria-hidden="true">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
      <li>
        <button
          type="button"
          class="dropdown-item d-flex align-items-center"
          data-bs-theme-value="auto"
          aria-pressed="false">
          <svg class="bi me-2 opacity-50" aria-hidden="true">
            <use href="#circle-half"></use>
          </svg>
          Auto
          <svg class="bi ms-auto d-none" aria-hidden="true">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
    </ul>
  </div>
  <div class="container">
    <main>
      <div class="py-5 text-center">
        <img
          class="d-block mx-auto mb-4"
          src="./index_files/bootstrap-logo.svg"
          alt=""
          width="72"
          height="57" />
        <h1 class="h2">Checkout form</h1>
        <p class="lead">
          Below is an example form built entirely with Bootstrap’s form
          controls. Each required form group has a validation state that can
          be triggered by attempting to submit the form without completing it.
        </p>
      </div>
      <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Your cart</span>
            <span class="badge bg-primary rounded-pill">3</span>
          </h4>
          <?php
            $pdo=new PDO("mysql:host=localhost; dbname=mydatabase", 'root','');
            $pdo->setAttribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
            $sql="SELECT * from myveri";
            $komut=$pdo->query($sql);
            while($row=$komut->fetch(PDO::FETCH_ASSOC)){
            echo "<li class='list-group-item d-flex justify-content-between 1h-sm'>
            <div>
            <h6 class='my-0'>".$row["ad"]." ".$row["soyad"]." ".$row["yas"]."</h6></div></li>";
            }
            ?>
          <!--<form class="card p-2">
            <div class="input-group">
              <input
                type="text"
                class="form-control"
                placeholder="Promo code" />
              <button type="submit" class="btn btn-secondary">Redeem</button>
            </div>
          </form>-->
        </div>
        <div class="col-md-7 col-lg-8">
          <h4 class="mb-3">Yeni Üye</h4>
          <form class="needs-validation" novalidate="" method="POST" action="index.php">
            <div class="row g-3">
              <div class="col-sm-4">
                <label for="firstName" class="form-label">Adı</label>
                <input
                  type="text"
                  class="form-control"
                  name="ad"
                  placeholder=""
                  value=""
                  required="" />
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-sm-4">
                <label for="lastName" class="form-label">Soyad</label>
                <input
                  type="text"
                  class="form-control"
                  name="soyad"
                  placeholder=""
                  value=""
                  required="" />
                <div class="invalid-feedback"></div>
              </div>
              <div class="col-sm-4">
                <label for="firstName" class="form-label">Yaşı</label>
                <input
                  type="text"
                  class="form-control"
                  name="yas"
                  placeholder=""
                  value=""
                  required="" />
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
            </div>
            <hr class="my-4" />
            <input class="w-100 btn btn-primary btn-lg" type="submit" value="ekle" name="ekleBtn" />
          </form>
          <?php

          if (isset($_POST["ekleBtn"])) {

            $pdo=new PDO("mysql:host=localhost;dbname=mydatabase",'root','');
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO myveri(ad,soyad,yas) VALUES(:ad,:soyad,:yas)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':ad' => $_POST["ad"], ':soyad' => $_POST["soyad"], ':yas' => $_POST["yas"]]);
            echo "Veri başarıyla eklendi!";
          }
          ?>
        </div>
      </div>
    </main>
    <footer class="my-5 pt-5 text-body-secondary text-center text-small">
      <p class="mb-1">© 2017–2025 Company Name</p>
      <ul class="list-inline">
        <li class="list-inline-item">
          <a href="https://getbootstrap.com/docs/5.3/examples/checkout/#">Privacy</a>
        </li>
        <li class="list-inline-item">
          <a href="https://getbootstrap.com/docs/5.3/examples/checkout/#">Terms</a>
        </li>
        <li class="list-inline-item">
          <a href="https://getbootstrap.com/docs/5.3/examples/checkout/#">Support</a>
        </li>
      </ul>
    </footer>
  </div>
  <script
    src="./index_files/bootstrap.bundle.min.js.indir"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    class="astro-vvvwv3sm"></script>
  <script
    src="./index_files/checkout.js.indir"
    class="astro-vvvwv3sm"></script>
</body>

</html>