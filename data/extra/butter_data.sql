-- Insert dummy data entries
INSERT INTO butter (milk_id, product_name, dp_id, country_id, brand_id, nutritional_value_id)
VALUES
    (1, 'Salted Butter', 21, 1, 1, 21),
    (2, 'Unsalted Butter', 22, 2, 2, 22),
    (3, 'Whipped Butter', 23, 3, 3, 23),
    (1, 'Cultured Butter', 24, 4, 4, 24),
    (2, 'Clarified Butter', 25, 5, 5, 25),
    (3, 'Irish Butter', 26, 6, 6, 26),
    (1, 'European Butter', 27, 7, 7, 27),
    (2, 'Honey Butter', 28, 8, 8, 28),
    (3, 'Truffle Butter', 29, 9, 9, 29),
    (1, 'Goat Butter', 30, 10, 10, 30);

INSERT INTO `butter`(`butter_id`, `milk_id`, `product_name`, `country_id`, `brand_id`, `nutritional_value_id`) 
VALUES 
('1', '1', 'Kerrygold Butter', '372', '1', '1234'),
('2', '2', 'Lactantia Butter', '124', '2', '5678'),
('3', '3', 'Dairyland Butter', '124', '3', '9012'),
('4', '4', 'Natrel Butter', '124', '4', '3456'),
('5', '5', 'Babybel Butter', '250', '5', '7890'),
('6', '6', 'Black Diamond Butter', '124', '6', '2345'),
('7', '7', 'Kraft Butter', '840', '7', '6789'),
('8', '8', 'Cracker Barrel Butter', '840', '8', '1234'),
('9', '9', 'Saputo Butter', '124', '9', '5678'),
('10', '10', 'Lactalis Butter', '250', '10', '9012'),
('11', '11', 'Beatrice Foods Butter', '124', '11', '3456'),
('12', '12', 'Chapman Butter', '840', '12', '7890'),
('13', '13', 'La Diperie Butter', '124', '13', '2345'),
('14', '14', 'Bilboquet Butter', '124', '14', '6789'),
('15', '15', 'Laura Secord Butter', '124', '15', '1234');



/*

INSERT INTO `butter_types` (`brand_id`, `butter_type`)
VALUES
  (1, 'Kerrygold Pure Irish Butter'),
  (2, 'Lactantia Unsalted Butter'),
  (3, 'Dairyland Salted Butter'),
  (4, 'Natrel Unsalted Butter'),
  (5, 'Babybel Mini Rolls with Butter'),
  (6, 'Black Diamond Cheese Spread with Butter'),
  (7, 'Kraft Butter'),
  (8, 'Cracker Barrel Spreadable Cheese with Butter'),
  (9, 'Saputo Butter'),
  (10, 'Lactalis Président Butter'),
  (11, 'Beatrice Foods Unsalted Butter'),
  (12, 'Chapman's Ice Cream Sandwich with Butter Pecan'),
  (13, 'La Diperie Ice Cream with Butter Toffee'),
  (14, 'Bilboquet Homemade Butter Caramel Ice Cream'),
  (15, 'Laura Secord Butter Pecan Ice Cream');

*/