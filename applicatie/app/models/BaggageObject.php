<?php

require_once '../core/Model.php';

class BaggageObject extends Model
{
    protected $table = 'BagageObject';

    public function getByPassengerNumber($passengerNumber)
    {
        $sql = "SELECT * FROM {$this->table} WHERE passagiernummer = :passagiernummer";
        $params = ['passagiernummer' => $passengerNumber];

        return $this->fetchAll($sql, $params);
    }
}
?>