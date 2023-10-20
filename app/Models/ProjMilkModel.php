<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class ProjMilkModel extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll( array $filters) {
        $filter_values = [];
        $sql = "SELECT * FROM milk JOIN projectedMilkProduction ON milk.milk_id=projectedMilkProduction.milk_id WHERE 1 ";
        if(isset($filters['year']))
        {
            $sql .= " AND year LIKE CONCAT('%', :year, '%')";
            $filter_values[':year'] = $filters['year']; 
        }
        if(isset($filters['type']))
        {
            $sql .= " AND type LIKE CONCAT('%', :type, '%')";
            $filter_values[':type'] = $filters['type']; 
        }
        if(isset($filters['production']))
        {
            $sql .= " AND production LIKE CONCAT('%', :production, '%')";
            $filter_values[':production'] = $filters['production']; 
        }
        if(isset($filters['consumption']))
        {
            $sql .= " AND consumption LIKE CONCAT('%', :consumption, '%')";
            $filter_values[':consumption'] = $filters['consumption']; 
        }
        if(isset($filters['price']))
        {
            $sql .= " AND price LIKE CONCAT('%', :price, '%')";
            $filter_values[':price'] = $filters['price']; 
        }

        return $this->paginate($sql, $filter_values);
    }

}
