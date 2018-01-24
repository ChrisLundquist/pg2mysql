#!/usr/bin/php
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

function print_notes()
{
	global $config;
	
	fwrite( STDERR, <<<XHTML
NOTES:
 - No its not perfect
 - Yes it discards ALL stored procedures
 - Yes it discards ALL queries except for CREATE TABLE and INSERT INTO
 - No it does not convert PostgreSQL domains
 - Yes you can email us suggestsions: info[AT]lightbox.org
    - In emails, please include the Postgres code, and the expected MySQL code
 - If you're having problems creating your postgres dump, make sure you use
   "--format p --inserts"
 - Default output engine if not specified is {$config['engine']}

XHTML
	);

}


function print_help()
{
	global $config;
	
	$constants = get_defined_constants();

	fwrite( STDERR, <<<USAGE
SYNOPSIS
  php pg2mysql_cli.php [OPTIONS] [<input> [<output>]]

DESCRIPTION
  <input>
      name of the input file or a dash (-) for STDIN.  Defaults to STDIN

  <output>
      name of the output file or a dash (-) for STDOUT.  Defaults to STDOUT

  --engine <engine>
      name of the MySQL database engine to be used by converted
      tables.  Defaults to {$config['engine']}

  --domains <filename>
      name of the file that contains domain definitions for the conversion

  --verbose
      print extra processing information to STDERR.

  --help
      print this help information

VERSION
  {$constants['VERSION']}

COPYRIGHT
  {$constants['COPYRIGHT']}


USAGE
	);
	print_notes();
}

// remove the program name
array_shift($argv);

$domain_file = NULL;
$input_file = NULL;
$output_file = NULL;
$engine = NULL;

while (count($argv)) {
	$arg = array_shift($argv);
	if (preg_match('/^--/', $arg)) {
		if ($arg == '--domains') {
			$domain_file = array_shift($argv);

		} elseif ($arg == '--help') {
			print_help();
			exit;

		} elseif ($arg == '--verbose') {
			$config['verbose'] = true;

        } elseif ($arg == '--no-header') {
            $config['no-header'] = true;

        } elseif ($arg == '--sqlite') {
            $config['sqlite'] = true;
            $config['no-header'] = true;

        } elseif ($arg == '--engine') {
			$config['engine'] = array_shift($argv);

		} else {
			fwrite(STDERR, "ERROR: option '$arg' is not recognized.\n\n");
			print_help();
			exit(1);
		}				
		
	} elseif (!$input_file) {
		$input_file = $arg;
		
	} elseif (!$output_file) {
		$output_file = $arg;

	} elseif (!$engine) {
		$config['engine'] = $arg;
		$engine = 1;
	}
}

// default to STDIN
if (!$input_file) {
	$input_file = '-';
}
write_debug("Input File: $input_file");

// default to STDOUT
if (!$output_file) {
	$output_file = '-';
}
write_debug("Output File: $output_file");

if ($domain_file) {
	write_debug("Domain definitions file: $domain_file");
	read_domains(file($domain_file));
	foreach ($config['domains'] as $name => $def) {
		write_debug("    $name --> $def");
	}
	write_debug("");
}

pg2mysql_large($input_file, $output_file);

print_notes();

