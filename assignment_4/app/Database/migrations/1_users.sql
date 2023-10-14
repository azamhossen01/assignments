CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    type ENUM('admin', 'customer') DEFAULT 'customer' NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Insert initial data into the users table
INSERT INTO users (name, email, password, type) VALUES
    ('Admin User', 'admin@gmail.com', '$2y$10$kxEilfRFBMA/OVgWJq/0g.dCO3cJgqR3q6WiS0ZjCn9e8tY9u6EU6', 'admin'); -- Password is 'password'
