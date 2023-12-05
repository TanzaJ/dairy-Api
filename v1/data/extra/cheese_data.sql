-- Insert dummy data entries
/*
INSERT INTO cheese (milk_id, product_name, dp_id, country_id, brand_id, nutritional_value_id)
VALUES
    (1, 'Cheddar', 1, 1, 1, 1),
    (2, 'Gouda', 2, 2, 2, 2),
    (3, 'Brie', 3, 3, 3, 3),
    (1, 'Manchego', 4, 4, 4, 4),
    (2, 'Parmesan', 5, 5, 5, 5),
    (3, 'Camembert', 6, 6, 6, 6),
    (1, 'Provolone', 7, 7, 7, 7),
    (2, 'Mozzarella', 8, 8, 8, 8),
    (3, 'Blue Cheese', 9, 9, 9, 9),
    (1, 'Feta', 10, 10, 10, 10);
    */

INSERT INTO `cheese`(`cheese_id`, `milk_id`, `product_name`, `country_id`, `brand_id`, `nutritional_value_id`) 
VALUES 
('1', 'Kerrygold Cheese', '372', '1', '8'),
('2', 'Lactantia Cheese', '124', '2', '9'),
('3', 'Dairyland Cheese', '124', '3', '10'),
('4', 'Natrel Cheese', '124', '4', '11'),
('5', 'Babybel Cheese', '250', '5', '12'),
('6', 'Black Diamond Cheese', '124', '6', '13'),
('7', 'Kraft Cheese', '840', '7', '14'),
('8', 'Cracker Barrel Cheese', '840', '8', '15'),
('9', 'Saputo Cheese', '124', '9', '16'),
('10', 'Lactalis Cheese', '250', '10', '17'),
('11', 'Beatrice Foods Cheese', '124', '11', '18'),
('12', 'Chapman Cheese', '840', '12', '19'),
('13', 'La Diperie Cheese', '124', '13', '20'),
('14', 'Bilboquet Cheese', '124', '14', '21'),
('15', 'Laura Secord Cheese', '124', '15', '22');
