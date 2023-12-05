<?php

namespace Vanier\Api\Models;

use Vanier\Api\Models\BaseModel;

/**
 * A model class that handles requests concerning countries
 */
class CountryModel extends BaseModel
{
    private string $table_name = 'country';
    public function __construct() {
        parent::__construct();
    }

    /**
     * Fetches a list of countries while filtering requests
     * 
     * @param  array $filters the filters added to the request
     */
    public function getAll(array $filters) {
        $filter_values = [];
        $sql = "SELECT c.country_name, c.region, c.population, c.area_sq_mile, c.population_density_sq_mile, c.gdp_perCapita FROM country as c WHERE 1 ";
        if(isset($filters['country_name']))
        {
            $sql .= " AND country_name LIKE CONCAT('%', :country_name, '%')";
            $filter_values[':country_name'] = $filters['country_name']; 
        }
        if(isset($filters['region']))
        {
            $sql .= " AND region LIKE CONCAT('%', :region, '%')";
            $filter_values[':region'] = $filters['region']; 
        }
        if(isset($filters['population']))
        {
            $sql .= " AND population LIKE CONCAT('%', :population, '%')";
            $filter_values[':population'] = $filters['population']; 
        }
        if(isset($filters['area_sq_mile']))
        {
            $sql .= " AND area_sq_mile LIKE CONCAT('%', :area_sq_mile, '%')";
            $filter_values[':area_sq_mile'] = $filters['area_sq_mile']; 
        }
        if(isset($filters['population_density_sq_mile']))
        {
            $sql .= " AND population_density_sq_mile LIKE CONCAT('%', :population_density_sq_mile, '%')";
            $filter_values[':population_density_sq_mile'] = $filters['population_density_sq_mile']; 
        }
        if(isset($filters['gdp_PerCapita']))
        {
            $sql .= " AND gdp_PerCapita LIKE CONCAT('%', :gdp_PerCapita, '%')";
            $filter_values[':gdp_PerCapita'] = $filters['gdp_PerCapita']; 
        }
        
        return $this->paginate($sql, $filter_values);
    }

    /**
     * Fetches a list of countries by their id
     * 
     * @param  array $country_id the id of the requested country
     */
    public function getCountryById(int $country_id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE country_id = :country_id";
        return $this->fetchSingle($sql, [':country_id' => $country_id]);
    }

    /**
     * Creates country entries
     * 
     * @param  array $new_entries the entries to be added to the DB
     */
    public function addCountry(array $new_entries)
    {
        return $this->insert($this->table_name, $new_entries);
    }

    /**
     * Updates country entries
     * 
     * @param  array $new_country_modify the entry to be updated
     * @param  array $id the id of the entry to be modified
     */
    public function updateCountry(array $new_country_modify, array $id)
    {
        return $this->update($this->table_name, $new_country_modify, $id);
    }

    /**
     * Deletes country entries
     * 
     * @param  array $id the id of the entry to be deleted
     */
    public function deleteCountry(array $id)
    {
        return $this->delete($this->table_name, $id);
    }
}
