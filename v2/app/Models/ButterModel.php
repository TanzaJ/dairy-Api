<?php

namespace Vanier\Api\Models;

use Vanier\Api\Models\BaseModel;

/**
 * A model class that handles requests concerning butter
 */
class ButterModel extends BaseModel
{
    private string $table_name = 'butter';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fetches a list of butters while filtering requests
     * 
     * @param  array $filters the filters added to the request
     */
    public function getAll(array $filters)
    {
        $query_values = [];
        $sql = "SELECT butter.*, country.country_name, brand.brand_name
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

    /**
     * Fetches a list of butters by their id
     * 
     * @param  array $butter_id the id of the requested butter
     */
    public function getButterById(int $butter_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE butter_id = :butter_id";
        return $this->fetchSingle($sql, [':butter_id' => $butter_id]);
    }

    /**
     * Creates butter entries
     * 
     * @param  array $new_entries the entries to be added to the DB
     */
    public function addButter(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    /**
     * Updates butter entries
     * 
     * @param  array $new_butter_modify the entry to be updated
     * @param  array $id the id of the entry to be modified
     */
    public function updateModel(array $new_butter_modify, int $id)
    {
        return $this->update($this->table_name, $new_butter_modify, ['butter_id'=> $id]);
    }

    /**
     * Deletes butter entries
     * 
     * @param  array $id the id of the entry to be deleted
     */
    public function deleteButter(int $id)
    {
        return $this->delete($this->table_name, ['butter_id'=> $id]);
    }
}
