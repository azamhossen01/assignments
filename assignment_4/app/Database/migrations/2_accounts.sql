CREATE TABLE accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    transfer_from INT NULL,
    transfer_to INT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    type ENUM('initial', 'deposit', 'withdraw', 'transfer') NOT NULL,
    in_out ENUM('in', 'out') NOT NULL,
    balance DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (transfer_from) REFERENCES users(id),
    FOREIGN KEY (transfer_to) REFERENCES users(id)
);