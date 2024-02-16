<?php
/**
 * @class  svperm_move
 * @author singleview(root@singleview.co.kr)
 * @brief  svperm_move
 */
class svperm_move extends ModuleObject
{
/**
 * @brief 
 **/
	function svperm_move()
	{
	}
/**
 * @brief 모듈 설치 실행
 **/
	function moduleInstall()
	{
		$oModuleModel = &getModel('module');
		$oModuleController = &getController('module');
		return new BaseObject();
	}
/**
 * @brief 설치가 이상없는지 체크
 **/
	function checkUpdate()
	{
		return false;
	}
/**
 * @brief 업데이트(업그레이드)
 **/
	function moduleUpdate()
	{
		return new BaseObject(0, 'success_updated');
	}
/**
 * @brief 
 **/
	function moduleUninstall()
	{
	}
/**
 * @brief 캐시파일 재생성
 **/
	function recompileCache()
	{
	}
}
/* End of file svperm_move.class.php */
/* Location: ./modules/svperm_move/svperm_move.class.php */