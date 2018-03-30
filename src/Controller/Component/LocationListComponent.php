<?php
namespace CakePG\CakeLocation\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\I18n\Time;

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
        $contain = [];
        if (Configure::read('CakeLocation.use_flyer')) {
            $contain = ['Flyers'=> function ($q) {
              return $q->where(['Flyers.opened_at <=' => Time::now(), 'Flyers.closed_at >' => Time::now()])->order(['closed_at' => 'ASC']);
            }];
        }
        return $this->controler->Locations->find('all' , [
            'order' => ['priority' => 'asc'],
            'contain' => $contain,
            'limit' => $limit
        ]);
    }
}
