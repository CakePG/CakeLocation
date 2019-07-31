<?php
namespace CakePG\CakeLocation\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class EmploymentsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');

        $this->belongsToMany('Locations', [
            'className' => 'CakePG/CakeLocation.Locations',
            'joinTable' => 'locations_employments',
            'sort' => ['Locations.priority' => 'asc']
        ]);
        // search
        $this->addBehavior('Search.Search');
        $this->searchManager()
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => [
                    'name'
                ]
            ]);
    }

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->allowEmpty('name')
            ->maxLength('name', 60, '60字以内で入力して下さい。');
    }
}
