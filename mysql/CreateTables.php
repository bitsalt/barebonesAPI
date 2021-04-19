<?php
namespace mysql;

class CreateTables {
    private static $statement = "CREATE TABLE IF NOT EXISTS person (
            id INT NOT NULL AUTO_INCREMENT,
            firstname VARCHAR(100) NOT NULL,
            lastname VARCHAR(100) NOT NULL,
            firstparent_id INT DEFAULT NULL,
            secondparent_id INT DEFAULT NULL,
            PRIMARY KEY (id),
            FOREIGN KEY (firstparent_id)
                REFERENCES person(id)
                ON DELETE SET NULL,
            FOREIGN KEY (secondparent_id)
                REFERENCES person(id)
                ON DELETE SET NULL
        ) ENGINE=INNODB;";

    public static function createTables($dbConnection)
    {
        try {
            $createTable = $dbConnection->exec(self::$statement);
            return true;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

}
