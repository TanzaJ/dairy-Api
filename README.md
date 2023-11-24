# Dairy Api

This repository is home to the dairy api, an api made by James Kawashima, Brandon Lee Felix, Nicholas Adiohos and Mihai Costin Serban.

This api exposes resources concerning milk and other dairy products.

## Resources

/cheese: GET, POST, PUT, DELETE, filter by country_name, product_name, brand_name

/ice_cream: GET, POST, PUT, DELETE, filter by country_name, product_name, brand_name

/butter: GET, POST, PUT, DELETE, filter by country_name, product_name, brand_name

/milk: GET, POST, PUT, DELETE, filter by name, average_cost, place_of_origin, year_created, country_name, brand_name

/brand: GET, POST, PUT, DELETE, filter by brand_name, country_name

/country: GET, filter by country_name, region, population, area_sq_mile, population_density_sq_mile, gdpPerCapita

/projectedMilkProduction: GET, filter by year, type, production, consumption, price

/nutritional_value: GET, filter by kcal, fiber, cholesterol, carbohydrate, protein, monosat_fat, polysat_fat, sat_fat

/unit_type: GET, filter by unit_name, unit_scale

/recipes: GET a list of recipes from the spoonacular api

## Requirements

The header must include the application type in order to use the resource.
When fetching data, the user must include the page number and page size in the filters.
