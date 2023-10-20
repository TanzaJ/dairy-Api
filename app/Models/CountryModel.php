<?php

namespace Vanier\Api\Models;

use Vanier\Api\Models\BaseModel;

class CountryModel extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll(array $filters) {
        $filter_values = [];
        $sql = "SELECT * FROM country WHERE 1 ";
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
        if(isset($filters['gdpPerCapita']))
        {
            $sql .= " AND gdpPerCapita LIKE CONCAT('%', :gdpPerCapita, '%')";
            $filter_values[':gdpPerCapita'] = $filters['gdpPerCapita']; 
        }
        
        return $this->paginate($sql, $filter_values);
    }

}
