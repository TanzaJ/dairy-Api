<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class ButterModel extends BaseModel
{
    private string $table_name = 'butter';
    public function __construct() {
        parent::__construct();
    }

    public function getAll( array $filters) {
        $filter_values = [];
        $sql = "SELECT * FROM milk JOIN butter ON milk.milk_id=butter.milk_id 
        JOIN country ON country.country_id=butter.country_id 
        JOIN brand ON brand.brand_id=butter.brand_id 
        JOIN  nutritional_value ON nutritional_value.nutritional_value_id=butter.nutritional_value_id WHERE 1 ";
        if(isset($filters['product_name']))
        {
            $sql .= " AND product_name LIKE CONCAT('%', :product_name, '%')";
            $filter_values[':product_name'] = $filters['product_name']; 
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

    public function addButter(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    public function updateModel(array $new_butter_modify, int $id)
    {
        return $this->update($this->table_name, $new_butter_modify, (array) $id);
    }

    public function deleteButter(int $id)
    {
        return $this->delete($this->table_name, (array) $id);
    }

}
