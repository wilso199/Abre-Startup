<?php
	
	/*
	* Copyright (C) 2016-2017 Abre.io LLC
	*
	* This program is free software: you can redistribute it and/or modify
    * it under the terms of the Affero General Public License version 3
    * as published by the Free Software Foundation.
	*
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU Affero General Public License for more details.
	*
    * You should have received a copy of the Affero General Public License
    * version 3 along with this program.  If not, see https://www.gnu.org/licenses/agpl-3.0.en.html.
    */
	
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php'); 
	require_once(dirname(__FILE__) . '/../../core/abre_dbconnect.php');

	
	$profileupdatecount=0;
	$sql = "SELECT *  FROM profiles where email='".$_SESSION['useremail']."'";
	$result = $db->query($sql);

	while($row = $result->fetch_assoc())
	{
		$profileupdatecount=1;
		$stmt = $db->stmt_init();
		$sql2 = "UPDATE profiles set startup='0', AUP='0' where email='".$_SESSION['useremail']."'";
		$stmt->prepare($sql2);
		$stmt->execute();
		$stmt->store_result();
		$stmt->close();
		$db->close();
	}
	
	if ($profileupdatecount==0)
	{
		$stmt = $db->stmt_init();
		$sql = "Insert into profiles (id, email, startup, AUP) VALUES (NULL, '".$_SESSION['useremail']."', '0', '0')";
		$stmt->prepare($sql);
		$stmt->execute();
		$stmt->store_result();
		$stmt->close();
		$db->close();	
	}


?>