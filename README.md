
***********************************************************************
# Create database

CREATE DATABASE IF NOT EXISTS db_booking;
USE db_booking;

CREATE TABLE IF NOT EXISTS admin_cred (
    sr_no INT AUTO_INCREMENT PRIMARY KEY,
    admin_name VARCHAR(50) NOT NULL,
    admin_pass VARCHAR(255) NOT NULL
);

INSERT INTO admin_cred (admin_name, admin_pass) VALUES
('admin', '123456'),

CREATE TABLE IF NOT EXISTS settings (
    sr_co INT AUTO_INCREMENT PRIMARY KEY,
    site_title VARCHAR(50) NOT NULL,
    site_about VARCHAR(255) NOT NULL,
    shutdown BOOLEAN NOT NULL DEFAULT FALSE
);

***********************************************************************