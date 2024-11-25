DROP DATABASE IF EXISTS quickshop;
CREATE DATABASE quickshop;
USE quickshop;

-- Users table
CREATE TABLE Users (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- Hashed passwords recommended
    role ENUM('Administrator', 'Sales Personnel', 'Inventory Manager', 'Customer') NOT NULL,
    ProfileImage VARCHAR(255) DEFAULT 'default_profile.png'
);

-- Products table
CREATE TABLE Products (
    ProductID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(150) NOT NULL,
    Description TEXT,
    Price DECIMAL(10, 2) NOT NULL,
    StockQuantity INT NOT NULL,
    ProductImage VARCHAR(255) DEFAULT 'default_product.png'
);

-- Orders table
CREATE TABLE Orders (
    OrderID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATETIME DEFAULT CURRENT_TIMESTAMP,
    UserID INT NOT NULL,
    TotalAmount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (UserID) REFERENCES Users(userID) ON DELETE CASCADE
);

-- OrderDetails table
CREATE TABLE OrderDetails (
    OrderDetailID INT AUTO_INCREMENT PRIMARY KEY,
    OrderID INT NOT NULL,
    ProductID INT NOT NULL,
    Quantity INT NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    Status ENUM('Processed', 'Unprocessed') DEFAULT 'Unprocessed',
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID) ON DELETE CASCADE,
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID) ON DELETE CASCADE
);

-- Indexes for performance optimization
CREATE INDEX idx_user_id ON Orders(UserID);
CREATE INDEX idx_order_id ON OrderDetails(OrderID);
CREATE INDEX idx_product_id ON OrderDetails(ProductID);



