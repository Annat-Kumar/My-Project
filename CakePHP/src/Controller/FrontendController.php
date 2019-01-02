<?php 

// src/Controller/FrontendController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\View\Helper\baseHelper;
use Cake\ORM\TableRegistry;

class FrontendController extends AppController
{
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['home' ,'banner' ,]);
		
		
    }

	public function home()
	{
		
		$user = "";
		$loguser = $this->request->session()->read('Auth.User');
		if(!empty($loguser)){
			$user_role = $loguser['role'];
			$user_id = $loguser['id'];
			
			if($user_role == "admin")
			{
				//return $this->redirect('/userlist');
			}
		}
		
		
		$this->viewBuilder()->layout('frontend-theme');
		
		$addbannerTable = TableRegistry::get('Banner');		
		$bannerlist = $addbannerTable->find('all');
		
		$featuresTable = TableRegistry::get('Features');
		$featureslist = $featuresTable->find('all');
		 
		 $this->set(compact('featureslist', 'bannerlist'));
	}
	public function banner()
	{
		 $this->viewBuilder()->layout('frontend-theme');
		 
		 $this->autoRender = false;		 
		 $this -> render('/Frontend/home');
		 
		 $addbannerTable = TableRegistry::get('Banner');		
		 $bannerlist = $addbannerTable->find('all');
		 
		 $featuresTable = TableRegistry::get('Features');
		 $featureslist = $featuresTable->find('all');
		 
		 //$this->set('bannerlist',$bannerlist);
		 $this->set(compact('featureslist', 'bannerlist'));
	}

}