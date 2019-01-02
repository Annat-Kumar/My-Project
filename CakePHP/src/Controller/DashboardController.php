<?php

// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\View\Helper\baseHelper;
use Cake\ORM\TableRegistry;

class DashboardController extends AppController
{

	/* dashboard */
	
	public function dashboard()
	{
		 $this->viewBuilder()->layout('admin');
		 
		 $usersTable = TableRegistry::get('Users');
		 $users = $usersTable->find('all');
		 
		 $addbannerTable = TableRegistry::get('Banner');
		 $bannerlist = $addbannerTable->find('all');
		 
		 $this->set(compact('users','bannerlist'));		 
	}
	
	public function check_infelect_words($stem , $ending)
	{
		
	}


}
?>