<?php

require_once '../core/Model.php';

class CheckinAirline extends Model
{
    protected $table = 'IncheckenMaatschappij';

    public function getByAirlineCode($airlineCode)
    {
        $sql = "SELECT * FROM {$this->table} WHERE maatschappijcode = :maatschappijcode";
        $params = ['maatschappijcode' => $airlineCode];

        return $this->fetchAll($sql, $params);
    }
}
