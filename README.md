# MOD002701
Development of Web Applications, Anglia Ruskin 2017

## Instalation

First, you may want to start the XAMMP servers:

- Launch the XAMPP control panel.

- Configure Apache web server to run on the port 81.

- Start both the Apache web server and the MySQL database servers.

Once you're confident, that you have everything installed and configured you will want to copy the contents of this folder into your web document root directory:
```
 cd MOD002701
 cp -r . /var/www/html (or C:/xampp/apache/httpdocs in Windows)
```
Your database needs to match what the files expect. In the USB you'll find a database file that you can load into MySQL, and put your database into the same state as mine. If you don't already have a database to load the file into, you'll want create the database and set up the necessary permissions.
```
 CREATE DATABASE aw_foundation; CREATE USER 'aw_cms'@'localhost' IDENTIFIED BY 'secretpassword'; GRANT ALL PRIVILEGES ON * . * TO 'aw_cms'@'localhost';
```
You can load that file directly into a MySQL database, either by using a tool such as PHPMyAdmin, or by going to a command line application and typing in mysql -u followed by a user name that has access to the database:
```
mysql -u aw_cms -p aw_foundation < file.sql
```
We use aw_cms in our examples followed by the database name (see includes/db_connection.php). The command will prompt you to enter the password that the username requires to access the database and then it will update the database with the instructions in that SQL file.

Once you have the same files and the same database, you'll be able to:
- Open a web browser and point it to
```
http://localhost:81/MOD002701/index.php
```
- Or run the tests:
```
cd C:/xampp/apache/httpdocs/DWApp/test/unit_tests # ./autorun.sh
```
