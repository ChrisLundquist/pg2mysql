<?php
/*
This file is part of the 'Pg2MySQL' converter project
http://www.lightbox.org/pg2mysql.php

Copyright (C) 2005-2011 James Grant <james@lightbox.org>
            Lightbox Technologies Inc.

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public
License as published by the Free Software Foundation, version 2.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; see the file COPYING.  If not, write to
the Free Software Foundation, Inc., 59 Temple Place - Suite 330,
Boston, MA 02111-1307, USA.
*/


include "pg2mysql.inc.php";

if (! ($argv[1] && $argv[2])) {
    echo "Usage: php pg2mysql_cli.php <inputfilename> <outputfilename> [engine]\n";
    exit;
} else {
    if (isset($argv[3])) {
        $config['engine']=$argv[3];
    }
    pg2mysql_large($argv[1], $argv[2]);


    echo <<<XHTML
Notes:
 - No its not perfect
 - Yes it discards ALL stored procedures
 - Yes it discards ALL queries except for CREATE TABLE and INSERT INTO
 - Yes you can email us suggestsions: info[AT]lightbox.org
    - In emails, please include the Postgres code, and the expected MySQL code
 - If you're having problems creating your postgres dump, make sure you use "--format p --inserts"
 - Default output engine if not specified is InnoDB

XHTML;
}
