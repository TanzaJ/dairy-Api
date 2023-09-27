<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class ProjMilkModel extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll(int $milk_id, array $filters) {
        $filter_values = [];
        $sql = "SELECT * FROM milk JOIN projectedMilkProduction ON milk.milk_id=projectedMilkProduction.milk_id WHERE milk_id = :milk_id AND 1 ";
        if(isset($filters['pmp_id']))
        {
            $sql .= " AND pmp_id LIKE CONCAT('%', :pmp_id, '%')";
            $filter_values[':pmp_id'] = $filters['pmp_id']; 
        }
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
        if(isset($filters['unit_id']))
        {
            $sql .= " AND unit_id LIKE CONCAT('%', :unit_id, '%')";
            $filter_values[':unit_id'] = $filters['unit_id']; 
        }

        return $this->paginate($sql, $filter_values);
    }

}
