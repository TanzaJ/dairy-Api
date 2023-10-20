<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class UnitTypeModel extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll(int $milk_id, int $pmp_id, array $filters) {
        $filter_values = [];
        $sql = "SELECT * FROM milk JOIN projectedMilkProduction ON milk.milk_id=projectedMilkProduction.milk_id 
        JOIN unit_type ON projectedMilkProduction.unit_id=unit_type.unit_id WHERE milk_id = :milk_id AND pmp_id = :pmp_id AND 1 ";
        if(isset($filters['unit_name']))
        {
            $sql .= " AND unit_name LIKE CONCAT('%', :unit_name, '%')";
            $filter_values[':unit_name'] = $filters['unit_name']; 
        }
        if(isset($filters['unit_scale']))
        {
            $sql .= " AND unit_scale LIKE CONCAT('%', :unit_scale, '%')";
            $filter_values[':unit_scale'] = $filters['unit_scale']; 
        }

        return $this->paginate($sql, $filter_values);
    }

}
