<?php
namespace CakePG\CakeLocation\Controller\Admin;

use Cake\Datasource\ConnectionManager;
use Cake\Core\Configure;
use Cake\Event\Event;
use CakePG\CakeLocation\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

class FlyersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
        $this->set('locations', $this->Flyers->Locations->find('list', ['valueField' => 'name', 'order' => ['priority' => 'asc']]));
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        if (!Configure::read('CakeLocation.use_flyer')) {
          throw new NotFoundException(__('404 not found'));
        }
    }

    public function index()
    {
        $flyers = $this->paginate($this->Flyers, [
            'order' => ['closed_at' => 'desc'],
            'finder' => [
                'search' => ['search' => $this->request->query]
            ]
        ]);
        $this->set(compact('flyers'));
        $this->set('_serialize', ['flyers']);
    }

    public function view($id = null)
    {
        $flyer = $this->Flyers->get($id, ['contain' => ['Locations']]);
        $this->set(compact('flyer'));
        $this->set('_serialize', ['flyer']);
    }

    public function add()
    {
        $flyer = $this->Flyers->newEntity();
        if ($this->request->is('post')) {
            $priority = $this->Flyers->find('all')->count();
            $flyer = $this->Flyers->patchEntity($flyer, $this->request->data, ['associated' => ['Locations']]);
            if ($this->Flyers->save($flyer)) {
                $this->Flash->success(__d('CakeLocation', 'Location Flyer').'を登録しました');
                return $this->redirect(['action' => 'view', $flyer->id]+$this->request->query());
            }
            $this->Flash->error(__d('CakeLocation', 'Location Flyer').'の登録に失敗しました。もう一度お試しください');
        }
        $this->set(compact('flyer'));
        $this->set('_serialize', ['flyer']);
    }

    public function edit($id = null)
    {
        $flyer = $this->Flyers->get($id, ['contain' => ['Locations']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $flyer = $this->Flyers->patchEntity($flyer, $this->request->data, ['associated' => ['Locations']]);
            if ($this->Flyers->save($flyer)) {
                $this->Flash->success(__d('CakeLocation', 'Location Flyer').'を編集しました');
                return $this->redirect(['action' => 'view', $id]+$this->request->query());
            }
            $this->Flash->error(__d('CakeLocation', 'Location Flyer').'の編集に失敗しました。もう一度お試しください');
        }
        $this->set(compact('flyer'));
        $this->set('_serialize', ['flyer']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $flyer = $this->Flyers->get($id);
        try {
          if ($this->Flyers->delete($flyer)) {
              $this->Flash->success(__d('CakeLocation', 'Location Flyer').'を削除しました');
          } else {
              $this->Flash->error(__d('CakeLocation', 'Location Flyer').'の削除に失敗しました。もう一度お試しください');
          }
        } catch (\Exception $e) {
          if (strpos($e->getMessage(), '1451 Cannot delete or update a parent row') !== false) {
            $this->Flash->error(__d('CakeLocation', 'Location Flyer').'に'.__d('CakeLocation', 'Location Flyer').'が存在するため削除できません');
          } else {
            $this->Flash->error("不明なエラーが発生しました");
          }
        }
        return $this->redirect(['action' => 'index']+$this->request->query());
    }
}
