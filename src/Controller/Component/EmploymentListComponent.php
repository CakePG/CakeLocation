<?php
namespace CakePG\CakeLocation\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\I18n\Time;

class EmploymentListComponent extends Component
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->controler = $this->_registry->getController();
    }

    public function getEmployments()
    {
        $this->controler->loadModel('CakePG/CakeLocation.Employments');
        $contain = ['Locations'];
        return $this->controler->Employments->find('all' , [
            'order' => ['id' => 'asc'],
            'contain' => $contain
        ]);
    }

    public function getEmployment($id = null)
    {
        $this->controler->loadModel('CakePG/CakeLocation.Employments');
        $contain = ['Locations'];
        return $this->controler->Employments->get($id, [
          'contain' => $contain
        ]);
    }
}
