# Notes-App
A simple basic notes app built using PHP and MySQL.

## Features
- Add a note
- Delete a note
- Edit a note


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
