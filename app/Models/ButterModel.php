<?php

namespace Vanier\Api\Models;

use Vanier\Api\Models\BaseModel;

class ButterModel extends BaseModel
{
    private string $table_name = 'butter';
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(array $filters)
    {
        $query_values = [];
        $sql = "SELECT butter.*
            FROM $this->table_name AS butter
            JOIN country ON butter.country_id = country.country_id
            JOIN brand ON butter.brand_id = brand.brand_id
            WHERE 1";

        if (isset($filters['product_name'])) {
            $sql .= " AND butter.product_name = :product_name";
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


    public function addButter(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    public function updateModel(array $new_butter_modify, int $id)
    {
        return $this->update($this->table_name, $new_butter_modify, (array) $id);
    }

    public function deleteButter(int $id)
    {
        return $this->delete($this->table_name, (array) $id);
    }
}
