<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class CheeseModel extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll(int $milk_id, array $filters) {
        $filter_values = [];
        $sql = "SELECT * FROM milk JOIN cheese ON milk.milk_id=cheese.milk_id WHERE milk_id = :milk_id AND 1 ";
        if(isset($filters['cheese_id']))
        {
            $sql .= " AND cheese_id LIKE CONCAT('%', :cheese_id, '%')";
            $filter_values[':cheese_id'] = $filters['cheese_id']; 
        }
        if(isset($filters['product_name']))
        {
            $sql .= " AND product_name LIKE CONCAT('%', :product_name, '%')";
            $filter_values[':product_name'] = $filters['product_name']; 
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

}
