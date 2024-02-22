<?php
/**
 * @class  svperm_moveModel
 * @author singleview(root@singleview.co.kr)
 * @brief  svperm_moveModel
 */
class svperm_moveModel extends svperm_move
{
/**
 * @brief 
 * @return
 */
	public function get301UrlByDocSrl($nDocumentSrl)
	{
		$oDbParam = new stdClass();
		$oDbParam->document_srl = intval($nDocumentSrl);
		$oRst = executeQuery('svperm_move.get301Url', $oDbParam);
		unset($oDbParam);
		$this->_insertLog($oRst->data->target_url);
		return $oRst->data->target_url;
	}
/**
 * @brief 
 * @return
 */
	public function get301UrlByMid($sMid)
	{
		$oDbParam = new stdClass();
		$oDbParam->mid = trim($sMid);
		$oDbParam->document_srl = 0;
		$oRst = executeQuery('svperm_move.get301Url', $oDbParam);
		unset($oDbParam);
		$this->_insertLog($oRst->data->target_url);
		return $oRst->data->target_url;
	}
/**
 * @brief 
 * @return
 */
	private function _insertLog($sTargetUrl)
	{
		$oDbParam = new stdClass();
		$oDbParam->http_referer = trim($_SERVER['HTTP_REFERER']);
		$oDbParam->request_uri = trim($_SERVER['REQUEST_URI']);
		$oDbParam->target_url = $sTargetUrl;
		$oInsertRst = executeQuery('svperm_move.insert301Log', $oDbParam);
		unset($oDbParam);
	}
}
/* End of file svperm_move.model.php */
/* Location: ./modules/svperm_move/svperm_move.model.php */