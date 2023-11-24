<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

/**
 * A model class that handles requests concerning unit types
 */
class UnitTypeModel extends BaseModel
{
    private string $table_name = 'unit_type';
    public function __construct() {
        parent::__construct();
    }

    /**
     * Fetches a list of unit types while filtering requests
     * 
     * @param  array $filters the filters added to the request
     */
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

    /**
     * Fetches a list of unit types by their id
     * 
     * @param  array $unit_id the id of the requested unit type
     */
    public function getUnitTypeById(int $unit_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE unit_id = :unit_id";
        return $this->fetchSingle($sql, [':unit_id' => $unit_id]);
    }

    /**
     * Creates unit type entries
     * 
     * @param  array $new_entries the entries to be added to the DB
     */
    public function addUnitType(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    /**
     * Updates unit type entries
     * 
     * @param  array $new_unitType_value_modify the entry to be updated
     * @param  array $id the id of the entry to be modified
     */
    public function updateUnitType(array $new_unitType_value_modify, array $id)
    {
        return $this->update($this->table_name, $new_unitType_value_modify, $id);
    }

    /**
     * Deletes unit type entries
     * 
     * @param  array $id the id of the entry to be deleted
     */
    public function deleteUnitType(array $id)
    {
        return $this->delete($this->table_name, $id);
    }
}
