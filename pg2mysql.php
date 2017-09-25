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
?>
<html>
<head><title>pg2mysql converter (PostgreSQL to MySQL Converter)</title></head>
<body>
<h1>pg2mysql converter (PostgreSQL to MySQL Converter)</h1>

The <b>pg2mysql</b> converter is an online tool to convert/migrate existing PostgreSQL databases into MySQL.  Simply dumping from Postgres and importing to MySQL does not work because of differences in syntax and data types.  To use this converter, just create a postgres SQL dump (<tt>pg_dump -U username -s dbname &gt; dbname.sql</tt>), and copy and paste it into the text area below.  Click the <b>Convert to MySQL</b> button and the page will re-load with your new MySQL code that you can copy out of the textarea into a text editor to save and import into your MySQL database.
<br><br>
<form method=post action="pg2mysql.php">

<?php
 if ($_POST['postgresdata']) {
     $output=pg2mysql(stripslashes($_POST['postgresdata']));
     echo "<h3>Here is your MySQL dump file</h3>";
     echo "<textarea rows=20 cols=80 name=mysqldata>$output</textarea>";
 } else {
     ?>
 	<h3>Paste PostgreSQL dump file here</h3>
	<textarea rows=20 cols=80 name=postgresdata></textarea>
	<br />
	<input type=submit value="Convert to MySQL">
 <?php
 }
 ?>


</form>

<br>
<b>Notes:</b> <br />
 - No its not perfect <br />
 - Yes it discards ALL stored procedures <br />
 - Yes it discards ALL views <br />
 - Yes you can email us suggestsions: info[AT]lightbox.org<br />
  &nbsp; &nbsp; - In emails, please include the Postgres code, and the expected MySQL code<br />


</body>
</html>
