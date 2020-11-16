<?php

/*
  VillesDAOProcedural.php
 */
/*
  LE DAO de la table [villes] de la BD [cours]
 */

/**
 *
 * @param PDO $pdo
 * @return array
 */
function selectAll(PDO $pdo): array {
    /*
     * Renvoie un tableau ordinal de tableaux associatifs
     */
    $list = array();
    try {
        $cursor = $pdo->query("SELECT * FROM villes");
// Renvoie un tableau ordinal de tableaux associatifs
        $list = $cursor->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $message = array("message" => $e->getMessage());
        $list[] = $message;
    }
    return $list;
}

/**
 *
 * @param PDO $pdo
 * @param string $id
 * @return array
 */
function selectOne(PDO $pdo, string $id): array {
    /*
     * Renvoie un tableau associatif
     */
    try {
        $sql = "SELECT * FROM villes WHERE cp = ?";
        $cursor = $pdo->prepare($sql);
        $cursor->bindValue(1, $id);
        $cursor->execute();
// Renvoie un tableau associatif
        $line = $cursor->fetch(PDO::FETCH_ASSOC);
        if ($line === FALSE) {
            $line["message"] = "enregistement inexistant !";
        }
        $cursor->closeCursor();
    } catch (PDOException $e) {
//$line["Error"] = $e->getMessage();
        $line["Error"] = "Une erreur s'est produite, veuillez téléphoner à
votre administrateur de BD !!!";
//$line = null;
    }
    return $line;
}

/**
 *
 * @param PDO $pdo
 * @param array $tAttributesValues
 * @return int
 */
function insert(PDO $pdo, array $tAttributesValues): int {
    $affected = 0;
    try {
        $sql = "INSERT INTO villes(cp,nom_ville,id_pays) VALUES(?,?,?)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $tAttributesValues["cp"]);
        $statement->bindValue(2, $tAttributesValues["nom_ville"]);
        $statement->bindValue(3, $tAttributesValues["id_pays"]);
        $statement->execute();
        $affected = $statement->rowcount();
    } catch (PDOException $e) {
        $affected = -1;
    }
    return $affected;
}

/*
 * $param PDO $pdo
 * $param array $tAttributesValues
 * $return int
 */

function update(PDO $pdo, array $tAttributesValues): int {
    $affected = 0;
    try {
        $sql = "UPDATE villes SET nom_ville = ?, id_pays = ? WHERE cp = ?";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $tAttributesValues["nom_ville"]);
        $statement->bindValue(2, $tAttributesValues["id_pays"]);
        $statement->bindValue(3, $tAttributesValues["cp"]);
        $statement->execute();
        /*
         *         $sql = "UPDATE pays SET nom_pays = ? WHERE id_pays = ?";
          $statement = $pdo->prepare($sql);
          $statement->bindValue(1, $tAttributesValues[nom_pays]);
          $statement->bindValue(2, $tAttributesValues[id_pays]);
          $statement->execute();
          $affected = $statement->rowcount();
         */
        $affected = $statement->rowCount();
    } catch (PDOException $e) {
        $affected = -1;
    }
    return $affected;
}

/**
 *
 * @param PDO $pdo
 * @param string $id
 * @return int
 */
function delete(PDO $pdo, string $id): int {
    $affected = 0;
    try {
        $sql = "DELETE FROM villes WHERE cp = ?";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
        $affected = $statement->rowcount();
    } catch (PDOException $e) {
        $affected = -1;
    }
    return $affected;
}

?>