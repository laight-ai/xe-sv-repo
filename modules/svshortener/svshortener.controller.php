<?php
/**
 * @class  svshortenerController
 * @author singleview(root@singleview.co.kr)
 * @brief  svshortenerController
**/ 
class svshortenerController extends svshortener
{
	/**
	 * @brief initialization
	 **/
	function init()
	{
	}

	public function increaseCounter($sQueryValue)
	{
		$oArgs = new stdClass();
		$oArgs->shorten_uri_value = $sQueryValue;
		$output = executeQuery('svshortener.updateHitCount', $oArgs );
		if( !$output->toBool() )
			return new BaseObject(-1, 'msg_error_svshortener_db_query');

		// user agent information
		$oArgs->is_mobile_access = $_COOKIE['mobile'] == 'false' ? 'N' : 'Y';
		$oArgs->user_agent = trim( $_SERVER['HTTP_USER_AGENT'] );
		$output = executeQuery('svshortener.insertHitLog', $oArgs );
        unset($oArgs);
		if( !$output->toBool() )
			return new BaseObject(-1, 'msg_error_svshortener_db_query');
	}
/**
 * @brief LP�� ���� ������ source�� session�� ���
 **/
	public function setSessionSource($sSource)
	{
		if(strlen($sSource) > 0)
		{
			$sTmp = urldecode(trim($sSource)); 
			$_SESSION['HTTP_INIT_SOURCE'] = $sTmp;
		}
	}
/**
 * @brief LP�� ���� ������ medium�� session�� ���
 **/
	public function setSessionMedium($sMedium)
	{
		if(strlen($sMedium) > 0)
		{
			$sTmp = urldecode(trim($sMedium)); 
			$_SESSION['HTTP_INIT_MEDIUM'] = $sTmp;
		}
	}
/**
 * @brief LP�� ���� ������ campaign�� session�� ���
 **/
	public function setSessionCampaign($sCampaign)
	{
		if(strlen($sCampaign) > 0)
		{
			$sTmp = urldecode(trim($sCampaign)); 
			$_SESSION['HTTP_INIT_CAMPAIGN'] = $sTmp;
		}
	}
/**
 * @brief LP�� ���� ������ keyword�� session�� ���
 **/
	public function setSessionKeyword($sKeyword)
	{
		if(strlen($sKeyword) > 0)
			$_SESSION['HTTP_INIT_KEYWORD'] = $sKeyword;
	}
}
