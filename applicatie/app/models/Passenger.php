<?php

require_once '../core/Model.php';

class Passenger extends Model
{
    protected $table = 'Passagier';

    public function authenticate($name, $password)
    {
        try {
            $query = "SELECT passagiernummer FROM {$this->table} WHERE naam = :name AND wachtwoord = :password AND passagiernummer IS NOT NULL";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':password', $password);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result ? $result['passagiernummer'] : false;
        } catch (PDOException $e) {
            throw new Exception('An error occurred while checking credentials');
        }
    }
}
