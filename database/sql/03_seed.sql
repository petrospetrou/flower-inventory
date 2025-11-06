-- 03_seed.sql
-- Inserts sample data for Categories and Flowers

USE FlowerShop;
GO

-- Insert categories
INSERT INTO dbo.categories (name)
VALUES 
    (N'Roses'),
    (N'Tulips');
GO

-- Insert flowers
INSERT INTO dbo.flowers (category_id, name, type, price, description)
SELECT id, N'Red Rose', N'Hybrid Tea', 3.50, N'Classic red rose'
FROM dbo.categories WHERE name = N'Roses';

INSERT INTO dbo.flowers (category_id, name, type, price, description)
SELECT id, N'White Rose', N'Floribunda', 3.20, N'Elegant white rose'
FROM dbo.categories WHERE name = N'Roses';

INSERT INTO dbo.flowers (category_id, name, type, price, description)
SELECT id, N'Yellow Tulip', N'Single Early', 2.10, N'Bright yellow tulip'
FROM dbo.categories WHERE name = N'Tulips';

INSERT INTO dbo.flowers (category_id, name, type, price, description)
SELECT id, N'Purple Tulip', N'Triumph', 2.40, N'Rich purple tulip'
FROM dbo.categories WHERE name = N'Tulips';
GO

PRINT 'Seed data inserted successfully.';
