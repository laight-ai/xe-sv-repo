<?php
/**
 * @class  svdocsAdminModel
 * @author singleview(root@singleview.co.kr)
 * @brief  svdocsAdminModel
**/ 
class svshortenerAdminModel extends svshortener
{
	/**
	 * Initialization
	 * @return void
	 */
	function init()
	{
	}

	/**
	 *
	 */
	public function getMaxIndex()
	{
		$output = executeQueryArray('svshortener.getSvShortenersMaxIndex' );

		if( !$output->toBool() )
			return new BaseObject(-1, 'msg_error_svshortener_db_query');

		if( count( $output->data ) == 0 )  // ���� �Է½� ++�ε����� 0�� �ǵ���
			return -1;

		foreach( $output->data as $key => $val )
			return $val->shortener_srl;
	}

	/**
	 *
	 */
	public function isExistingUriValue( $sQueryValue )
	{
        $args = new stdClass();
		$args->shorten_uri_value = $sQueryValue;
		$output = executeQueryArray('svshortener.getSvshortenersUriValue', $args );
        unset($args);

		if( !$output->toBool() )
			return new BaseObject(-1, 'msg_error_svshortener_db_query');

		if( count( $output->data ) == 0 )  // ���ο� uri value�̸�
			return false;
		else
			return true;
	}
}
/* End of file board.admin.model.php */
/* Location: ./modules/board/board.admin.model.php */