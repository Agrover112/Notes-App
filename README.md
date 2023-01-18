# Notes-App
A simple basic notes app built using PHP and MySQL.

![image](https://user-images.githubusercontent.com/42321810/211871600-e32db5a5-1756-4118-9cd8-4e87b56f8611.png)


## Features
- Add a new note.
- Delete existing notes.
- Edit existing note.
- No non-duplicate notes.
- Basic login/registration (simple )


## Prerequisites
- Python3.9.5 : mysql-connector,unittest,requests
- MySQL Database
- PHP

## Installation
  
```bash
  git clone https://github.com/Agrover112/Notes-App
```

Start the MySQL server:
```bash
  sudo systemctl start mysql
  sudo mysql -u root -p password <create_db.sql
```
Add your own MySql database credentials in `config/setenv.php`

Run a php server
```bash
  php -S localhost:8000
```
Navigate to `localhost:8000` in your browser.
