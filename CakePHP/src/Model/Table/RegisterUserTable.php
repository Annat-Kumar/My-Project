<?php 
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class RegisterUserTable extends Table
{
	
	 public function initialize(array $config)
    {
        //$this->setTable('users_hk');

        // Prior to 3.4.0
        $this->table('users_hk');
    }
	
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('role', 'A role is required')
			->notEmpty('email', 'Email is required')
            ->notEmpty('phone', 'Phone is required')
			->numeric('phone','Please, enter valid phone number !')   
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'author']],
                'message' => 'Please enter a valid role'
            ]);
			  
			return $validator ;
    }

}

?>