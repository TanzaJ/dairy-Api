<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

class IceCreamModel extends BaseModel
{
    private string $table_name = 'ice_cream';
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(array $filters)
    {
        $query_values = [];
        $sql = "SELECT ice_cream.*, country.country_name, brand.brand_name
            FROM $this->table_name AS ice_cream
            JOIN country ON ice_cream.country_id = country.country_id
            JOIN brand ON ice_cream.brand_id = brand.brand_id
            WHERE 1";

        if (isset($filters['product_name'])) {
            $sql .= " AND ice_cream.product_name = :product_name";
            $query_values[':product_name'] = $filters['product_name'];
        }

        if (isset($filters['country_name'])) {
            $sql .= " AND country.country_name LIKE CONCAT('%', :country_name, '%')";
            $query_values[':country_name'] = $filters['country_name'];
        }

        if (isset($filters['brand_name'])) {
            $sql .= " AND brand.brand_name LIKE CONCAT('%', :brand_name, '%')";
            $query_values[':brand_name'] = $filters['brand_name'];
        }

        return $this->paginate($sql, $query_values);
    }

    public function addIceCream(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    public function updateIceCream(array $new_ice_cream_modify)
    {
        $where = ['ice_cream_id' => $new_ice_cream_modify['ice_cream_id']];
        unset($new_ice_cream_modify['ice_cream_id']);
        return $this->update($this->table_name, $new_ice_cream_modify, $where);
    }

    public function deleteIceCream(int $id)
    {
        return $this->deleteIceCreamById($this->table_name, $id);
    }


}
