<?php
namespace CakePG\CakeLocation\Controller\Admin;

use Cake\Datasource\ConnectionManager;
use Cake\Core\Configure;
use Cake\Event\Event;
use CakePG\CakeLocation\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

class EmploymentsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
        $this->set('locations', $this->Employments->Locations->find('list', ['valueField' => 'name', 'order' => ['priority' => 'asc']]));
    }

    public function index()
    {
        $employments = $this->paginate($this->Employments, [
            'order' => ['id' => 'asc'],
            'contain' => ['Locations'],
            'finder' => [
                'search' => ['search' => $this->request->query]
            ]
        ]);
        $this->set(compact('employments'));
        $this->set('_serialize', ['employments']);
    }

    public function view($id = null)
    {
        $employment = $this->Employments->get($id, ['contain' => ['Locations']]);
        $this->set(compact('employment'));
        $this->set('_serialize', ['employment']);
    }

    public function edit($id = null)
    {
        $employment = $this->Employments->get($id, ['contain' => ['Locations']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employment = $this->Employments->patchEntity($employment, $this->request->data, ['associated' => ['Locations']]);
            if ($this->Employments->save($employment)) {
                $this->Flash->success(__d('CakeLocation', 'Location Employment').'を設定しました');
                return $this->redirect(['action' => 'view', $id]+$this->request->query());
            }
            $this->Flash->error(__d('CakeLocation', 'Location Employment').'の設定に失敗しました。もう一度お試しください');
        }
        $this->set(compact('employment'));
        $this->set('_serialize', ['employment']);
    }
}
