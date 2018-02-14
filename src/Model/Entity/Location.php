<?php
namespace CakePG\CakeLocation\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;

class Location extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

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
