<?php 
$msg ="send mail with SMTP server on localhost";
				$email = new Email('default');
			$email
            ->transport('gmail')
            ->from('jeetendra@bytecodetechnologies.in')
            ->to('sanjay@bytecodetechnologies.in')
            ->subject('Reset your password')
             ->emailFormat('html')
            ->viewVars(array('msg' => $msg))
            //->send($msg)
			; 
				
				if ($email->send($msg)) {
					$this->Flash->success(__('Check your email for your reset password link'));
				} else {
					$this->Flash->error(__('Error sending email: ') . $email->smtpError);
				}
				
// -------------------------------------------
// Sample SMTP configuration.
				Email::configTransport('gmail', [
					'host' => 'ssl://smtp.gmail.com',
					'port' => 465,
					'username' => 'sanjay.bytecode@gmail.com',
					'password' => 'sanjay@123',
					'className' => 'Smtp'
				]);*/

				$email = new Email();
				 $email->transport('gmail');
				//$email->template('resetpw');
				//$email->emailFormat('both');
				$email->from('jeetendra@bytecodetechnologies.in');
				$email->to('sanjay@bytecodetechnologies.in');
				$email->subject('Reset your password testing');
				 $email->emailFormat('html');
				 $email->viewVars(array('msg' => $msg));
				//$email->viewVars(['url' => $url, 'username' => $user->username]);
				if ($email->send($msg)) {
					$this->Flash->success(__('Check your email for your reset password link'));
				} else {
					$this->Flash->error(__('Error sending email: ') . $email->smtpError);
				}
				/**/
----------------------------------------------------------
forgot password in php

https://phppot.com/php/php-forgot-password-recover-code/
https://www.codexworld.com/login-system-forgot-password-recovery-email-php-mysql/

forgot password in cakephp 3

http://www.naidim.org/cakephp-3-tutorial-9-reset-password
https://github.com/hunzinker/CakePHP-Auth-Forgot-Password/blob/master/controllers/users_controller.php
http://findnerd.com/list/view/Forgot-Password-And-Reset-Password-In-CakePHP/17099/

http://thecoderain.blogspot.in/2016/05/send-mail-using-mail-class-in-cakephp-3.html