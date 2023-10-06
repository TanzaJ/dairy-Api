<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class IceCreamModel extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll(int $milk_id, array $filters) {
        $filter_values = [];
        $sql = "SELECT * FROM milk JOIN ice_cream ON milk.milk_id=ice_cream.milk_id WHERE milk_id = :milk_id AND 1 ";
        if(isset($filters['ice_cream_id']))
        {
            $sql .= " AND ice_cream_id LIKE CONCAT('%', :ice_cream_id, '%')";
            $filter_values[':ice_cream_id'] = $filters['ice_cream_id']; 
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
