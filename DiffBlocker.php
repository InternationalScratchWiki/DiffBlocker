<?php
class DiffBlocker {
	public static function ongetUserPermissionsErrors( $title, $user, $action, &$result ) {
		global $wgRequest;
				
		if (!empty($wgRequest->getQueryValues()['oldid']) && $user->isAnon()) {
			$result = ['diffblocker-login-required'];
			
			return false;
		}
	}
}