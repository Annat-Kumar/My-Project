<?php 

// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\View\Helper\baseHelper;
use Cake\ORM\TableRegistry;

class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['signup']);
		
		
		
    }

     public function index()
     {
        //$this->set('users', $this->Users->find('all'));
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }
	
	/* user registration */
    public function signup()
    {
		if ($this->Auth->user()) 
		{
			$this->redirect('/home');
		}
		
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			//print_r($data);
            // Prior to 3.4.0 $this->request->data() was used.
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect('/login');
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }
	
	
	/* add user by admin */
	public function addUser()
    {		
		$user = "";
		$loguser = $this->request->session()->read('Auth.User');
			if(!empty($loguser)){
			$user_role = $loguser['role'];
			$user_id = $loguser['id'];			
		
			if($user_role == "user")
			{
				return $this->redirect('/home');
			}
		}
		$this->viewBuilder()->layout('admin');
		$RegistrationTable = TableRegistry::get('Users');	
        $registration = $RegistrationTable->newEntity();
        if ($this->request->is('post')) {
			
			   $data = $this->request->getData();
			   //print_r($data);die;     
			   $date_time = date("Y-m-d H:i:s");			   
			   $registration->username = $data['username'];
			   $registration->password = $data['password'];
			   $registration->email = $data['email'];
			   $registration->phone = $data['phone'];
			   $registration->role = 'user';
			   $registration->created = $date_time;
			  
			  $save = $RegistrationTable->save($registration);
				if ($save) {
					$this->Flash->success(__('The user has been saved.'));
					return $this->redirect(['action' => 'login']);
				}
				else
					{
						$this->Flash->error(__('Unable to add the user.'));
					}
        }
        $this->set('user', $registration);
    }
	
	 public function login()
    {
		if ($this->Auth->user()) 
		{
			$this->redirect('/home');
		}
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
			//print_r($user);die;
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }
	public function home()
	{
		 //$this->viewBuilder()->layout('frontend-theme');
	}
	
	public function userlist()
	{	
		$user = "";
		$loguser = $this->request->session()->read('Auth.User');
			if(!empty($loguser)){
			$user_role = $loguser['role'];
			$user_id = $loguser['id'];			
		
			if($user_role == "user")
			{
				return $this->redirect('/home');
			}
		}
		
		 $this->viewBuilder()->layout('admin');
		 $users = $this->Users->find('all');
		 $this->set('users',$users); 
	}
	public function editUser($id = null) {
		
		$user = "";
		$loguser = $this->request->session()->read('Auth.User');
			if(!empty($loguser)){
			$user_role = $loguser['role'];
			$user_id = $loguser['id'];			
		
			if($user_role == "user")
			{
				return $this->redirect('/home');
			}
		}
		
		 $this->viewBuilder()->layout('admin');
		
		 $RegistrationTable = TableRegistry::get('Users');	
		 $user = $this->Users->get($id);
			
         if ($this->request->is('post')) {
			 
			 $data = $this->request->getData();			
            //$this->Users->patchEntity($user, $this->request->data);
			   $date_time = date("Y-m-d H:i:s");			   
			   $user->username = $data['username'];			   			  
			   $user->phone = $data['phone'];
			   $user->role = $data['role'];
			   $user->modified = $date_time;
			   $save = $RegistrationTable->save($user);
			   //$this->Users->save($user)
				if ($save) {
                $this->Flash->success(__('Your profile data has been updated.'));
                 $this->redirect('/userlist');
				}
				else {
				$this->Flash->error(__('Unable to update your profile.'));
				}
        }

        $this->set('user', $user);  
	}
	
	
	public function deleteuser($id)
	{
		$user = "";
		$loguser = $this->request->session()->read('Auth.User');
			if(!empty($loguser)){
			$user_role = $loguser['role'];
			$user_id = $loguser['id'];			
		
			if($user_role == "user")
			{
				return $this->redirect('/home');
			}
		}
		 $user = $this->Users->get($id);
		 $delete = $this->Users->delete($user);
		 if ($delete) {
			
			 $this->redirect('/userlist');
				$this->Flash->success(__('User has been deleted.'));
		}
		else{
			$this->Flash->error(__('Unable to delete user.'));
		}
	}
	/* update user profile */
	public function updateProfile($id = null) {
		
		
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
		 $this->viewBuilder()->layout('admin');
		
		 $UsersTable = TableRegistry::get('Users');	
		 $user = $this->Users->get($id);
			
         if ($this->request->is('post')) {
			 
			 $data = $this->request->getData();		
				//print_r($data);die;
			   $date_time = date("Y-m-d H:i:s");			   
			   $user->username = $data['username'];			   			  
			   $user->phone = $data['phone'];			   
			   $user->modified = $date_time;
			   $save = $UsersTable->save($user);			  
				if ($save) {
                $this->Flash->success(__('Your profile has been updated.'));
                 $this->redirect('/userlist');
				}
				else {
				$this->Flash->error(__('Unable to update your profile.'));
				}
        }

        $this->set('user', $user);  
	}

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

}