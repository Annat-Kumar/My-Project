<?php 

// src/Controller/AdminController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\View\Helper\baseHelper;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

class AdminController extends AppController
{
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        //$this->Auth->allow(['addBanner' ,'updateBanner' , 'deleteBanner' ,'addFeatures' ,'updateFeatures' ,'deleteFeatures']);
		
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
				
    }
	
	public function addBanner()
	{
		 $this->viewBuilder()->layout('admin');
		 
		 $addbannerTable = TableRegistry::get('Banner');
		 $addBanner = $addbannerTable->newEntity();
		 $bannerlist = $addbannerTable->find('all');
		 if($this->request->is('post'))
		 {
			$data = $this->request->getData();		
			
			$banner = $addbannerTable->newEntity($data);
			if($banner->errors()){
                $error_msg = [];
                foreach( $banner->errors() as $errors){
                    if(is_array($errors)){
                        foreach($errors as $error){
                            $error_msg[]    =   $error;
                        }
                    }else{
                        $error_msg[]    =   $errors;
                    }
                }
					$this->Flash->error(__('Fix all these bug'));
                   $this->set('err_msg', $error_msg);
            }
			else{
			$fileName = $data['banner_image']['name'];
			$file_tempname = $data['banner_image']['tmp_name'];
			$uploadPath = 'img/banner/';			
			if($fileName) {
			$uploadFile = $uploadPath.$fileName;			 
			$upload_file = move_uploaded_file($file_tempname,$uploadFile);
			if($upload_file) {
			$date_time = date("Y-m-d H:i:s");			   
			$addBanner->slide_title = $data['slide_title'];
			$addBanner->slide_subtitle = $data['slide_subtitle'];
			$addBanner->slide_desc = $data['slide_desc'];
			$addBanner->img_name = $fileName;			  
			$addBanner->created = $date_time;

			$save = $addbannerTable->save($addBanner);
			if($save)
			{
				$this->Flash->success(__('The Banner has been saved.'));
				//return $this->redirect(['action' => 'login']);
			}
			else
				{
					$this->Flash->error(__('Unable to add the user.'));
				}
			 }
			}
			 else
					{
						$this->Flash->error(__('Please select the file.'));
					}
			}
		 }
		 $this->set('bannerlist',$bannerlist);
		 
	}
	
	public function updateBanner($id)
	{
		 $this->viewBuilder()->layout('admin');
		 $BannerTable = TableRegistry::get('Banner');	
		 $updateBanner = $BannerTable->get($id);
		
		if($this->request->is('post'))
		 {
			$data = $this->request->getData();	
				//echo "<pre>";print_r($data);die;
			$rand_img = rand(10,100);
			$fileName = $data['banner_image']['name'];
			$file_tempname = $data['banner_image']['tmp_name'];
			$uploadPath = 'img/banner/';			
			if($fileName) {
			$fileName = $rand_img.$data['banner_image']['name'];
			$uploadFile = $uploadPath.$fileName;			 
			$upload_file = move_uploaded_file($file_tempname,$uploadFile);
			if($upload_file) {
			$date_time = date("Y-m-d H:i:s");			   
			$updateBanner->slide_title = $data['slide_title'];
			$updateBanner->slide_subtitle = $data['slide_subtitle'];
			$updateBanner->slide_desc = $data['slide_desc'];
			$updateBanner->img_name = $fileName;			  
			$updateBanner->modified = $date_time;

			$save = $BannerTable->save($updateBanner);
			if($save)
			{
				//$this->Flash->success(__('The Banner has been updated.'));
				$email = new Email();
				//$email->template('resetpw');
				//$email->emailFormat('both');
				$email->from('jeetendra@bytecodetechnologies.in');
				$email->to('sanjay@bytecodetechnologies.in');
				$email->subject('Reset your password');
				//$email->viewVars(['url' => $url, 'username' => $user->username]);
				if ($email->send()) {
					$this->Flash->success(__('Check your email for your reset password link'));
				} else {
					$this->Flash->error(__('Error sending email: ') . $email->smtpError);
					//return $this->redirect('/addbanner');
				}
				
			}
			else
				{
					$this->Flash->error(__('Unable to update the banner.'));
				}
			 }
			}
			 else
			{
				$date_time = date("Y-m-d H:i:s");			   
				$updateBanner->slide_title = $data['slide_title'];
				$updateBanner->slide_subtitle = $data['slide_subtitle'];
				$updateBanner->slide_desc = $data['slide_desc'];						  
				$updateBanner->modified = $date_time;

				$save = $BannerTable->save($updateBanner);
				if($save)
				{
					$this->Flash->success(__('The Banner has been updated.'));
					return $this->redirect('/addbanner');
				}
				else
				{
					$this->Flash->error(__('Unable to update the banner.'));
				}
			
			}
					
					
		 }
		 
		$this->set('banner',$updateBanner);
	}
	
	public function deleteBanner($id)
	{
		 $BannerTable = TableRegistry::get('Banner');	
		 $Banner = $BannerTable->get($id);
		 //$delete = $this->Users->delete($user);
		  $delete = $BannerTable->delete($Banner);
		 if ($delete) {
			
				$this->redirect('/addbanner');
				$this->Flash->success(__('Banner has been deleted.'));
		}
		else{
			$this->Flash->error(__('Unable to delete your banner.'));
		}
	}
	
	public function addFeatures()
	{
		 $this->viewBuilder()->layout('admin');		 		
		 
		 $featuresTable = TableRegistry::get('Features');
		 $features = $featuresTable->newEntity();
		 //$featureslist = $featuresTable->find('all')->order('Features.id', 'DESC');
		 $featureslist = $featuresTable->find('all', ['order' => ['Features.id' => 'DESC']]);
		 if($this->request->is('post'))
		 {
			$data = $this->request->getData();	
			//echo"<pre>";print_r($data);die;
			$date_time = date("Y-m-d H:i:s");			   
			$features->title = $data['features_title'];
			$features->description = $data['features_desc'];					  
			$features->created = $date_time;

			$save = $featuresTable->save($features);
			if($save)
			{
				$this->Flash->success(__('The features has been saved.'));
				//return $this->redirect(['action' => 'login']);
			}
			else
				{
					$this->Flash->error(__('Unable to add the features.'));
				}								
		 }
		 $this->set('featureslist',$featureslist);
	}
	
	public function updateFeatures($id)
	{
		 $this->viewBuilder()->layout('admin');		 		
		 
		 $featuresTable = TableRegistry::get('Features');
		 $features = $featuresTable->get($id);
		// echo "<pre>";print_r($features);die;
		 if($this->request->is('post'))
		 {
			$data = $this->request->getData();	
			//echo"<pre>";print_r($data);die;
			$date_time = date("Y-m-d H:i:s");			   
			$features->title = $data['features_title'];
			$features->description = $data['features_desc'];					  
			$features->modified = $date_time;

			$save = $featuresTable->save($features);
			if($save)
			{
				$this->Flash->success(__('The features has been updated.'));
				$this->redirect('/addfeatures');
			}
			else
				{
					$this->redirect('/addfeatures');
					$this->Flash->error(__('Unable to update the features.'));
				}								
		 }
			$this->set('features' , $features);
	}
	public function deleteFeatures($id)
	{
		 $featuresTable = TableRegistry::get('Features');	
		 $features = $featuresTable->get($id);		
		 $delete = $featuresTable->delete($features);
		 if ($delete) {			
				$this->redirect('/addfeatures');
				$this->Flash->success(__('Features has been deleted.'));
		}
		else{
			$this->Flash->error(__('Unable to delete your features.'));
		}
	}

}