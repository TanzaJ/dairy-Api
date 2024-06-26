<?php

namespace Vanier\Api\Models;

use Vanier\Api\Models\BaseModel;

/**
 * A model class that handles requests concerning nutritional value
 */
class NutritionalValueModel extends BaseModel
{
    private string $table_name = 'nutritional_value';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Fetches a list of nutritional value entries while filtering requests
     * 
     * @param  array $filters the filters added to the request
     */
    public function getAll(array $filters) {
        $filter_values = [];
        $sql = "SELECT n.kcal, n.fiber, n.cholesterol, 
        n.carbohydrate, n.protein, n.monosat_fat, n.polysat_fat, n.sat_fat FROM nutritional_value AS n WHERE 1 ";
        if(isset($filters['kcal']))
        {
            $sql .= " AND kcal LIKE CONCAT('%', :kcal, '%')";
            $filter_values[':kcal'] = $filters['kcal']; 
        }
        if(isset($filters['fiber']))
        {
            $sql .= " AND fiber LIKE CONCAT('%', :fiber, '%')";
            $filter_values[':fiber'] = $filters['fiber']; 
        }
        if(isset($filters['cholesterol']))
        {
            $sql .= " AND cholesterol LIKE CONCAT('%', :cholesterol, '%')";
            $filter_values[':cholesterol'] = $filters['cholesterol']; 
        }
        if(isset($filters['carbohydrate']))
        {
            $sql .= " AND carbohydrate LIKE CONCAT('%', :carbohydrate, '%')";
            $filter_values[':carbohydrate'] = $filters['carbohydrate']; 
        }
        if(isset($filters['protein']))
        {
            $sql .= " AND protein LIKE CONCAT('%', :protein, '%')";
            $filter_values[':protein'] = $filters['protein']; 
        }
        if(isset($filters['monosat_fat']))
        {
            $sql .= " AND monosat_fat LIKE CONCAT('%', :monosat_fat, '%')";
            $filter_values[':monosat_fat'] = $filters['monosat_fat']; 
        }
        if(isset($filters['polysat_fat']))
        {
            $sql .= " AND polysat_fat LIKE CONCAT('%', :polysat_fat, '%')";
            $filter_values[':polysat_fat'] = $filters['polysat_fat']; 
        }
        if(isset($filters['sat_fat']))
        {
            $sql .= " AND sat_fat LIKE CONCAT('%', :sat_fat, '%')";
            $filter_values[':sat_fat'] = $filters['sat_fat']; 
        }
        
        return $this->paginate($sql, $filter_values);
    }

    /**
     * Fetches a list of nutritional value entries by their id
     * 
     * @param  array $nutritional_value_id the id of the requested resource
     */
    public function getNVById(int $nutritional_value_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE nutritional_value_id = :nutritional_value_id";
        return $this->fetchSingle($sql, [':nutritional_value_id' => $nutritional_value_id]);
    }

    /**
     * Creates nutritional value entries
     * 
     * @param  array $new_entries the entries to be added to the DB
     */
    public function addNV(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    /**
     * Updates nutritional value entries
     * 
     * @param  array $new_nutritional_value_modify the entry to be updated
     * @param  array $id the id of the entry to be modified
     */
    public function updateNV(array $new_nutritional_value_modify, array $id)
    {
        return $this->update($this->table_name, $new_nutritional_value_modify, $id);
    }

    /**
     * Deletes nutritional value entries
     * 
     * @param  array $id the id of the entry to be deleted
     */
    public function deleteNV(array $id)
    {
        return $this->delete($this->table_name, $id);
    }
}
