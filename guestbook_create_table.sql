CREATE DATABASE IF NOT EXISTS guestbook_db;
USE guestbook_db;

CREATE TABLE IF NOT EXISTS guestbook_entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
