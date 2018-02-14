<?php
namespace CakePG\CakeLocation\Controller;

use App\Controller\AppController as BaseController;
use Cake\Core\Configure;
use Cake\Event\Event;

class AppController extends BaseController
{
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->set('dashboardPath', Configure::read('CakeLocation.dashboard_path'));
    }
}
