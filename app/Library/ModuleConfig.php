<?php
  
namespace App\Library;
use Illuminate\Http\Request;

  
class ModuleConfig
{
	public static function getModuleConfig($module) 
	{
		$config = [
								'user' => [
									'module_title' => 'User Management',
									'module' => 'user',
									'module_name' => 'User',
									'plural' => 'Users',
								   ],

								'document' => [
									'module_title' => 'Expired Management',
									'module' => 'document',
									'module_name' => 'Document',
									'plural' => 'Documents',
								   ],

								'backup' => [
									'module_title' => 'Backup Management',
									'module' => 'backup',
									'module_name' => 'Backup',
									'plural' => 'Backups',
								   ],

								'training' => [
									'module_title' => 'Training Management',
									'module' => 'training',
									'module_name' => 'Training',
									'plural' => 'Training',
								   ],

								'teamtask' => [
									'module_title' => 'Task Management',
									'module' => 'teamtask',
									'module_name' => 'Task',
									'plural' => 'Tasks',
								   ],

								'client' => [
									'module_title' => 'Client Management',
									'module' => 'client',
									'module_name' => 'client',
									'plural' => 'Clients',
								   ],


								'company' => [
									'module_title' => 'Company Management',
									'module' => 'tenant',
									'module_name' => 'Company',
									'plural' => 'Companies',
								   ],


								'people' => [
									'module_title' => 'People Management',
									'module' => 'people',
									'module_name' => 'People',
									'plural' => 'People',
								   ],

								'project' => [
									'module_title' => 'Project Management',
									'module' => 'project',
									'module_name' => 'Project',
									'plural' => 'Projects',
								   ],


								'category' => [
									'module_title' => 'Category Management',
									'module' => 'category',
									'module_name' => 'Category',
									'plural' => 'Categories',
								   ],

								'site' => [
									'module_title' => 'Site Management',
									'module' => 'site',
									'module_name' => 'Site',
									'plural' => 'Sites',
								   ],

								'subcontractor' => [
									'module_title' => 'Subcontractor Management',
									'module' => 'subcontractor',
									'module_name' => 'Subcontractor',
									'plural' => 'Subcontractors',
								   ],


								'certification' => [
									'module_title' => 'Certification Management',
									'module' => 'certification',
									'module_name' => 'Certification',
									'plural' => 'Certifications',
								   ],

								'team' => [
									'module_title' => 'Team Management',
									'module' => 'team',
									'module_name' => 'Team',
									'plural' => 'Teams',
								   ],

								'suboperative' => [
									'module_title' => 'Suboperative Management',
									'module' => 'suboperative',
									'module_name' => 'Suboperative',
									'plural' => 'Suboperatives',
								   ],

								'setting' => [
									'module_title' => 'Settings',
									'module' => 'setting',
									'module_name' => 'Settings',
									'plural' => 'Settings',
								   ],


								'security' => [
									'module_title' => 'Security',
									'module' => 'security',
									'module_name' => 'Security',
									'plural' => 'Users',
								   ],

								'profile' => [
									'module_title' => 'Profile Details',
									'module' => 'profile',
									'module_name' => 'Profile',
									'plural' => 'Users',
								   ]


						];






		$config = $config[$module];
		return $config;
    }

	public static function getAction($data)
	{
		if(empty($data))
			return 'Add New ';
		else
			return 'Update ';
	}  

}


?>