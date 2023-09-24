<?php 

function AllPermissions()
{

	$permissions=[
		'common'=>[
			'roles'=>['view', 'create', 'edit', 'delete'],
			'admins'=>['view', 'create', 'edit', 'delete'],
			'users'=>['view', 'create', 'edit', 'delete'],
			'settings'=>['view', 'create', 'edit', 'delete'],
		],

		'network'=>[],
		'freelancing'=>[],
		'crowd-funding'=>[],
	];

return $permissions;
}