<?php

session_start();

include '../constants/functions.php';

$NewArrivals = NewArrivals();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil - MixMart</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


  <style>

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

    body{
        font-family: 'poppins', sans-serif;
    }

    .container-fluid {
      padding: 0;
    }

    .header-image {
        background-image: linear-gradient(to right, #434343 0%, black 100%);
        width: 100%;
        max-height: 400px;
        background-size: cover;
        background-position: center;
    }

    .logo-img {
        width: 50px;
        height: auto;
        margin-right: 10px;
    }

    .navbar-nav .nav-link:hover {
        color: #ffc107;
        transition : .3s
    }

    .position-relative {
        position: relative;
    }

    .position-absolute {
        position: absolute;
    }

    .top-50 {
        top: 50%;
    }

    .start-50 {
        left: 50%;
    }

    .translate-middle {
        transform: translate(-50%, -50%);
    }

    a,
    a:hover {
        text-decoration: none;
        color: inherit;
    }

    .section-products {
        padding: 80px 0 54px;
    }

    .section-products .header {
        margin-bottom: 50px;
    }

    .section-products .header h3 {
        font-size: 1rem;
        color: #fe302f;
        font-weight: 500;
    }

    .section-products .header h2 {
        font-size: 2.2rem;
        font-weight: 400;
        color: #444444; 
    }

    .section-products .single-product {
        margin-bottom: 26px;
    }

    .section-products .single-product .part-1 {
        position: relative;
        height: 290px;
        max-height: 290px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .section-products .single-product .part-1::before {
            position: absolute;
            content: "";
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            transition: all 0.3s;
    }

    .section-products .single-product:hover .part-1::before {
            transform: scale(1.2,1.2) rotate(5deg);
    }

    .section-products #product-1 .part-1::before {
        background-size: cover;
            transition: all 0.3s;
    }

    .section-products .single-product .part-1 .discount,
    .section-products .single-product .part-1 .new {
        position: absolute;
        top: 15px;
        left: 20px;
        color: #ffffff;
        background-color: #fe302f;
        padding: 2px 8px;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    .section-products .single-product .part-1 .new {
        left: 0;
        background-color: #444444;
    }

    .section-products .single-product .part-1 ul {
        position: absolute;
        bottom: -41px;
        left: 20px;
        margin: 0;
        padding: 0;
        list-style: none;
        opacity: 0;
        transition: bottom 0.5s, opacity 0.5s;
    }

    .section-products .single-product:hover .part-1 ul {
        bottom: 30px;
        opacity: 1;
    }

    .section-products .single-product .part-1 ul li {
        display: inline-block;
        margin-right: 4px;
    }

    .section-products .single-product .part-1 ul li a {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        background-color: #ffffff;
        color: #444444;
        text-align: center;
        box-shadow: 0 2px 20px rgb(50 50 50 / 10%);
        transition: color 0.2s;
    }

    .section-products .single-product .part-1 ul li a:hover {
        color: #fe302f;
    }

    .section-products .single-product .part-2 .product-title {
        font-size: 1rem;
    }

    .section-products .single-product .part-2 h4 {
        display: inline-block;
        font-size: 1rem;
    }

    .section-products .single-product .part-2 .product-old-price {
        position: relative;
        padding: 0 7px;
        margin-right: 2px;
        opacity: 0.6;
    }

    .section-products .single-product .part-2 .product-old-price::after {
        position: absolute;
        content: "";
        top: 50%;
        left: 0;
        width: 100%;
        height: 1px;
        background-color: #444444;
        transform: translateY(-50%);
    }

  </style>

</head>


<body>

    <?php include '../components/navbar.php'; ?>

        <div class="container-fluid header-image vh-100 position-relative">
            <div class="position-absolute top-50 start-50 translate-middle text-center text-light">
                <h2 class="display-4">Nouvelles Arrivées</h2>
                <p class="lead text-warning">Trouvez vos articles préférés dès maintenant</p>
                <a class="btn btn-outline-light border-light rounded-0">Découvrir</a>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row justify-content-around">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="mr-3">
                                <i class="fas fa-truck fa-2x text-danger"></i>
                            </div>
                            <div>
                                <p class="lead m-0">Livraison gratuite</p>
                                <p class="text-muted">Profitez de la livraison gratuite sur toutes vos commandes.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="mr-3">
                                <i class="fas fa-money-bill-wave fa-2x text-sucess"></i>
                            </div>
                            <div>
                                <p class="lead m-0">Remboursement facile</p>
                                <p class="text-muted">Retournez vos produits facilement et obtenez un remboursement complet.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="mr-3">
                                <i class="fas fa-headset fa-2x text-warning"></i>
                            </div>
                            <div>
                                <p class="lead m-0">Support 24h/24, 7j/7</p>
                                <p class="text-muted">Notre équipe de support client est disponible à tout moment pour vous aider.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid my-5">
            <div class="container">
                <p class="display-4 text-center">Découvrez nos dernières <span class="text-warning">collections</span></p>
                <hr>
            </div>
        </div>


        <section class="section-products py-5">
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                    <?php foreach($NewArrivals as $newProduct) : ?>
                        <div class="col">
                            <div id="product-1" class="single-product card border-0">
                                <div class="part-1 card-img-top m-0 position-relative">
                                    <img src="admin/pages/produits/<?php echo $newProduct['Image']; ?>" class="img-fluid d-block mx-auto" alt="Product Image" style="height: 200px;">
                                    <ul class="list-unstyled position-absolute top-0 start-0 m-3">
                                        <li><a href="#" class="text-dark"><i class="fas fa-shopping-cart"></i></a></li>
                                        <li><a href="#" class="text-dark"><i class="fas fa-heart"></i></a></li>
                                        <li><a href="#" class="text-dark"><i class="fas fa-plus"></i></a></li>
                                        <li><a href="#" class="text-dark"><i class="fas fa-expand"></i></a></li>
                                    </ul>
                                </div>
                                <div class="part-2 card-body">
                                    <h3 class="product-title card-title"><?php echo $newProduct['Nom']; ?></h3>
                                    <h4 class="product-price card-subtitle"><?php echo $newProduct['Prix']; ?> MRU</h4>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>



    <?php include '../components/footer.php'; ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>