<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class MilkModel extends BaseModel
{
    private string $table_name = 'milk';

    public function __construct() {
        parent::__construct();
    }


    public function getAll(array $filters) {
        $filter_values = [];
        $sql = "SELECT * FROM $this->table_name WHERE 1 ";
        if(isset($filters['milk_id']))
        {
            $sql .= " AND milk_id LIKE CONCAT('%', :milk_id, '%')";
            $filter_values[':milk_id'] = $filters['milk_id']; 
        }
        if(isset($filters['name']))
        {
            $sql .= " AND name LIKE CONCAT('%', :name, '%')";
            $filter_values[':name'] = $filters['name']; 
        }
        if(isset($filters['average_cost']))
        {
            $sql .= " AND average_cost LIKE CONCAT('%', :average_cost, '%')";
            $filter_values[':average_cost'] = $filters['average_cost']; 
        }
        if(isset($filters['place_of_origin']))
        {
            $sql .= " AND place_of_origin LIKE CONCAT('%', :place_of_origin, '%')";
            $filter_values[':place_of_origin'] = $filters['place_of_origin']; 
        }
        if(isset($filters['year_created']))
        {
            $sql .= " AND year_created LIKE CONCAT('%', :year_created, '%')";
            $filter_values[':year_created'] = $filters['year_created']; 
        }
        if(isset($filters['country_id']))
        {
            $sql .= " AND country_id LIKE CONCAT('%', :country_id, '%')";
            $filter_values[':country_id'] = $filters['country_id']; 
        }
        if(isset($filters['brand_id']))
        {
            $sql .= " AND brand_id LIKE CONCAT('%', :brand_id, '%')";
            $filter_values[':brand_id'] = $filters['brand_id']; 
        }
        if(isset($filters['nutrition_value_id']))
        {
            $sql .= " AND nutrition_value_id LIKE CONCAT('%', :nutrition_value_id, '%')";
            $filter_values[':nutrition_value_id'] = $filters['nutrition_value_id']; 
        }

        return $this->paginate($sql, $filter_values);
    }

    public function addMilk(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    public function updateModel(array $new_milk_modify, int $id)
    {
        return $this->update($this->table_name, $new_milk_modify, (array) $id);
    }

    public function deleteMilk(int $id)
    {
        return $this->delete($this->table_name, (array) $id);
    }
}
