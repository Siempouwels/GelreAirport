<?php

require_once '../core/Model.php';

class Airline extends Model
{
    protected $table = 'Maatschappij';

    public function getByCode($code)
    {
        $sql = "SELECT * FROM {$this->table} WHERE maatschappijcode = :maatschappijcode";
        $params = ['maatschappijcode' => $code];

        return $this->fetch($sql, $params);
    }

    public function getOptionList()
    {
        $sql = "SELECT maatschappijcode, naam FROM {$this->table}";
        $result = $this->fetchAll($sql);

        $options = [];
        foreach ($result as $row) {
            $options[$row['maatschappijcode']] = $row['naam'];
        }
        return $options;
    }
}
