-- 02_create_tables.sql
-- Defines schema for Categories and Flowers

USE FlowerShop;
GO

-- Drop existing tables if they exist
IF OBJECT_ID('dbo.flowers', 'U') IS NOT NULL DROP TABLE dbo.flowers;
IF OBJECT_ID('dbo.categories', 'U') IS NOT NULL DROP TABLE dbo.categories;
GO

-- Categories table
CREATE TABLE dbo.categories (
    id INT IDENTITY(1,1) PRIMARY KEY,
    name NVARCHAR(255) NOT NULL UNIQUE,
    created_at DATETIME2 DEFAULT SYSDATETIME(),
    updated_at DATETIME2 DEFAULT SYSDATETIME()
);
GO

-- Flowers table
CREATE TABLE dbo.flowers (
    id INT IDENTITY(1,1) PRIMARY KEY,
    category_id INT NOT NULL,
    name NVARCHAR(255) NOT NULL,
    type NVARCHAR(255) NULL,
    price DECIMAL(10,2) NOT NULL,
    description NVARCHAR(MAX) NULL,
    image_path NVARCHAR(512) NULL,
    created_at DATETIME2 DEFAULT SYSDATETIME(),
    updated_at DATETIME2 DEFAULT SYSDATETIME(),
    CONSTRAINT FK_flowers_categories FOREIGN KEY (category_id)
        REFERENCES dbo.categories(id)
        ON DELETE CASCADE
);
GO

PRINT 'Tables created successfully.';
