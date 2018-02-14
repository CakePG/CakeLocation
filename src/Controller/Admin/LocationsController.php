<?php
namespace CakePG\CakeLocation\Controller\Admin;

use Cake\Datasource\ConnectionManager;
use Cake\Core\Configure;
use Cake\Event\Event;
use CakePG\CakeLocation\Controller\AppController;

class LocationsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->set('limit', Configure::read('CakeLocation.limit'));
        $this->set('fixedNum', Configure::read('CakeLocation.fixed_num'));
        $this->set('enables', Configure::read('CakeLocation.enables'));
    }

    public function index()
    {
        $locations = $this->paginate($this->Locations, [
            'order' => ['priority' => 'asc'],
            'finder' => [
                'search' => ['search' => $this->request->query]
            ]
        ]);
        $this->set(compact('locations'));
        $this->set('_serialize', ['locations']);
    }

    public function view($id = null)
    {
        $location = $this->Locations->get($id);
        $this->set(compact('location'));
        $this->set('_serialize', ['location']);
    }

    public function add()
    {
        // 登録制限
        if (Configure::read('CakeLocation.fixed_num') || (Configure::read('CakeLocation.limit') && Configure::read('CakeLocation.limit') <= $this->Locations->find('all')->count())) {
            $this->Flash->error(__d('CakeLocation', 'Location').'はこれ以上登録できません');
            return $this->redirect(['action' => 'index']+$this->request->query());
        }
        $location = $this->Locations->newEntity();
        if ($this->request->is('post')) {
            $priority = $this->Locations->find('all')->count();
            $location = $this->Locations->patchEntity($location, $this->request->data + ['priority' => $priority]);
            if ($this->Locations->save($location)) {
                // ソート処理
                $orders = array_values($this->Locations->find('list', ['valueField' => 'id', 'order' => ['priority' => 'asc']])->toArray());
                $this->Locations->sortPriority($orders);
                $this->Flash->success(__d('CakeLocation', 'Location').'を登録しました');
                return $this->redirect(['action' => 'view', $location->id]+$this->request->query());
            }
            $this->Flash->error(__d('CakeLocation', 'Location').'の登録に失敗しました。もう一度お試しください');
        }
        $this->set(compact('location'));
        $this->set('_serialize', ['location']);
    }

    public function edit($id = null)
    {
        $location = $this->Locations->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $location = $this->Locations->patchEntity($location, $this->request->data);
            if ($this->Locations->save($location)) {
                $this->Flash->success(__d('CakeLocation', 'Location').'を編集しました');
                return $this->redirect(['action' => 'view', $id]+$this->request->query());
            }
            $this->Flash->error(__d('CakeLocation', 'Location').'の編集に失敗しました。もう一度お試しください');
        }
        $this->set(compact('location'));
        $this->set('_serialize', ['location']);
    }

    public function delete($id = null)
    {
        // 固定
        if (Configure::read('CakeLocation.fixed_num')) {
            $this->Flash->error(__d('CakeLocation', 'Location').'は固定です');
            return $this->redirect(['action' => 'index']+$this->request->query());
        }
        $this->request->allowMethod(['post', 'delete']);
        $location = $this->Locations->get($id);
        try {
          if ($this->Locations->delete($location)) {
              // ソート処理
              $orders = array_values($this->Locations->find('list', ['valueField' => 'id', 'order' => ['priority' => 'asc']])->toArray());
              $this->Locations->sortPriority($orders);
              $this->Flash->success(__d('CakeLocation', 'Location').'を削除しました');
          } else {
              $this->Flash->error(__d('CakeLocation', 'Location').'の削除に失敗しました。もう一度お試しください');
          }
        } catch (\Exception $e) {
          if (strpos($e->getMessage(), '1451 Cannot delete or update a parent row') !== false) {
            $this->Flash->error(__d('CakeLocation', 'Location').'に'.__d('CakeLocation', 'Location').'が存在するため削除できません');
          } else {
            $this->Flash->error("不明なエラーが発生しました");
          }
        }
        return $this->redirect(['action' => 'index']+$this->request->query());
    }

    // 並び替え
    public function sort()
    {
        // 固定
        if (Configure::read('CakeLocation.fixed_num')) {
            $this->Flash->error(__d('CakeLocation', 'Location').'は固定です');
            return $this->redirect(['action' => 'index']+$this->request->query());
        }
        $locations = $this->Locations->find('all', ['order' => ['priority' => 'asc']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orders = explode(',',$this->request->data['orders']);
            if ($this->Locations->sortPriority($orders)) {
                $this->Flash->success(__d('CakeLocation', 'Location').'の順序を変更しました');
                return $this->redirect(['action' => 'index']+$this->request->query());
            } else {
                $this->Flash->error(__d('CakeLocation', 'Location').'の順序の変更に失敗しました。もう一度お試しください');
            }
        }
        $this->set(compact('locations'));
        $this->set('_serialize', ['locations']);
    }
}
