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
        $filename = is_array($this->file1) ? $this->getOriginal('file1') : $this->file1;
        $img = file_get_contents($this->dir1.$filename);
        return 'data:'.$this->type1.';base64,'.base64_encode($img);
    }
    protected function _getFile1AssetUrl()
    {
        $filename = is_array($this->file1) ? $this->getOriginal('file1') : $this->file1;
        return $this->dir1 ? ASSETS.str_replace(STORAGE, '', $this->dir1.$filename) : null;
    }

    protected function _getFile2Base64()
    {
        $filename = is_array($this->file2) ? $this->getOriginal('file2') : $this->file2;
        $img = file_get_contents($this->dir2.$filename);
        return 'data:'.$this->type2.';base64,'.base64_encode($img);
    }
    protected function _getFile2AssetUrl()
    {
        $filename = is_array($this->file2) ? $this->getOriginal('file2') : $this->file2;
        return $this->dir2 ? ASSETS.str_replace(STORAGE, '', $this->dir2.$filename) : null;
    }
}
