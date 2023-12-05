<?php

namespace Vanier\Api\Models;

use Vanier\Api\Models\BaseModel;

/**
 * A model class that handles requests concerning brands
 */
class BrandModel extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }

    private string $table_name = 'brand';

     /**
     * Fetches a list of brands while filtering requests
     * 
     * @param  array $filters the filters added to the request
     */
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

    /**
     * Fetches a list of brands by their id
     * 
     * @param  array $brand_id the id of the requested brand
     */
    public function getBrandById(int $brand_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE brand_id = :brand_id";
        return $this->fetchSingle($sql, [':brand_id' => $brand_id]);
    }

    /**
     * Creates brand entries
     * 
     * @param  array $new_entries the entries to be added to the DB
     */
    public function addBrand(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    /**
     * Updates brand entries
     * 
     * @param  array $new_brand_modify the entry to be updated
     * @param  array $id the id of the entry to be modified
     */
    public function updateBrand(array $new_brand_modify, array $id)
    {
        return $this->update($this->table_name, $new_brand_modify, $id);
    }

    /**
     * Deletes brand entries
     * 
     * @param  array $id the id of the entry to be deleted
     */
    public function deleteBrand(array $id)
    {
        return $this->delete($this->table_name, $id);
    }
}
