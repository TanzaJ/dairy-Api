<?php

namespace Vanier\Api\Models;
use Vanier\Api\Models\BaseModel;

/**
 * A model class that handles requests concerning cheese
 */
class CheeseModel extends BaseModel
{
    private string $table_name = 'cheese';
    public function __construct() {
        parent::__construct();
    }

    /**
     * Fetches a list of cheeses while filtering requests
     * 
     * @param  array $filters the filters added to the request
     */
    public function getAll( array $filters) {
        $filter_values = [];
       
       $sql = "SELECT cheese.product_name, milk.name AS milk_name, country.country_name, brand.brand_name, 
       nutritional_value.kcal, nutritional_value.fiber, nutritional_value.cholesterol, 
       nutritional_value.carbohydrate, nutritional_value.protein, nutritional_value.monosat_fat, 
       nutritional_value.polysat_fat, nutritional_value.sat_fat
        FROM $this->table_name AS cheese
        JOIN country ON cheese.country_id = country.country_id
        JOIN brand ON cheese.brand_id = brand.brand_id
        JOIN milk ON cheese.milk_id = milk.milk_id
        JOIN nutritional_value ON cheese.nutritional_value_id = nutritional_value.nutritional_value_id
        WHERE 1";

        if(isset($filters['product_name']))
        {
           $sql .= " AND product_name LIKE CONCAT('%', :product_name, '%')";
           $filter_values[':product_name'] = $filters['product_name']; 
        }
        if (isset($filters['country_name'])) {
            $sql .= " AND country.country_name LIKE CONCAT('%', :country_name, '%')";
            $filter_values[':country_name'] = $filters['country_name'];
        }

        if (isset($filters['brand_name'])) {
            $sql .= " AND brand.brand_name LIKE CONCAT('%', :brand_name, '%')";
            $filter_values[':brand_name'] = $filters['brand_name'];
        }

        return $this->paginate($sql, $filter_values);
    }

    /**
     * Fetches a list of cheeses by their id
     * 
     * @param  array $cheese_id the id of the requested cheese
     */
    public function getCheeseById(int $cheese_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE cheese_id = :cheese_id";
        return $this->fetchSingle($sql, [':cheese_id' => $cheese_id]);
    }

    /**
     * Creates cheese entries
     * 
     * @param  array $new_entries the entries to be added to the DB
     */
    public function addCheese(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    /**
     * Updates cheese entries
     * 
     * @param  array $new_cheese_modify the entry to be updated
     * @param  array $id the id of the entry to be modified
     */
    public function updateModel(array $new_cheese_modify, int $id)
    {
        return $this->update($this->table_name, $new_cheese_modify, ['cheese_id'=> $id]);
    }

    /**
     * Deletes cheese entries
     * 
     * @param  array $id the id of the entry to be deleted
     */
    public function deleteCheese(int $id)
    {
        return $this->delete($this->table_name, ['cheese_id'=> $id]);
    }

}
