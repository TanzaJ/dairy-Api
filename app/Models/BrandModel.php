<?php

namespace Vanier\Api\Models;

use Vanier\Api\Models\BaseModel;

class BrandModel extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }

    private string $table_name = 'brand';

    function getAll(array $filters)
    {
        $sql = "
        SELECT brand.*, country.country_name 
        FROM $this->table_name AS brand
        JOIN country ON brand.country_id = country.country_id
        WHERE 1
    ";
        $query_values = [];

        if (isset($filters['brand_name'])) {
            $sql .= " AND brand.brand_name = :brand_name";
            $query_values[':brand_name'] = $filters['brand_name'];
        }

        if (isset($filters['country_name'])) {
            $sql .= " AND country.country_name = :country_name";
            $query_values[':country_name'] = $filters['country_name'];
        }

        return $this->paginate($sql, $query_values);
    }
}
