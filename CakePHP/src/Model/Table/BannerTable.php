<?php 
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;
use Cake\ORM\RulesChecker;

class BannerTable extends Table
{
	public function initialize(array $config)
    {
        $this->table('banner');
    }
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('slide_title', 'Slide Title is required')
            ->notEmpty('slide_subtitle', 'Slide Subtitle is required')
            ->notEmpty('slide_desc', 'Slide Desc is required')			
            ->notEmpty('banner_image', 'Banner Image is required')			
			;
			
			  
			return $validator ;
    }
	
	


}

?>