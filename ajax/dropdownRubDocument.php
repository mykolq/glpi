<?php
/*
 * @version $Id$
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2008 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file: Julien Dombre
// Purpose of file:
// ----------------------------------------------------------------------


if(ereg("dropdownRubDocument.php",$_SERVER['PHP_SELF'])){
	define('GLPI_ROOT','..');
	$AJAX_INCLUDE=1;
	include (GLPI_ROOT."/inc/includes.php");
	header("Content-Type: text/html; charset=UTF-8");
	header_nocache();
}

checkCentralAccess();

// Make a select box

if (isset($_POST["rubdoc"])){

	$rand=$_POST['rand'];

	$use_ajax=false;
	if ($CFG_GLPI["use_ajax"] && 
		countElementsInTable('glpi_docs',"glpi_docs.rubrique='".$_POST["rubdoc"]."' ".getEntitiesRestrictRequest("AND", "glpi_docs","",$_POST["entity_restrict"],true) )>$CFG_GLPI["ajax_limit_count"]
	){
		$use_ajax=true;
	}


	$paramsrubdoc=array('searchText'=>'__VALUE__',
			'rubdoc'=>$_POST["rubdoc"],
			'entity_restrict'=>$_POST["entity_restrict"],
			'rand'=>$_POST['rand'],
			'myname'=>$_POST['myname'],
			'used'=>$_POST['used']
			);
	
	$default="<select name='".$_POST["myname"]."'><option value='0'>------</option></select>";
	ajaxDropdown($use_ajax,"/ajax/dropdownDocument.php",$paramsrubdoc,$default,$rand);

}		
?>
