-- Create a new MySQL database
CREATE DATABASE IF NOT EXISTS BankDB;

-- Use the newly created database
USE BankDB;

-- Create a table for bank transactions
CREATE TABLE IF NOT EXISTS Transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_type VARCHAR(10) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    balance DECIMAL(10, 2) NOT NULL,
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert an initial record for the initial balance
INSERT INTO Transactions (transaction_type, amount, balance)
VALUES ('Initial Balance', 0.00, 0.00);
