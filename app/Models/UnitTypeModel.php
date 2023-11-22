<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class UnitTypeModel extends BaseModel
{
    private string $table_name = 'unit_type';
    public function __construct() {
        parent::__construct();
    }

    public function getAll( array $filters) {
        $filter_values = []; 
        $sql = "SELECT * FROM unit_type JOIN projected_milk_production ON projected_milk_production.unit_id=unit_type.unit_id
        JOIN milk ON milk.milk_id=projected_milk_production.milk_id WHERE 1 ";
        if(isset($filters['unit_name']))
        {
            $sql .= " AND unit_name LIKE CONCAT('%', :unit_name, '%')";
            $filter_values[':unit_name'] = $filters['unit_name']; 
        }
        if(isset($filters['unit_scale']))
        {
            $sql .= " AND unit_scale LIKE CONCAT('%', :unit_scale, '%')";
            $filter_values[':unit_scale'] = $filters['unit_scale']; 
        }

        return $this->paginate($sql, $filter_values);
    }

    public function getUnitTypeById(int $unit_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE unit_id = :unit_id";
        return $this->fetchSingle($sql, [':unit_id' => $unit_id]);
    }

    public function addUnitType(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    public function updateUnitType(array $new_unitType_value_modify, array $id)
    {
        return $this->update($this->table_name, $new_unitType_value_modify, $id);
    }

    public function deleteUnitType(array $id)
    {
        return $this->delete($this->table_name, $id);
    }
}
