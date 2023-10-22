<?php

namespace Vanier\Api\Models;

use Vanier\Api\Models\BaseModel;

class MilkModel extends BaseModel
{
    private string $table_name = 'milk';

    public function __construct()
    {
        parent::__construct();
    }


    public function getAll(array $filters)
    {
        $filter_values = [];
        $sql = "
        SELECT milk.*
        FROM $this->table_name AS milk
        JOIN country ON milk.country_id = country.country_id
        JOIN brand ON milk.brand_id = brand.brand_id
        WHERE 1
        ";

        if (isset($filters['name'])) {
            $sql .= " AND milk.name LIKE :name";
            $filter_values[':name'] = '%' . $filters['name'] . '%';
        }

        if (isset($filters['average_cost'])) {
            $sql .= " AND milk.average_cost LIKE :average_cost";
            $filter_values[':average_cost'] = '%' . $filters['average_cost'] . '%';
        }

        if (isset($filters['place_of_origin'])) {
            $sql .= " AND milk.place_of_origin LIKE :place_of_origin";
            $filter_values[':place_of_origin'] = '%' . $filters['place_of_origin'] . '%';
        }

        if (isset($filters['year_created'])) {
            $sql .= " AND milk.year_created LIKE :year_created";
            $filter_values[':year_created'] = '%' . $filters['year_created'] . '%';
        }

        if (isset($filters['country_id'])) {
            $sql .= " AND country.country_id LIKE :country_id";
            $filter_values[':country_id'] = '%' . $filters['country_id'] . '%';
        }

        if (isset($filters['brand_id'])) {
            $sql .= " AND brand.brand_id LIKE :brand_id";
            $filter_values[':brand_id'] = '%' . $filters['brand_id'] . '%';
        }

        return $this->paginate($sql, $filter_values);
    }


    public function addMilk(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    public function updateModel(array $new_milk_modify, int $id)
    {
        return $this->update($this->table_name, $new_milk_modify, (array) $id);
    }

    public function deleteMilk(int $id)
    {
        return $this->delete($this->table_name, (array) $id);
    }
}