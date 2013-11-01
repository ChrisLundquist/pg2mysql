# PG2MySQL Converter

## Command-Line usage (recommended)

1. `PGPASSWORD=yourpass pg_dump -h localhost --column-inserts --quote-all-identifiers \`
    `--clean --no-acl --no-owner --format p --data-only dbname -f pgfile.sql`
    
    Additional documentation for `pg_dump` [here](http://www.postgresql.org/docs/9.3/static/app-pgdump.html)
    
1. `php pg2mysql_cli.php pgfile.sql mysqlfile.sql [engine]`
    * `pgfile.sql` will not be modified
    * `mysqlfile.sql` will be overwritten if already exists
    * engine is optional, default if not specified is InnoDB
    
1. `mysql dbname < mysqlfile.sql`
  
## Web usage

To use, simply unzip into your website somewhere, and point your browser at `pg2mysql.php`

If you want to use your own interface, simply include the pg2mysql.inc.php into your own code and call the `pg2mysql` function.  It accepts one input (the postgres code to be converted) and returns the mysql code.

eg:
 
```php
$mysql=pg2mysql($postgres);
```

## Original Author
Credit goes to:  
Author: James Grant
Lightbox Technolgoies  
http://www.lightbox.org  