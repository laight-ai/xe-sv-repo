<?php
/* Copyright (C) singleview.co.kr <http://singleview.co.kr> */

if(!defined('__XE__'))
	exit();

/**
 * @file perm_move.addon.php
 * @author singleview.co.kr (root@singleview.co.kr)
 * @brief perm_move add-on
 */
// Execute if called_position is before_display_content
if(!defined( '__ZBXE__' ) )
	exit();

$sMid = Context::get('mid');
$nDocumentSrl = Context::get('document_srl');

//var_dump($sMid );
//var_dump($nDocumentSrl );

$sNo = Context::get('NO');
if(strlen($sNo))
{
	$aPermanentMove = ['9226'=>'maternity/308',];
	$sDestUrl = '';
	if(array_key_exists($sNo, $aPermanentMove))
		$sDestUrl = $aPermanentMove[$sNo];

	header('HTTP/1.1 301 Moved Permanently');
	header('Location: https://ange.co.kr/'.$sDestUrl);
	exit;
}
/* End of file perm_move.addon.php */
/* Location: ./addons/perm_move/perm_move.addon.php */