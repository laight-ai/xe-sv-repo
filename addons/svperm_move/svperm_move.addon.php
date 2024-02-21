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

//$sMid = Context::get('mid');
$nDocumentSrl = Context::get('document_srl');
//if( strlen($sMid) && intval($nDocumentSrl) )
if( intval($nDocumentSrl) )
{
	$s301TargetUrl = null;
	if(getClass('svperm_move'))
	{
		$oSvperm_moveModel = getModel('svperm_move');
		//$s301TargetUrl = $oSvperm_moveModel->get301Url( $sMid, $nDocumentSrl );
		$s301TargetUrl = $oSvperm_moveModel->get301Url( $nDocumentSrl );
	}

	if(!is_null($s301TargetUrl))
	{
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: '.$s301TargetUrl);
		exit;
	}
}
/* End of file perm_move.addon.php */
/* Location: ./addons/perm_move/perm_move.addon.php */