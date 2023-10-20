<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class CheeseModel extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll( array $filters) {
        $filter_values = [];
        $sql = "SELECT * FROM milk JOIN cheese ON milk.milk_id=cheese.milk_id 
        JOIN country ON country.country_id=cheese.country_id 
        JOIN brand ON brand.brand_id=cheese.brand_id 
        JOIN  nutritional_value ON nutritional_value.nutritional_value_id=cheese.nutritional_value_id WHERE 1 ";
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

}
