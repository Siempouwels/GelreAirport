<?php

require_once '../core/Model.php';

class Airport extends Model
{
    protected $table = 'Luchthaven';

    public function getByCode($code)
    {
        $sql = "SELECT * FROM {$this->table} WHERE luchthavencode = :luchthavencode";
        $params = ['luchthavencode' => $code];

        return $this->fetch($sql, $params);
    }

    public function getOptionList()
    {
        $sql = "SELECT luchthavencode, naam FROM {$this->table}";
        $result = $this->fetchAll($sql);

        $options = [];
        foreach ($result as $row) {
            $options[$row['luchthavencode']] = $row['naam'];
        }
        return $options;
    }
}