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
        if(isset($filters['brand_name']))
        {
            $sql .= " AND brand_name LIKE CONCAT('%', :brand_name, '%')";
            $filter_values[':brand_name'] = $filters['brand_name']; 
        }
        if(isset($filters['country_name']))
        {
            $sql .= " AND country_name LIKE CONCAT('%', :country_name, '%')";
            $filter_values[':country_name'] = $filters['country_name']; 
        }
        
        return $this->paginate($sql, $filter_values);
    }

}
