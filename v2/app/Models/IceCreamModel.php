<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

/**
 * A model class that handles requests concerning ice cream
 */
class IceCreamModel extends BaseModel
{
    private string $table_name = 'ice_cream';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fetches a list of ice creams while filtering requests
     * 
     * @param  array $filters the filters added to the request
     */
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

    /**
     * Fetches a list of ice creams by their id
     * 
     * @param  array $ice_cream_id the id of the requested ice cream
     */
    public function getIceCreamById(int $ice_cream_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE ice_cream_id = :ice_cream_id";
        return $this->fetchSingle($sql, [':ice_cream_id' => $ice_cream_id]);
    }

    /**
     * Creates ice cream entries
     * 
     * @param  array $new_entries the entries to be added to the DB
     */
    public function addIceCream(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    /**
     * Updates ice cream entries
     * 
     * @param  array $new_ice_cream_modify the entry to be updated
     * @param  array $id the id of the entry to be modified
     */
    public function updateIceCream(array $new_ice_cream_modify)
    {
        $where = ['ice_cream_id' => $new_ice_cream_modify['ice_cream_id']];
        unset($new_ice_cream_modify['ice_cream_id']);
        return $this->update($this->table_name, $new_ice_cream_modify, $where);
    }

    /**
     * Deletes ice cream entries
     * 
     * @param  array $id the id of the entry to be deleted
     */
    public function deleteIceCream(int $id)
    {
        return $this->deleteIceCreamById($this->table_name, $id);
    }


}
