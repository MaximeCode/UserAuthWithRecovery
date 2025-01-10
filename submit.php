<?php
session_start();
require_once './pdoConnection/db.php';
require_once './functions.php';
// Récupération des données du formulaire

try {// Connexion à la base de données
    $db = db::getInstance();
    $dbh = $db->getDbh();
} catch (Exception $e) {
    throw new Error($e->getMessage());
}

// Les données proviennent du formulaire de connexion
if (isset($_POST['itsLogin']) && $_POST['itsLogin']) {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        try {
            $user = findUser($dbh, $login);
        } catch (Exception $e) {
            $_SESSION['logged'] = false;
            $_SESSION['msg'] = 'Erreur lors de la connexion : ' . $e->getMessage();
            throw new Error($e->getMessage());
        }

        // Vérification des identifiants
        if ($user && password_verify($password, $user['pwd'])) {
            $_SESSION['login'] = $login;
            $_SESSION['logged'] = true;
            $_SESSION['msg'] = 'Connexion réussi';

            $infoCommunes = findCommune($dbh, $user['id']);
            $_SESSION['commune'] = $infoCommunes['nom'];

            // Redirection vers la page d'accueil de l'app principale
            header('Location: ./home.php');
            exit();

        } else {
            $_SESSION['logged'] = false;
            $_SESSION['msg'] = 'Identifiants incorrects';
        }
    } else {
        $_SESSION['logged'] = false;
        $_SESSION['msg'] = 'Veuillez remplir tous les champs';
    }
// Les données proviennent du formulaire d'inscription
} else if (isset($_POST['itsSign_up']) && $_POST['itsSign_up']) {
    if (isset($_POST['name']) && isset($_POST['login']) && isset($_POST['password'])) {
        $name = $_POST['name'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        // Hashage du mot de passe
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $user = findUser($dbh, $login);
        // Vérification de l'existence de l'utilisateur
        if ($user) {
            $_SESSION['logged'] = false;
            $_SESSION['msg'] = 'Utilisateur déjà existant';
        } else {
            try {
                // Ajout des identifiants dans la base de données
                $insert = "INSERT INTO login (login, pwd) VALUES (:login, :password)";
                $stmt = $dbh->prepare($insert);
                $stmt->bindParam(':login', $login);
                $stmt->bindParam(':password', $passwordHash);
                $stmt->execute();

                // Ajout des infos dans la table Communes
                $insert = "INSERT INTO communes (nom, login_id) VALUES (:name, :login_id)";
                $stmt = $dbh->prepare($insert);
                $stmt->bindParam(':name', $name);
                $lastInsertId = $dbh->lastInsertId();
                $stmt->bindParam(':login_id', $lastInsertId);
                $stmt->execute();

                $_SESSION['login'] = $login;
                $_SESSION['logged'] = true;
                $_SESSION['msg'] = 'Inscription réussie';
                $infoCommunes = findCommune($dbh, $lastInsertId);
                $_SESSION['commune'] = $infoCommunes['nom'];

                // Redirection vers la page d'accueil de l'app principale
                header('Location: ./home.php');
                exit();
            } catch (Exception $e) {
                $_SESSION['logged'] = false;
                $_SESSION['msg'] = 'Erreur lors de l\'inscription : ' . $e->getMessage();
                throw new Error($e->getMessage());
            }
        }
    } else {
        $_SESSION['logged'] = false;
        $_SESSION['msg'] = 'Veuillez remplir tous les champs';
    }
// Les données proviennent du formulaire de mot de passe oublié
} else if (isset($_POST['itsForgotPwd']) && $_POST['itsForgotPwd']) {
    if (isset($_POST['loginByMail'])) {
        $loginByMail = $_POST['loginByMail'];
        $user = findUser($dbh, $loginByMail);
        if ($user) {
            // Envoi du mail de réinitialisation
            $code = gen_mdp(6, 'chiffres'); // Génération d'un code de 6 chiffres
            $to = 'ketefem686@pariag.com'; // $loginByMail; Address mail de l'utilisateur !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            $subject = 'Code de récupération Eurelien';
            $message = '
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Réinitialisation de votre mot de passe</title>
</head>
<body>
    <p style="margin-bottom: 10px;">Voici votre code de récupération pour la réinitialisation de votre mot de passe :</p>
    <p><strong>Votre commune :</strong> ' . htmlspecialchars(findCommune($dbh, $user['id'])['nom']) . '</p>
    <p><strong>Le code :</strong> <span style="color: #007bff; font-weight: bold;">' . htmlspecialchars($code) . '</span></p>
</body>
</html>
';

// En-têtes pour un email HTML
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";

// En-têtes pour l'expéditeur
            $headers .= 'From: App_Communes-Eurelien <no-reply@app_commune-eurelien.com>' . "\r\n";
            try {
                $response = mail($to, $subject, $message, $headers);
            } catch (Exception $e) {
                $_SESSION['logged'] = false;
                $_SESSION['msg'] = 'Erreur lors de l\'envoi du mail : ' . $e->getMessage();
                throw new Error($e->getMessage());
            }
            $_SESSION['mail'] = $response;
            $_SESSION['codeVerif'] = $code;
            $_SESSION['login'] = $loginByMail;
        } else {
            $_SESSION['logged'] = false;
            $_SESSION['msg'] = 'Utilisateur inconnu';
        }
    } else {
        $_SESSION['logged'] = false;
        $_SESSION['msg'] = 'Erreur, veuillez réessayer';
    }
    // Redirection vers la page de réinitialisation
    header('Location: ./pwdForgot.php');
    exit();
// Les données proviennent du formulaire de réinitialisation de mot de passe
} elseif (isset($_POST['itsResetPwd']) && $_POST['itsResetPwd']) {
    if (isset($_POST['codeVerif']) && isset($_POST['newPwd'])) {
        $codeVerif = $_POST['codeVerif'];
        $newPwd = $_POST['newPwd'];
        if ($codeVerif === $_SESSION['codeVerif']) {
            $login = $_SESSION['login'];
            $passwordHash = password_hash($newPwd, PASSWORD_BCRYPT);
            try {
                $update = "UPDATE login SET pwd = :password WHERE login = :login";
                $stmt = $dbh->prepare($update);
                $stmt->bindParam(':password', $passwordHash);
                $stmt->bindParam(':login', $login);
                $stmt->execute();
                $_SESSION['logged'] = true;
                $_SESSION['msg'] = 'Mot de passe réinitialisé ! Vous pouvez maintenant vous connecter avec vos nouveaux identifiants';
                unset($_SESSION['codeVerif']);
            } catch (Exception $e) {
                $_SESSION['logged'] = false;
                $_SESSION['msg'] = 'Erreur lors de la réinitialisation du mot de passe : ' . $e->getMessage();
                throw new Error($e->getMessage());
            }
        } else {
            $_SESSION['logged'] = false;
            $_SESSION['msg'] = 'Code de vérification incorrect';

            // Redirection vers la page de réinitialisation
            header('Location: ./pwdForgot.php');
            exit();
        }
    } else {
        $_SESSION['logged'] = false;
        $_SESSION['msg'] = 'Erreur, veuillez réessayer';
    }
    // Redirection vers la page de connexion
    header('Location: ./');
    exit();
}

// Redirection vers la page de connexion
header('Location: ./');