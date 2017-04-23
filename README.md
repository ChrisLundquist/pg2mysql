AUTHOR
======

Pg2MySQL Converter

Lightbox Technolgoies

http://www.lightbox.org

James Grant <james@lightbox.org>


INSTALLATION/USAGE
==================

To use, simply unzip into your website somewhere, and point your browser at:

	pg2mysql.php

If you want to use your own interface, simply include the pg2mysql.inc.php into 
your own code and call the 'pg2mysql' function.  It accepts one input (the 
postgres code to be converted) and returns the mysql code. eg:

    $mysql = pg2mysql($postgres);


COMMAND LINE VERSION
====================

Command line syntax and options can be viewed using:

    php pg2mysql_cli.php --help


DOMAIN SUPPORT
--------------

PostgreSQL domains contained in a differenct schema than the one being processed 
can be loaded using the `--domains` command-line option.  The domain definitions 
should be exported using `pg_dump`'s `--schema-only` option to create a file with 
just definitions.  If the domain definitions are in the same schema as the data 
being exported this option is not necessary.


DONATIONS APPRECIATED
=====================

Paypal: paypal@lightbox.org

Bitcoin: 1Gt6D2HcwnoLCeDMkP6xKMC4P65g42TiVn

Cheque/money order:

    Lightbox Technologies Inc
    240 Catherine St. Suite 312
    Ottawa, ON
    K2P 2G8  CANADA


CHANGES
=======

VERSION 1.0 (I guess)

-   This is the first public release.  Up until now it has been web-access only.
-   Allow "character varying" without a size.  defaults to varchar(255)

VERSION 1.1

-   fix detection of field names that dont have `` around them when looking up a 
    primary key

VERSION 1.2 (Thanks to John Puster)

-   fix character varying 255 -> varchar(255) instead of text  (<= vs <)
-   add conversions for 'time with(out) time zone' to 'time' field
-   correct 'timestamp with(out) time zone' to convert to 'timestamp' instead of 
    'datetime' and allow default CURRENT_TIMESTAMP

VERSION 1.3

-   add command line version that can process large files
-   add conversions for many new data types
-   add checks for multi-line INSERTs that contain quoted strings across multiple 
    rows that contain "end of sql" look-alike line endings
-   filter CONSTRAINT lines properly

VERSION 1.4

-   add config for specifying the engine to output as (default MyISAM), with cli 
    version engine can be specified as the third argument
-   fix " conversion on INSERT lines - only replace " with ` on fieldnames (before 
    "VALUES"), not in the actual data itself

VERSION 1.5

-   add detection for "E"scaped string literals, like INSERT INTO table VALUES 
    (E'string\\n', E'another string\\r\\n');

VERSION 1.6

-   also catch "E"scaped string literals when they are preceeded by a non string 
    (12345, E'a string\\r\\n')

VERSION 1.7

-   Add conversion for ALTER TABLE to add PRIMARY KEYs
-   Add conversion for CREATE INDEX to add INDEXes (via ALTER TABLE)

VERSION 1.8 (Thanks to Vladimir Pilny <vladimir@pilny.com>)

-   Explicitly set error reporting
-   Add SQL_MODE=NO_AUTO_VALUE_ON_ZERO and SET time_zone in start of SQL output
-   Add conversion for DROP DATABASE
-   Add conversion for CREATE DATABASE
-   Add conversion for \connect/USE
-   Add conversion for COPY table FROM stdin

VERSION 1.9

-   Introduce commented header at the top of converted file
-   Fix SQL_MODE and time_zone so it doesn't repeat when using CLI version
-   Move config['engine'] to common file instead of only CLI version

