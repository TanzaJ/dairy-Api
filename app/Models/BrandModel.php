<?php

namespace Vanier\Api\Models;

use Vanier\Api\Models\BaseModel;

class BrandModel extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll(array $filters) {
        $filter_values = [];
        $sql = "SELECT * FROM brand WHERE 1 ";
        if(isset($filters['brand_id']))
        {
            $sql .= " AND brand_id LIKE CONCAT('%', :brand_id, '%')";
            $filter_values[':brand_id'] = $filters['brand_id']; 
        }
        if(isset($filters['brand_name']))
        {
            $sql .= " AND brand_name LIKE CONCAT('%', :brand_name, '%')";
            $filter_values[':brand_name'] = $filters['brand_name']; 
        }
        if(isset($filters['country_id']))
        {
            $sql .= " AND country_id LIKE CONCAT('%', :country_id, '%')";
            $filter_values[':country_id'] = $filters['country_id']; 
        }
        
        return $this->paginate($sql, $filter_values);
    }

}
