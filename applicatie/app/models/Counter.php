<?php

require_once '../core/Model.php';

class Counter extends Model
{
    protected $table = 'Balie';

    public function authenticate($counternumber, $password)
    {
        try {
            $query = "SELECT COUNT(*) AS count FROM {$this->table} WHERE balienummer = :counternumber AND wachtwoord = :password";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':counternumber', $counternumber);
            $statement->bindParam(':password', $password);
            $statement->execute();

            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result['count'] == 1;
        } catch (PDOException $e) {
            throw new Exception('An error occurred while checking credentials');
        }
    }
}
