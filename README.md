## PHP & AJAX Chat App 
---
##Prerequsites
- PHP installed on your local machine
- MySQL installed on your local machine
- A web server like Apache or Nginx (XAMPP or WAMP recommended for Windows users)

---

#### Steps to Run the Application

1. **Clone the Repository**
   ```sh
   git clone <git remote add origin https://github.com/AmazingJoMax/PHP-AJAX-Chat.git>
   cd <repository-directory>

2. **Setting Up The Database**
- Start your MySQL server
- Open your MySQL client (e.g. phpMyAdmin, MySQL Workbench, or command line)
- Import the ```db.sql``` file 

3. **Establishing Database Connection**
Check for the `db_config.php` file in the `requires` folder and modify it to match your database configuration

```php
<?php
define("DB_NAME", 'php_chat');
    define("DB_HOST", 'localhost');
    define("DB_USER", 'root');
    define("DB_PASS", '');
```
4. **Start the Web Server**

If using XAMPP or WAMP, place the project directory in the htdocs or www folder respectively
Start Apache and MySQL from the XAMPP/WAMP control panel
Access the Application

5. **Open your web browser and navigate to:**

```http://localhost/<repository-directory>```