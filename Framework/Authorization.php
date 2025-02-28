<?php

namespace Framework;
use Framework\Session;

class Authorization{

	//check if current user owns the listing
	public static function isOwner($resourceID){
		$sessionUser = Session::get('user');
		if($sessionUser !== null && isset($sessionUser['id'])){
			$sessionUserId = (int) $sessionUser['id'];
			return $sessionUserId === $resourceID;
		}

		return false;
	}
}