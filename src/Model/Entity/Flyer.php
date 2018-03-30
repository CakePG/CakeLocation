<?php
namespace CakePG\CakeLocation\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;
use Cake\I18n\Time;

class Flyer extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    protected function _getOpenPeriod()
    {
        return $this->opened_at->format('Y/m/d H:i').' 〜 '.$this->closed_at->format('Y/m/d H:i');
    }

    protected function _getPublishedMsg()
    {
      if ($this->opened_at > Time::now()) {
        return '<span class="badge badge-warning">公開前</span>';
      } else if ($this->closed_at <= Time::now()) {
        return '<span class="badge badge-danger">終了</span>';
      } else {
        return '<span class="badge badge-success">公開中</span>';
      }
    }

    protected function _getFile1Base64()
    {
        $img = file_get_contents($this->dir1.$this->file1);
        return 'data:'.$this->type1.';base64,'.base64_encode($img);
    }
    protected function _getFile1AssetUrl()
    {
        return $this->dir1 ? ASSETS.str_replace(STORAGE, '', $this->dir1.$this->file1) : null;
    }

    protected function _getFile2Base64()
    {
        $img = file_get_contents($this->dir2.$this->file2);
        return 'data:'.$this->type2.';base64,'.base64_encode($img);
    }
    protected function _getFile2AssetUrl()
    {
        return $this->dir2 ? ASSETS.str_replace(STORAGE, '', $this->dir2.$this->file2) : null;
    }
}
