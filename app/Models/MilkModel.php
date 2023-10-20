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
        $sql = "SELECT * FROM $this->table_name 
        JOIN country ON country.country_id=milk.country_id 
        JOIN brand ON brand.brand_id=milk.brand_id 
        JOIN nutritional_value ON nutritional_value.nutritional_value_id=milk.nutritional_value_id WHERE 1 ";
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
        if(isset($filters['country_name']))
       {
           $sql .= " AND country_name LIKE CONCAT('%', :country_name, '%')";
           $filter_values[':country_name'] = $filters['country_name']; 
       }
       if(isset($filters['brand_name']))
       {
           $sql .= " AND brand_name LIKE CONCAT('%', :brand_name, '%')";
           $filter_values[':brand_name'] = $filters['brand_name']; 
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
