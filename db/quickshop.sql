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
    Status ENUM('Processed', 'Unprocessed') DEFAULT 'Unprocessed',
    FOREIGN KEY (UserID) REFERENCES Users(userID) ON DELETE CASCADE
);

-- OrderDetails table
CREATE TABLE OrderDetails (
    OrderDetailID INT AUTO_INCREMENT PRIMARY KEY,
    OrderID INT NOT NULL,
    ProductID INT NOT NULL,
    Quantity INT NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID) ON DELETE CASCADE,
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID) ON DELETE CASCADE
);

-- Indexes for performance optimization
CREATE INDEX idx_user_id ON Orders(UserID);
CREATE INDEX idx_order_id ON OrderDetails(OrderID);
CREATE INDEX idx_product_id ON OrderDetails(ProductID);


-- Insert products into the Products table
INSERT INTO Products (Name, Description, Price, StockQuantity, ProductImage) VALUES
('Apple iPhone 14', 'Latest model of the iPhone with 128GB storage and 6.1-inch display.', 799.99, 150, 'images/iphone14.jpg'),
('Samsung Galaxy S23', 'Flagship smartphone with a 6.1-inch Dynamic AMOLED display and 50MP camera.', 749.99, 180, 'images/samsung-galaxy-s23.jpg'),
('Dell XPS 13', '13-inch laptop featuring Intel Core i7, 16GB RAM, and 512GB SSD.', 1299.99, 50, 'images/dell-xps-13.jpg'),
('Sony WH-1000XM5', 'Noise-canceling over-ear headphones with 30-hour battery life.', 349.99, 200, 'images/sony-wh-1000xm5.jpg'),
('Apple MacBook Pro 16"', 'High-performance laptop with M1 Pro chip, 16GB RAM, and 512GB SSD.', 2399.99, 80, 'images/macbook-pro-16.jpg'),
('Nike Air Max 270', 'Comfortable and stylish athletic shoes with Air Max cushioning for all-day wear.', 149.99, 300, 'images/nike-air-max-270.jpg'),
('Samsung 55" QLED TV', '55-inch 4K UHD smart TV with Quantum Dot technology.', 799.99, 120, 'images/samsung-qled-tv.jpg'),
('Sony PlayStation 5', 'Next-gen gaming console with ultra-fast SSD and ray tracing.', 499.99, 100, 'images/playstation-5.jpg'),
('Canon EOS R5', 'Mirrorless camera with 45MP full-frame sensor and 8K video recording.', 3899.99, 60, 'images/canon-eos-r5.jpg'),
('Bose SoundLink Revolve+', 'Portable Bluetooth speaker with 360-degree sound and 16-hour battery life.', 299.99, 250, 'images/bose-soundlink-revolve-plus.jpg');
