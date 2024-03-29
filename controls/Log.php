<?php
################################################################################
#  Lumine - Database Mapping for PHP
#  Copyright (C) 2005  Hugo Ferreira da Silva
#  
#  This program is free software: you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation, either version 3 of the License, or
#  (at your option) any later version.
#  
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.
#  
#  You should have received a copy of the GNU General Public License
#  along with this program.  If not, see <http://www.gnu.org/licenses/>
################################################################################

require_once 'E:\wamp\www\Gestor\Persistence/Lumine.php';
require_once 'E:/wamp/www/Gestor/lumine-conf.php';

Lumine::load('Form_White');

$cfg = new Lumine_Configuration( $lumineConfig );
$cfg->import('Log');
register_shutdown_function(array($cfg->getConnection(), 'close'));

$obj = new Log;

$form = new Lumine_Form_White( $obj );

if( !empty($_REQUEST['_lumineAction']))
{
	switch($_REQUEST['_lumineAction'])
	{
		case 'insert':
		case 'save':
			$result = $form->handleAction($_REQUEST['_lumineAction'], $_POST);
			if($result === true)
			{
				header("Location: ".$_SERVER['PHP_SELF'].'?msg=ok');
				exit;
			}
		break;

		case 'delete':
			$result = $form->handleAction($_REQUEST['_lumineAction'], $_GET);
			if($result === true)
			{
				header("Location: ".$_SERVER['PHP_SELF'].'?msg=ok');
				exit;
			}
		break;
		
		case 'edit':
			$form->handleAction($_REQUEST['_lumineAction'], $_GET);
			$editing = 1;
		break;
	}
}

$limit = empty($_GET['limit']) ? 0 : (int)$_GET['limit'];
$offset = empty($_GET['offset']) ? 0 : (int)$_GET['offset'];

if($limit <= 0)
{
	$limit = 20;
}


echo $form->createForm();
echo $form->showList($offset, $limit);
