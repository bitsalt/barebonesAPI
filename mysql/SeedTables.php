<?php
namespace mysql;

class SeedTables {
    private static $statement = "INSERT INTO person (id, firstname, lastname, firstparent_id, secondparent_id)
                VALUES
                (1, 'Krasimir', 'Hristozov', null, null),
                (2, 'Maria', 'Hristozova', null, null),
                (3, 'Masha', 'Hristozova', 1, 2),
                (4, 'Jane', 'Smith', null, null),
                (5, 'John', 'Smith', null, null),
                (6, 'Richard', 'Smith', 4, 5),
                (7, 'Donna', 'Smith', 4, 5),
                (8, 'Josh', 'Harrelson', null, null),
                (9, 'Anna', 'Harrelson', 7, 8);";

    public static function seedTables($dbConnection)
    {
        try {
            $seedTable = $dbConnection->exec(self::$statement);
            return true;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
