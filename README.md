# Installation
* Install PHP/MySQL/etc
** Make sure you install `php-mysql` and `php-mcrypt`
* Create a database using `sprusage.sql`
** Create a MySQL user with full access to the database
** Create a MySQL user with ONLY read access to ONLY the table `sprusage.reports` (eg, `GRANT SELECT ON sprusage.reports TO 'rouser'@'localhost'`)
** Put the accounts in `db.php`
