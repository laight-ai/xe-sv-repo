<?php
/**
 * @class  shortenerClass
 * @author singleview(root@singleview.co.kr)
 * @brief  shortenerClass
**/ 

class svshortener extends ModuleObject
{
/**
 * @brief 
 **/
	function moduleInstall()
	{
		return new BaseObject();
	}
/**
 * @brief a method to check if successfully installed
 */
	function checkUpdate()
	{
		return false;
	}
/**
 * @brief Execute update
 */
	function moduleUpdate()
	{
		return new BaseObject(0,'success_updated');
	}
/**
 * @brief Re-generate the cache file
 */
	function recompileCache()
	{
	}
/**
 * @brief execute GA4 utm parameters
 */
	public function displayShortenerGtag()
	{
		$sShortnerQueryName = null;
		$oAddonAdminModel = &getAdminModel('addon');
		$aAddonInfo = $oAddonAdminModel->getAddonInfoXml('svtracker');
		foreach($aAddonInfo as $sIdx => $oVal)
		{
			if($sIdx == 'extra_vars')
			{
				if(is_array($oVal))
				{
					foreach($oVal as $nIdx => $oExtraVarVal)
					{
						if($oExtraVarVal->name == 'shortner_query_name')
						{
							$sShortnerQueryName = $oExtraVarVal->value;
							unset($oExtraVarVal);
							break;
						}
					}
				}
				break;
			}
			unset($oVal);
		}
		unset($aAddonInfo);
		unset($oAddonAdminModel);
		if(!$sShortnerQueryName)
			return '';

		$aQuery = explode('&', $_SERVER['QUERY_STRING']);
		foreach($aQuery as $key => $val)
		{
			if(preg_match("/\b$sShortnerQueryName\b/i", $val))
			{
				$aValue = explode('=', $val);
				break;
			}
		}
		unset($oExtraVarVal);
		if($aValue === NULL)  // utm_param 이 있는지 검사
		{
			return '';
		}
		else
		{
			if(getClass('svshortener'))
			{
				$oSvshortenerModel = getModel('svshortener');
				$aShortenerInfo = $oSvshortenerModel->getShortenerInfo($aValue[1]);
				unset($oSvshortenerModel);
			}
			if(!$aShortenerInfo)
				return '';
			$oSvshortenerController = getController('svshortener');
			$oSvshortenerController->increaseCounter($aValue[1]);
			$aShrtenInfo['source'] = $aShortenerInfo[1];
			$aShrtenInfo['medium'] = $aShortenerInfo[2];
			$aShrtenInfo['campaign'] = $aShortenerInfo[3];
			$aShrtenInfo['keyword'] = $aShortenerInfo[4];
			$oSvshortenerController->setSessionSource($aShrtenInfo['source']);
			$oSvshortenerController->setSessionMedium($aShrtenInfo['medium']);
			$oSvshortenerController->setSessionCampaign($aShrtenInfo['campaign']);
			$oSvshortenerController->setSessionKeyword($aShrtenInfo['keyword']);
			unset($oSvshortenerController);
			
			$sGtagUtmParma = "gtag('set', {
				'campaign_name': '$aShortenerInfo[3]',
				'campaign_source': '$aShortenerInfo[1]',
				'campaign_medium': '$aShortenerInfo[2]',
				'campaign_term': '$aShortenerInfo[4]',
				//'campaign_id': '',
				//'campaign_content': '',
			});";
			return $sGtagUtmParma;
		}
	}
}