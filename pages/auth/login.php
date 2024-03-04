<?php
session_start(); // Démarrez la session

include '../../constants/functions.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nom_utilisateur_phone']) && isset($_POST['mot_de_passe'])) {
        $identifiant = $_POST['nom_utilisateur_phone'];
        $password = $_POST['mot_de_passe'];

        if (empty($identifiant) || empty($password)) {
            $error_message = "Veuillez remplir tous les champs !";
        } else {
            try {
                if (authentifier_user($identifiant, $password)) {
                    // Authentification réussie, rediriger vers la page appropriée
                    if($_SESSION['Statut'] == 'admin'){
                        header("Location: ../admin/index.php");
                        exit(); // Arrêter l'exécution du script après la redirection
                    } else {
                        header('Location: ../accueil.php');
                        exit(); // Arrêter l'exécution du script après la redirection
                    }
                } else {
                    // Authentification échouée, afficher un message d'erreur
                    $error_message = "Nom d'utilisateur ou mot de passe incorrect !";
                }
            } catch (PDOException $e) {
                // Gérer les erreurs de base de données avec une exception
                $error_message = "Erreur de base de données: " . $e->getMessage();
            }
        }
    }
}

// Si un message d'erreur est présent, stockez-le dans la session pour l'afficher après la redirection
if (!empty($error_message)) {
    $_SESSION['error_message'] = $error_message;
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Si redirigé depuis une soumission précédente avec un message d'erreur, affichez-le
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>Se connecter</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" 
    />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            margin-top: 100px;
        }

        .login-form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
        }

        .login-form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-form-header h2 {
            color: #ffc107;
        }

        .login-form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .login-form-footer a {
            color: #212529;
        }
    </style>
</head>

<body>
        
    <nav class="navbar navbar-expand-lg navbar-light bg-white">

    <!-- Brand/logo -->
    <a class="navbar-brand text-warning" href="#">
        MIXMART
    </a>

    <!-- Toggle button for small screens -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navigation links and search bar -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="../accueil.php">Accueil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../boutique.php">Boutique</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCategories" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categories
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownCategories">
            <a class="dropdown-item" href="#">Category 1</a>
            </div>
        </li>
        </ul>

        <!-- Search form -->
        <form action="searchArea.php" method="POST" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" name="search" type="search" placeholder="Rechercher..." aria-label="Search">
        <button class="btn btn-outline-warning my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
        </form>

        <!-- User profile and account -->
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAccount" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i>        
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownAccount">
            <a class="dropdown-item" href="login.php">Se connecter</a>
            <a class="dropdown-item" href="register.php">S'inscrire</a>
            </div>
        </li>
        </ul>
    </div>
    </nav>
        

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-container">
                    <div class="login-form">
                        <div class="login-form-header">
                            <h2 class="display-4">Se connecter</h2>
                        </div>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nom d'utilisateur / Téléphone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control rounded-0 py-2" name="nom_utilisateur_phone" id="username" placeholder="Entrez votre identifiant" aria-label="Nom d'utilisateur ou Numéro de téléphone">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <div class="input-group">
                                    <input type="password" class="form-control rounded-0 py-2" name="mot_de_passe" id="password" placeholder="Entrez votre mot de passe" aria-label="Mot de passe" aria-describedby="password-addon">
                                    <span class="input-group-text" id="password-addon"><i class="fas fa-lock"></i></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-warning w-100 py-2 mt-2 rounded-0">Se connecter</button>
                        </form>
                        <div class="login-form-footer">
                            <p>Pas encore de compte ? <a href="register.php" class="text-decoration-none text-warning">Inscrivez-vous</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($error_message)) : ?>
        <script>
            Swal.fire({
                title: "",
                text: "<?php echo $error_message; ?>",
                icon: "error"
            });
        </script>
    <?php endif; ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>