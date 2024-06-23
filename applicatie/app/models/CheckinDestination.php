<?php

require_once '../core/Model.php';

class CheckinDestination extends Model
{
    protected $table = 'IncheckenBestemming';

    public function getByAirportCode($airportCode)
    {
        $sql = "SELECT * FROM {$this->table} WHERE luchthavencode = :luchthavencode";
        $params = ['luchthavencode' => $airportCode];

        return $this->fetchAll($sql, $params);
    }
}
