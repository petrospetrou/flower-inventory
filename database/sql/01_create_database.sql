-- 01_create_database.sql
-- Creates the FlowerShop database

IF NOT EXISTS (SELECT * FROM sys.databases WHERE name = N'FlowerShop')
BEGIN
    CREATE DATABASE FlowerShop;
    PRINT 'Database FlowerShop created successfully.';
END
ELSE
BEGIN
    PRINT 'Database FlowerShop already exists.';
END
GO
