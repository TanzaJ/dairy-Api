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

        return $this->paginate($sql, $filter_values);
    }
}
