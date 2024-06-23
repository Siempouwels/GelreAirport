<?php

require_once '../core/Model.php';

class Gate extends Model
{
    protected $table = 'Gate';

    public function getByCode($gateCode)
    {
        $sql = "SELECT * FROM {$this->table} WHERE gatecode = :gatecode";
        $params = ['gatecode' => $gateCode];

        return $this->fetch($sql, $params);
    }

    public function getOptionList()
    {
        $sql = "SELECT gatecode FROM {$this->table}";
        $result = $this->fetchAll($sql);

        $options = [];
        foreach ($result as $row) {
            $options[$row['gatecode']] = $row['gatecode'];
        }
        return $options;
    }
}
