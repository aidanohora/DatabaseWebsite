# DatabaseWebsite
A website which displays information from an SQL database, designed for the use of employees in a retail company. Built using MYSQLi with XAMPP for windows.

Instructions:
1. Install XAMPP: https://www.apachefriends.org/index.html
2. Enter localhost/phpmyadmin/ in a browser and import websitedatabase.sql.
3. Move all other files (either loose or in a folder) to htdocs in the XAMPP installation folder.
4. Enter localhost/index.php in a browser if the files are loose, or localhost/the name of your folder/index.php if they are in a folder. You can now navigate the website.

Notes:

-To avoid causing the payments.php page to refresh upon clicking one of the customernumbers to show
more info, I used iframe to embed another page (customerinfo.php) into payments.php. So, when a customer number is clicked, a form will be submit with the iframe as it's target. The code in customerinfo is executed on the form being submitted and the iframe will then display the information.

-I have included custom error handling both for query errors (if a select query is made for something that doesn't exist in a table) or if a connection to the MYSQL server isn't made. To test, change the name of one of the values in a query for the first, or try using the site without MYSQL running for the other.

-The customer and employee expandable tables can display a query error while the rest of the page remains unaffected. These query errors specifically indicate which table the query error occured for, e.g. customer info, customer payments.
