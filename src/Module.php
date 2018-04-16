<?php
namespace Stagem\ZfcMenu;

class Module {

	public function getConfig()
	{
		return include __DIR__ . '/../config/module.config.php';
	}

	/*public function getViewHelperConfig()
	{
		return array(
			'factories' => array(
				'menu' => function($vhm) {
					$sm = $vhm->getServiceLocator();
					//$authService = $locator->get('UserAuthentication')->getAuthService();
					//$user = new \Agere\Users\View\Helper\User($authService);
					$user = $vhm->get('user');
					return new \Stagem\ZfcMenu\View\Helper\Menu($user->getUser(), $sm);
				},
			),
		);
	}*/

}