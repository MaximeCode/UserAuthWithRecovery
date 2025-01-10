<?php
/**
 * @param int $longueur
 * Base : 12
 * @param string $choix
 * Base : Tous
 * @return string
 * Retourne un mot de passe aléatoire complexe comprenant des chiffres, des lettres minuscules et majuscules et des caractères spéciaux
 */
function gen_mdp(int $longueur = 12, string $choix = "tous"): string
{
    $choix = explode(",", $choix);
    $ChaineAutiliser = "";
    $CaracteresSpeciaux = "~#{[|`$^@]*)\"^'}@^!:/.?,+-(";//mettez tous vos caractères spéciaux, faite attention que ces caractères sont susceptibles d'aller dans une base de données, suivant votre utilisation
    foreach ($choix as $lechoix) {
        switch ($lechoix) {
            case "speciaux":
                $ChaineAutiliser .= $CaracteresSpeciaux;
                break;
            case "chiffres":
                $ChaineAutiliser .= "0123456789";
                break;
            case "lettresmin":
                $ChaineAutiliser .= "abcdefghijklmnopqrstuvwxyz";
                break;
            case "lettresmaj":
                $ChaineAutiliser .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                break;
            case "tous":
                $ChaineAutiliser = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" . $CaracteresSpeciaux;
                break;
            default:
                $ChaineAutiliser .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";//si le choix n'est pas bon, on met une chaine par défaut
        }
    }
    $ChaineDeRetour = "";
    for ($i = 1; $i <= $longueur; $i++) {//notre chaine de retour contiendra le nombre de caractères demandés
        $ChaineDeRetour .= substr($ChaineAutiliser, rand(0, strlen($ChaineAutiliser) - 1), 1);//rand(1,le nombre de caractère total utilisable) + 1 nous permet de prendre un seul caractère aléatoirement, dans les types de chaines demandées, pour l'ajouter au fur et à mesure grâce à .= qui dit "ajouter à la suite"
    }
    return $ChaineDeRetour;
}

/**
 * @param PDO $dbh
 * @param string $login
 * @return mixed
 */
function findUser(PDO $dbh, string $login): mixed
{
    $select = "SELECT * FROM login WHERE login = :login";
    $stmt = $dbh->prepare($select);
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    return $stmt->fetch();
}

/**
 * @param PDO $dbh
 * @param int $login_id
 * @return mixed
 */
function findCommune(PDO $dbh, int $login_id): mixed
{
    $select = "SELECT nom, login FROM communes JOIN login ON login.id = communes.login_id WHERE login_id = :login_id ORDER BY login.id;";
    $stmt = $dbh->prepare($select);
    $stmt->bindParam(':login_id', $login_id);
    $stmt->execute();
    return $stmt->fetch();
}