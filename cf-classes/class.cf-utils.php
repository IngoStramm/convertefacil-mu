<?php
/**
* 
*/
class Cf_Utils
{
	
	function __construct()
	{
		# code...
	}
	public function is_not_super_admin_and_is_admin_and_is_not_your_own_profile()
	{
		$curr_user_id = get_current_user_id();
		$user_id = $user->ID;
		return (
			!is_super_admin( $curr_user_id ) // se não for um SuperAdmin que estiver visualizando o perfil 
			&& is_admin( $curr_user_id ) // e se for um admin que estiver visualizando o perfil
			&& $curr_user_id != $user_id // e se não for o seu próprio perfil
		);
	}
	public function is_not_super_admin_and_admin()
	{
		$curr_user_id = get_current_user_id();
		$user_id = $user->ID;
		return (
			!is_super_admin( $curr_user_id ) // se não for um SuperAdmin que estiver visualizando o perfil 
			&& !is_admin( $curr_user_id ) // e se não for um admin que estiver visualizando o perfil
		);
	}
}