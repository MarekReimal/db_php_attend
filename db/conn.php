<?php
# php võimaldab erinevaid db ühendusi, teeme PDO - on vahe kiht ja turvalisem (mysqli ei kasuta, suhtleb otse db-ga)

# DB ühendus
$host = 'localhost'; # meil db ja rakendus samas serveris siis võib ka "Localhost", siis kasutaja peab olema localhost
$db = 'attend';
$user = 'kirjutaja_atd'; # peaks olema kasutaja loaga ainult ligipääsuga sellesse DB, ilma õigusteta GRANT, ALL PRIVILEGES, hostname %
$pass = 'parool1'; # ei pane github
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; # kasutatud "" õige, peab olema ;
try{
    $pdo = new PDO($dsn, $user, $pass); # user ja pass on eraldi muutujas, siis saab laiendada, võibolla mitu kasutajat või mitud PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    throw new PDOException($e->getMessage());
}

require_once 'db/crud.php';
    require_once 'db/user.php';
    $crud = new crud($pdo); # tee obj
    $user = new user($pdo);
   
    $user->insertUser("admin","password"); # tee kasutaja esmaseks logimiseks

?>

