<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class ProjMilkModel extends BaseModel
{
    private string $table_name = 'projected_milk_production';
    public function __construct() {
        parent::__construct();
    }

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

    public function getProjMilkById(int $pmp_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE pmp_id = :pmp_id";
        return $this->fetchSingle($sql, [':pmp_id' => $pmp_id]);
    }
    public function addProjMilk(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    public function updateProjMilk(array $new_projMilk_value_modify, array $id)
    {
        return $this->update($this->table_name, $new_projMilk_value_modify, $id);
    }

    public function deleteProjMilk(array $id)
    {
        return $this->delete($this->table_name, $id);
    }
}
