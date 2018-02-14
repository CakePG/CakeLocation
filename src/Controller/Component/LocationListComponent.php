<?php
namespace CakePG\CakeLocation\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;

class LocationListComponent extends Component
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->controler = $this->_registry->getController();
    }

    public function getLocations()
    {
        $this->controler->loadModel('CakePG/CakeLocation.Locations');
        $limit = Configure::read('CakeLocation.limit');
        return $this->controler->Locations->find('all' , [
            'order' => ['priority' => 'asc'],
            'limit' => $limit
        ]);
    }
}
