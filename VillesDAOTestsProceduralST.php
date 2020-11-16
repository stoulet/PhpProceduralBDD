<?php
/* VillesDAOProceduralTests.php */
require_once 'VillesDAOProceduralSimon.php';
try {
$connection = new PDO("mysql:host=localhost;dbname=cours", "root",
 "");
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connection->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
$connection->exec("SET NAMES 'UTF8'");
echo "<hr>SelectAll<br>";
$content = "";
$lines = selectAll($connection);
// echo "<hr>";
// echo "<pre>";
// var_dump($lines);
// echo "</pre>";
// echo "<hr>";
foreach ($lines as $line) {
foreach ($line as $field => $value) {
$content .= $field . ":" . $value . ";";
}
$content .= "\n";
}
echo nl2br($content);
echo "<hr>SelectOne<br>";
$content = "";
$line = selectOne($connection, "13000");
if ($line != null) {
foreach ($line as $field => $value) {
$content .= $value;
}
$content .= "\n";
echo nl2br($content);
} else {
echo "Une erreur s'est produite, veuillez téléphone à votre
administrateur de BD !!!";
}
echo "<hr>Insert<br>";
$connection->beginTransaction();
$tAttributesValues = array();
$tAttributesValues['cp'] = "33110";
$tAttributesValues['nom_ville'] = "Villenove";
$tAttributesValues['id_pays'] = "033";
$affected = insert($connection, $tAttributesValues);
echo "insertion : $affected";
$connection->commit();

echo"<hr>Update<br>";
$connection->beginTransaction();
$tAttributesValues = array();
$tAttributesValues['nom_ville'] = "Villenave";
$tAttributesValues['id_pays'] = "033";
$tAttributesValues['cp'] = "33110";
$affected = update($connection, $tAttributesValues);
echo "modification : $affected";
$connection->commit();

echo "<hr>Delete<br>"; $connection->beginTransaction();
$affected = delete($connection, "33110");
echo "suppression : $affected";
$connection->commit();
} catch (PDOException $e) {
echo "Message : " . $e->getMessage();
}
$connection = null;
?>