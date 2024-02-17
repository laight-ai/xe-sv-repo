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
	public function get301Url($sMid, $nDocumentSrl)
	{
		$oDbParam = new stdClass();
		$oDbParam->mid = trim($sMid);
		$oDbParam->document_srl = intval($nDocumentSrl);
		$oRst = executeQuery('svperm_move.get301Url', $oDbParam);
		unset($oDbParam);
		
		$oDbParam = new stdClass();
		$oDbParam->http_referer = trim($_SERVER['HTTP_REFERER']);
		$oDbParam->request_uri = trim($_SERVER['REQUEST_URI']);
		$oDbParam->target_url = $oRst->data->target_url;
		$oInsertRst = executeQuery('svperm_move.insert301Log', $oDbParam);
		unset($oDbParam);

		return $oRst->data->target_url;
	}
}
/* End of file svperm_move.model.php */
/* Location: ./modules/svperm_move/svperm_move.model.php */