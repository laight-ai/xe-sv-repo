<?php
class svperm_moveAdminController extends svperm_move
{
 /**
 * @brief 초기화
 **/
	function init()
	{
	}
/**
 * @brief 관리자 - 기본설정 저장
 **/
	public function procSvperm_moveAdminInsert() 
	{
		$oArgs = Context::getRequestVars();
		foreach( explode(PHP_EOL, $oArgs->permanent_move_url_info) as $sInfo ){
			$aInfo = explode(',', $sInfo);
			$oDbParam = new stdClass();
			$oDbParam->mid = trim($aInfo[0]);
			$oDbParam->document_srl = intval($aInfo[1]);
			$oDbParam->target_url = trim($aInfo[2]);
			unset($aInfo);

			$oRst = executeQueryArray('svperm_move.get301Url', $oDbParam);
			if(count($oRst->data ) > 0 ){
				return new BaseObject(-1, sprintf(Context::getLang('msg_error_svperm_move_duplicated_source_url'), $oDbParam->mid, $oDbParam->document_srl));
			}
 			unset($oRst);

			$oRst = executeQuery('svperm_move.insertAdmin301Url', $oDbParam);
			unset($oDbParam);
			if(!$oRst->toBool()) 
				return $oRst;
		}
		unset($oRst);
		unset($oArgs);
		$this->setRedirectUrl(getNotEncodedUrl('', 'module', Context::get('module'), 'act', 'dispSvperm_moveAdminIndex'));
	}
}
/* !End of file */