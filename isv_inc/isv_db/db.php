<?php
	/*******************************************************
	*   Copyright (C) 2014  http://isvipi.org
							
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
							
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
							
	You should have received a copy of the GNU General Public License along
	with this program; if not, write to the Free Software Foundation, Inc.,
	51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
	******************************************************/ 

	$db_host = "localhost";
	$db_name = "social";
	$db_user = "ab6407032";
	$db_pass = "ab6407032";

	//Try to connect to the database
	$isv_db = @new mysqli($db_host, $db_user, $db_pass, $db_name);
	if ($isv_db->connect_errno) {
		die("<h2>Database Connection Error...</h2>");
		exit();
	}
?>