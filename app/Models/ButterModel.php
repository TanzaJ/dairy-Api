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
        $sql = "SELECT 
        butter.product_name as butter, m.name AS milk_type, co.country_name, b.brand_name, 
        nv.kcal, nv.fiber, nv.cholesterol, nv.carbohydrate, nv.protein, nv.monosat_fat, nv.polysat_fat, nv.sat_fat        
        FROM milk as m JOIN butter ON m.milk_id=butter.milk_id 
        JOIN country as co ON co.country_id=butter.country_id 
        JOIN brand as b ON b.brand_id=butter.brand_id 
        JOIN  nutritional_value as nv ON nv.nutritional_value_id=butter.nutritional_value_id WHERE 1 ";
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
