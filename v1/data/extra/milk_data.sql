/*-- Insert 10 dummy data entries 
INSERT INTO milk (name, average_cost, place_of_origin, year_created, country_id, brand_id, nutritional_value_id)
VALUES
    ('Cow Milk', 2.99, 'United States', 2000, 1, 1, 1),
    ('Goat Milk', 3.49, 'United States', 2005, 1, 2, 2),
    ('Sheep Milk', 3.29, 'United States', 1995, 1, 3, 3),
    ('Organic Cow Milk', 3.99, 'United States', 2010, 1, 4, 4),
    ('Cow Milk', 2.79, 'Canada', 1990, 2, 5, 5),
    ('Goat Milk', 2.99, 'Canada', 2002, 2, 6, 6),
    ('Sheep Milk', 4.19, 'France', 2015, 3, 7, 7),
    ('Ox Milk', 2.99, 'United States', 2012, 1, 8, 8),
    ('Buffalo Milk', 2.79, 'United States', 2007, 1, 9, 9),
    ('Camel Milk', 2.99, 'Thailand', 2014, 4, 10, 10);
*/
/*
INSERT INTO `milk` (`name`, `average_cost`, `place_of_origin`, `year_created`, `country_id`, `brand_id`, `nutritional_value_id`, `animal_id`)
VALUES
  ('Whole Milk', 2.49, 'United States', 1922, 840, 2, 1, 1),
  ('2% Reduced-Fat Milk', 2.29, 'United States', 1970, 840, 2, 2, 1),
  ('1% Low-Fat Milk', 2.19, 'United States', 1983, 840, 2, 3, 1),
  ('Skim Milk', 2.09, 'United States', 1979, 840, 2, 4, 1),
  ('Chocolate Milk', 2.99, 'United States', 1950, 840, 2, 5, 1),
  ('Soy Milk', 3.49, 'China', 1960, 156, 2, 6, 2),
  ('Almond Milk', 3.99, 'United States', 1950, 840, 3, 7, 3),
  ('Oat Milk', 4.49, 'Sweden', 1990, 752, 2, 8, 4),
  ('Goat Milk', 5.99, 'France', 1800, 250, 5, 9, 5),
  ('Camel Milk', 10.99, 'United Arab Emirates', 1980, 784, 2, 10, 6);
*/

INSERT INTO `milk` (`name`, `average_cost`, `place_of_origin`, `year_created`, `country_id`, `brand_id`, `nutritional_value_id`)
VALUES
  ('Whole Milk', 2.49, 'United States', 1922, 840, 2, 1),
  ('2% Reduced-Fat Milk', 2.29, 'United States', 1970, 840, 2, 2),
  ('1% Low-Fat Milk', 2.19, 'United States', 1983, 840, 2, 3),
  ('Skim Milk', 2.09, 'United States', 1979, 840, 2, 4),
  ('Chocolate Milk', 2.99, 'United States', 1950, 840, 2, 5),
  ('Soy Milk', 3.49, 'China', 1960, 156, 2, 6),
  ('Almond Milk', 3.99, 'United States', 1950, 840, 3, 7),
  ('Oat Milk', 4.49, 'Sweden', 1990, 752, 2, 8),
  ('Goat Milk', 5.99, 'France', 1800, 250, 5, 9),
  ('Camel Milk', 10.99, 'United Arab Emirates', 1980, 784, 2, 10);


INSERT INTO `milk`(`milk_id`, `name`, `average_cost`, `place_of_origin`, `year_created`, `country_id`, `brand_id`, `nutritional_value_id`) 
VALUES 
('1', 'Kerrygold Milk', '2.99', 'Ireland', '1990', '372', '1', '1234'),
('2', 'Lactantia Milk', '3.49', 'Canada', '1980', '124', '2', '5678'),
('3', 'Dairyland Milk', '3.19', 'Canada', '1975', '124', '3', '9012'),
('4', 'Natrel Milk', '3.29', 'Canada', '1985', '124', '4', '3456'),
('5', 'Babybel Milk', '2.79', 'France', '2000', '250', '5', '7890'),
('6', 'Black Diamond Milk', '3.09', 'Canada', '1995', '124', '6', '2345'),
('7', 'Kraft Milk', '2.89', 'USA', '1992', '840', '7', '6789'),
('8', 'Cracker Barrel Milk', '3.19', 'USA', '1987', '840', '8', '1234'),
('9', 'Saputo Milk', '3.09', 'Canada', '1982', '124', '9', '5678'),
('10', 'Lactalis Milk', '2.99', 'France', '1978', '250', '10', '9012'),
('11', 'Beatrice Foods Milk', '3.39', 'Canada', '1988', '124', '11', '3456'),
('12', 'Chapman Milk', '3.49', 'USA', '1991', '840', '12', '7890'),
('13', 'La Diperie Milk', '3.09', 'Canada', '2005', '124', '13', '2345'),
('14', 'Bilboquet Milk', '3.29', 'Canada', '1999', '124', '14', '6789'),
('15', 'Laura Secord Milk', '3.19', 'Canada', '1984', '124', '15', '1234');



