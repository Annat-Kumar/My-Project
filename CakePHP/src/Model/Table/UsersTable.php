<?php 
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;
use Cake\ORM\RulesChecker;

class UsersTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('role', 'A role is required')
			->notEmpty('email', 'Email is required')
            ->notEmpty('phone', 'Phone is required')
			->add('phone', [
            'length' => [
            'rule' => ['minLength', 10],
            'message' => 'Phone need to be at least 10 characters long',
			]
            ])
			
			->numeric('phone','Please, enter valid phone number !')   
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'user']],
                'message' => 'Please enter a valid role'
            ]);
			
			  
			return $validator ;
    }
	
	public function buildRules(RulesChecker $rules)
    {

        $rules->add($rules->isUnique(['email']));
		$rules->add($rules->isUnique(['phone']));
		$rules->add($rules->isUnique(['username']));
		return $rules;
    }


}

?>