<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class IceCreamModel extends BaseModel
{
    private string $table_name = 'ice_cream';
    public function __construct() {
        parent::__construct();
    }

    public function getAll( array $filters) {
        $filter_values = [];
        $sql = "SELECT * FROM milk JOIN ice_cream ON milk.milk_id=ice_cream.milk_id 
        JOIN country ON country.country_id=ice_cream.country_id 
        JOIN brand ON brand.brand_id=ice_cream.brand_id 
        JOIN  nutritional_value ON nutritional_value.nutritional_value_id=ice_cream.nutritional_value_id WHERE 1 ";
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

    public function addIceCream(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    public function updateModel(array $new_ice_cream_modify, int $id)
    {
        return $this->update($this->table_name, $new_ice_cream_modify, (array) $id);
    }

    public function deleteIceCream(int $id)
    {
        return $this->delete($this->table_name, (array) $id);
    }


}
