<?php
class svperm_moveAdminView extends svperm_move
{
	function init()
	{
		$this->setTemplatePath($this->module_path . 'tpl');
		$this->setTemplateFile(str_replace('dispSvperm_move', '', $this->act));
	}

	/**
 * @brief display svperm_move 301 move URL list
 **/
	function dispSvperm_moveAdminIndex() 
	{
		// get svperm_move addon info
		$oAddonAdminModel = getAdminModel('addon');
		$svperm_moveAddonList = $oAddonAdminModel->getAddonInfoXml('svperm_move');
		if( $svperm_moveAddonList == NULL )
			return new BaseObject(-1, 'msg_error_svperm_move_addon_not_installed');

		unset( $svperm_moveAddonList );

		$oArgs = new stdClass();
		$oArgs->page = Context::get('page');
		$oRst = executeQueryArray('svperm_move.getAdmin301Urls', $oArgs);
		unset($oArgs);

		Context::set('svshortener_list', $oRst->data );
		Context::set('total_count', $oRst->total_count);
		Context::set('total_page', $oRst->total_page);
		Context::set('page', $oRst->page);
		Context::set('page_navigation', $oRst->page_navigation);
		
		// Set a template file
		$this->setTemplateFile('index');
	}
/**
 * @brief
 **/
	function dispSvperm_moveAdminInsert() 
	{
		$this->setTemplateFile('insert');
	}
}
/* !End of file */
