<?php

class Database{

    private static $dns;
    private static $user;
    private static $password;
    private static $database;

    /*public function __construct()
    {
        self::$dns = "mysql:host=db;dbname=sf-react;port=3306"; // À changer selon vos configurations
        self::$user = "root"; // À changer selon vos configurations
        self::$password = ""; // À changer selon vos configurations
        try {
            self::$database = new PDO(self::$dns, self::$user, self::$password);
            self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Erreur de connexion à la base de données: " . $e->getMessage();
            die();
        }
    }*/

    public static function getInstance() {
        if (!self::$database) {
            self::$dns = "mysql:host=db;dbname=sf-react;port=3306"; // À changer selon vos configurations
            self::$user = "root"; // À changer selon vos configurations
            self::$password = ""; // À changer selon vos configurations
            try {
                self::$database = new PDO(self::$dns, self::$user, self::$password);
                self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Erreur de connexion à la base de données: " . $e->getMessage();
                die();
            }
        }
        return self::$database;
    }

    public function GetUserById($user_id) {
        $database = self::getInstance();
        $query = "SELECT * FROM user  WHERE id = ?";
        $statement = $database->prepare($query);
        $statement->bindParam(1, $user_id, PDO::PARAM_INT);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
} 

$db = new Database();

$user = $db->GetUserById(1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    bonjour à tous 
    <?php var_dump($user);?>
</body>
</html>

