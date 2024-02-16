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
		$oArgs = new stdClass();
		$oArgs->page = Context::get('page');
		
		//$aSearchTargetList = ['s_applicant_name','s_applicant_phone_number'];
		//$search_target = Context::get('search_target');
		//$search_keyword = Context::get('search_keyword');
		//if(in_array($search_target,$aSearchTargetList) && $search_keyword) $args->{$search_target} = $search_keyword;
		$oRst = executeQueryArray('svperm_move.getAdmin301Urls', $oArgs);
		var_dump($oRst);

		// get svtracker addon info
		$oAddonAdminModel = getAdminModel('addon');
		$svperm_moveAddonList = $oAddonAdminModel->getAddonInfoXml('svperm_move');
		if( $svperm_moveAddonList == NULL )
			return new BaseObject(-1, 'msg_error_svperm_move_addon_not_installed');

		/*foreach( $svperm_moveAddonList->extra_vars as $key => $val )
		{
			if( $val->name == 'shortner_query_name' )
			{
				Context::set('shortner_query_name', $val->value );
				break;
			}
		}*/
		unset( $svperm_moveAddonList );
		
		/*$db_info = Context::getDBInfo();
		Context::set('default_url', $db_info->default_url );
		unset( $db_info );
		
		$oSvshortenerModel = getModel('svshortener');
		$oSvshortenerModel->setBloggerType();
		
		foreach( $output->data as $key=>$val )
		{
			$val->utm_term = $oSvshortenerModel->generateUtmTerm($val->blogger_type,$val->utm_term,$val->blogger_id );
			unset( $val->blogger_type );
			unset( $val->blogger_id );
		}

		Context::set('svshortener_list', $output->data );
		Context::set('total_count', $output->total_count);
		Context::set('total_page', $output->total_page);
		Context::set('page', $output->page);
		Context::set('page_navigation', $output->page_navigation);*/
		
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
