<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class CheeseModel extends BaseModel
{
    private string $table_name = 'cheese';
    public function __construct() {
        parent::__construct();
    }

    public function getAll( array $filters) {
        $filter_values = [];
       
       $sql = "SELECT cheese.*
        FROM $this->table_name AS cheese
        JOIN country ON cheese.country_id = country.country_id
        JOIN brand ON cheese.brand_id = brand.brand_id
        WHERE 1";

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

        return $this->paginate($sql, $filter_values);
    }

}
