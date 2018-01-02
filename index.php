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
<head>
	<meta charset="utf-8">
	<title>pg2mysql converter (PostgreSQL to MySQL Converter)</title>
	<style>
		body {font-family: sans-serif;}
		main {width: 80%; margin: 0 auto;}
		textarea {width: 100%; height: 500px; resize: vertical; padding: 10px; font-size: 1rem; font-family: monospace;}
		button {padding: 20px 40px; display: block; }
		#action{margin-top: 20px; display: flex; justify-content: space-between; align-items: center; background: lightblue; padding: 10px 20px;}
	</style>
</head>
<body>
	<main>
		<h1>pg2mysql converter (PostgreSQL to MySQL Converter)</h1>
		<p>
			The <b>pg2mysql</b> converter is an online tool to convert/migrate existing PostgreSQL databases into MySQL. <br>
			Simply dumping from Postgres and importing to MySQL does not work because of differences in syntax and data types. <br>
			To use this converter, just create a postgres SQL dump (<tt>pg_dump -U username -s dbname &gt; dbname.sql</tt>), and copy and paste it into the text area below. <br>
			Click the <b>Convert to MySQL</b> button and the page will re-load with your new MySQL code that you can copy out of the textarea into a text editor to save and import into your MySQL database.
		</p>

		<form method=post action="" enctype="multipart/form-data">
		<?php
			if ($_POST || $_FILES):

				if(array_key_exists('postgresdata', $_POST) && $_POST['postgresdata']):
			    	$convertedOutput = pg2mysql(stripslashes($_POST['postgresdata']));
				elseif(array_key_exists('postgres_filedata', $_FILES) && $_FILES['postgres_filedata']):
					$convertedOutput = pg2mysql_large($_FILES['postgres_filedata']['tmp_name'], 'mysql.sql', true);
				endif;
		?>
			<h3>Here is your MySQL dump file</h3>
			<textarea name="mysqldata"><?= $convertedOutput ?></textarea>
		<?php else: ?>
		 	<h3>Paste PostgreSQL dump file here</h3>
			<textarea name="postgresdata" placeholder="PostgreSQL dump..."></textarea>
			<div id="action">
				<div class="left">
					<span>or load from file</span>
					<input type="file" name="postgres_filedata">
				</div>
				<div>
					 <button type=submit>Convert to MySQL</button>
				</div>
			</div>
		<?php endif; ?>
		</form>

		<div>
			<strong>Notes:</strong>
			<ul>
				<li>No its not perfect</li>
				<li>Yes it discards ALL stored procedures</li>
				<li>Yes it discards ALL views </li>
				<li>Suggestions
					<ul>
						<li>Yes you can email us suggestions at <a href='mai&#108;to&#58;in%&#54;6&#111;&#64;&#37;6Ci&#103;htb&#111;%78&#46;or%6&#55;'>in&#102;o&#64;l&#105;gh&#116;&#98;o&#120;&#46;&#111;&#114;g</a></li>
						<li>or open <a href="https://github.com/JozefCipa/pg2mysql/issues">an issue</a> on Github.</li>
						<li>Please <strong>include the Postgres code, and the expected MySQL code</strong></li>
					</ul>
				</li>
			</ul>
		</div>
	</main>
</body>
</html>
