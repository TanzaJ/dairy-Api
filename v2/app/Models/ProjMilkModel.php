<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

/**
 * A model class that handles requests concerning projected milk production
 */
class ProjMilkModel extends BaseModel
{
    private string $table_name = 'projected_milk_production';
    public function __construct() {
        parent::__construct();
    }

    /**
     * Fetches a list of projected milk production entries while filtering requests
     * 
     * @param  array $filters the filters added to the request
     */
    public function getAll( array $filters) {
        $filter_values = [];
        $sql = "SELECT * FROM projected_milk_production JOIN milk ON milk.milk_id=projected_milk_production.milk_id WHERE 1 ";
        if(isset($filters['year']))
        {
            $sql .= " AND year LIKE CONCAT('%', :year, '%')";
            $filter_values[':year'] = $filters['year']; 
        }
        if(isset($filters['type']))
        {
            $sql .= " AND type LIKE CONCAT('%', :type, '%')";
            $filter_values[':type'] = $filters['type']; 
        }
        if(isset($filters['production']))
        {
            $sql .= " AND production LIKE CONCAT('%', :production, '%')";
            $filter_values[':production'] = $filters['production']; 
        }
        if(isset($filters['consumption']))
        {
            $sql .= " AND consumption LIKE CONCAT('%', :consumption, '%')";
            $filter_values[':consumption'] = $filters['consumption']; 
        }
        if(isset($filters['price']))
        {
            $sql .= " AND price LIKE CONCAT('%', :price, '%')";
            $filter_values[':price'] = $filters['price']; 
        }

        return $this->paginate($sql, $filter_values);
    }

    /**
     * Fetches a list of projected milk production entries by their id
     * 
     * @param  array $pmp_id the id of the requested resource
     */
    public function getProjMilkById(int $pmp_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE pmp_id = :pmp_id";
        return $this->fetchSingle($sql, [':pmp_id' => $pmp_id]);
    }

    /**
     * Creates projected milk production entries
     * 
     * @param  array $new_entries the entries to be added to the DB
     */
    public function addProjMilk(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    /**
     * Updates projected milk production entries
     * 
     * @param  array $new_projMilk_value_modify the entry to be updated
     * @param  array $id the id of the entry to be modified
     */
    public function updateProjMilk(array $new_projMilk_value_modify, array $id)
    {
        return $this->update($this->table_name, $new_projMilk_value_modify, $id);
    }

    /**
     * Deletes projected milk production entries
     * 
     * @param  array $id the id of the entry to be deleted
     */
    public function deleteProjMilk(array $id)
    {
        return $this->delete($this->table_name, $id);
    }
}
