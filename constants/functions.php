<?php

// Fonction de connexion à la base de données
function connect() {
    $host = 'localhost'; // ou le nom de l'hôte si différent
    $dbname = 'project_ec';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Définir le mode d'erreur PDO sur Exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}








//-----------------Authentification-------------------------
function authentifier_user($identifiant, $mot_de_passe) {
    $connect = connect();
    
    // Prévenir les injections SQL
    $stmt = $connect->prepare("SELECT * FROM users WHERE (Nom_utilisateur = :identifiant OR Phone = :identifiant)");
    $stmt->bindParam(':identifiant', $identifiant);
    $stmt->execute();
    
    $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($resultat) {
        // Vérifiez si le mot de passe fourni correspond au mot de passe haché stocké dans la base de données
        if (password_verify($mot_de_passe, $resultat['Mot_de_passe'])) {
            // Si la vérification réussit, définissez les paramètres de session
            $_SESSION['ID_user'] = $resultat['ID_user'];
            $_SESSION['Prenom'] = $resultat['Prenom'];
            $_SESSION['Nom'] = $resultat['Nom'];
            $_SESSION['Nom_utilisateur'] = $resultat['Nom_utilisateur'];
            $_SESSION['Phone'] = $resultat['Phone'];
            $_SESSION['Statut'] = $resultat['Statut'];
            return true;
        }
    }
    
    return false;
}

//-----------------Registration--------------------------

function register($prenom, $nom, $tel, $nom_user, $mdp) {
    try {
        // Connexion à la base de données avec PDO
        $pdo = new PDO("mysql:host=localhost;dbname=project_ec", "root", "");
        // Définir le mode d'erreur PDO sur Exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête d'insertion avec des paramètres
        $stmt = $pdo->prepare("INSERT INTO users (Prenom, Nom, Phone, Nom_utilisateur, Mot_de_passe, Statut) 
                               VALUES (:prenom, :nom, :tel, :nom_user, :mdp, 'client')");

        // Liage des valeurs des paramètres
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':nom_user', $nom_user);
        // Pour des raisons de sécurité, il est recommandé de hacher les mots de passe avant de les stocker en base de données
        $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
        $stmt->bindParam(':mdp', $mdp_hash);

        // Exécuter la requête
        $stmt->execute();

        return true; // Succès de l'insertion
    } catch(PDOException $e) {
        // En cas d'erreur, afficher ou journaliser le message d'erreur
        echo "Erreur lors de l'insertion des données : " . $e->getMessage();
        return false; // Échec de l'insertion
    }
}









//----------------Some GET for some sections------------

function NewArrivals() {
    $connect = connect(); 

    $sql = "SELECT * FROM produit ORDER BY DateCreation DESC LIMIT 4";

    // Exécuter la requête SQL
    $stmt = $connect->query($sql);

    // Récupérer les résultats
    $newArrivals = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fermer la connexion
    $connect = null;

    return $newArrivals;
}











//--------------------C-------------------------

function insertProduit($nom, $description, $prix, $stock, $categorie, $image) {
    // Connexion à la base de données
    $connect = connect();

    // Préparation de la requête SQL
    $sql = "INSERT INTO produit (categorie_id ,Nom, Description, Prix, Stock_disponible, Image) VALUES (?, ?, ?, ?, ?, ?)";

    // Préparation de la déclaration
    $stmt = $connect->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(1, $categorie);
    $stmt->bindParam(2, $nom);
    $stmt->bindParam(3, $description);
    $stmt->bindParam(4, $prix);
    $stmt->bindParam(5, $stock);
    $stmt->bindParam(6, $image);

    // Exécution de la requête
    if ($stmt->execute()) {
        return true; // Succès de l'insertion
    } else {
        return false; // Échec de l'insertion
    }

    // Fermeture de la connexion et de la déclaration
    $stmt->close();
    $connect = null;
}

function insertCategorie($nom_categorie) {
    
    $connect = connect();

    $sql = "INSERT INTO categorie (Nom_categorie) VALUES (?)";

    $result = $connect->prepare($sql);

    $result->bindParam(1, $nom_categorie);

    if($result->execute()){
        return true;
    }else {
        return false;
    }

    $result->close();

    $connect = null;


}

//-------------------R-------------------------

function GetAllProducts() {
    $connect = connect();
    
    $sql = "SELECT produit.*, categorie.Nom_categorie AS Nom_categorie FROM produit
    INNER JOIN categorie ON produit.categorie_id = categorie.ID_Categorie
    ORDER BY DateCreation DESC";
    
    $stmt = $connect->query($sql);
    
    $allProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $connect = null;
    
    return $allProducts;
}

function getAllCategories() {
    $connect = connect();

    $sql = "SELECT * FROM categorie";

    $result = $connect->query($sql);

    $allCategories = $result->fetchAll(PDO::FETCH_ASSOC);

    $connect = null;

    return $allCategories;
}


?>
