<?php


namespace src\TableGateway;


class Person
{
    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        try {
            $statement = $this->db->query("SELECT * FROM person");
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function find($id)
    {
        $select = "SELECT * FROM person WHERE id = ?";

        try {
            $statement = $this->db->prepare($select);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(Array $input)
    {
        $insert = "INSERT INTO person (firstname, lastname, firstparent_id, secondparent_id)
                    VALUES (:firstname, :lastname, :firstparent_id, :secondparent_id)";

        try {
            $statement = $this->db->prepare($insert);
            $statement->execute(array(
                'firstname' => $input['firstname'],
                'lastname'  => $input['lastname'],
                'firstparent_id' => $input['firstparent_id'] ?? null,
                'secondparent_id' => $input['secondparent_id'] ?? null,
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function update($id, Array $input)
    {
        $update = "UPDATE person
                    SET 
                        firstname = :firstname,
                        lastname  = :lastname,
                        firstparent_id = :firstparent_id,
                        secondparent_id = :secondparent_id
                    WHERE id = :id";

        try {
            $statement = $this->db->prepare($update);
            $statement->execute(array(
                'id' => (int) $id,
                'firstname' => $input['firstname'],
                'lastname'  => $input['lastname'],
                'firstparent_id' => $input['firstparent_id'] ?? null,
                'secondparent_id' => $input['secondparent_id'] ?? null,
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id)
    {
        $delete = "DELETE FROM person
                    WHERE id = :id";

        try {
            $statement = $this->db->prepare($delete);
            $statement->execute(array('id' => $id));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}