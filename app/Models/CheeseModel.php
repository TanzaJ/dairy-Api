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
       
       $sql = "SELECT cheese.*,  country.country_name, brand.brand_name
        FROM $this->table_name AS cheese
        JOIN country ON cheese.country_id = country.country_id
        JOIN brand ON cheese.brand_id = brand.brand_id
        WHERE 1";

        if(isset($filters['product_name']))
        {
           $sql .= " AND product_name LIKE CONCAT('%', :product_name, '%')";
           $filter_values[':product_name'] = $filters['product_name']; 
        }
        if (isset($filters['country_name'])) {
            $sql .= " AND country.country_name LIKE CONCAT('%', :country_name, '%')";
            $query_values[':country_name'] = $filters['country_name'];
        }

        if (isset($filters['brand_name'])) {
            $sql .= " AND brand.brand_name LIKE CONCAT('%', :brand_name, '%')";
            $query_values[':brand_name'] = $filters['brand_name'];
        }

        return $this->paginate($sql, $filter_values);
    }

    public function addCheese(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    public function updateModel(array $new_cheese_modify, int $id)
    {
        return $this->update($this->table_name, $new_cheese_modify, ['cheese_id'=> $id]);
    }

    public function deleteCheese(int $id)
    {
        return $this->delete($this->table_name, ['cheese_id'=> $id]);
    }

}
