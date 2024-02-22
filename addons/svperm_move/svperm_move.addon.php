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

if(!getClass('svperm_move'))
	exit();

$oSvperm_moveModel = getModel('svperm_move');
$s301TargetUrl = null;
$nDocumentSrl = Context::get('document_srl');
$sMid = Context::get('mid');
if( intval($nDocumentSrl) )  // document case
{
	$s301TargetUrl = $oSvperm_moveModel->get301UrlByDocSrl( $nDocumentSrl );
}
elseif( strlen($sMid) )  // page case
{
	$s301TargetUrl = $oSvperm_moveModel->get301UrlByMid( $sMid );
}
unset($oSvperm_moveModel);

if(!is_null($s301TargetUrl))
{
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: '.$s301TargetUrl);
	exit;
}



/* End of file perm_move.addon.php */
/* Location: ./addons/perm_move/perm_move.addon.php */