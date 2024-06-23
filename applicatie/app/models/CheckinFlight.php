<?php

require_once '../core/Model.php';

class CheckinFlight extends Model
{
    protected $table = 'IncheckenVlucht';

    public function getByFlightNumber($flightNumber)
    {
        $sql = "SELECT * FROM {$this->table} WHERE vluchtnummer = :vluchtnummer";
        $params = ['vluchtnummer' => $flightNumber];

        return $this->fetchAll($sql, $params);
    }
}
