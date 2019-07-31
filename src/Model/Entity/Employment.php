<?php
namespace CakePG\CakeLocation\Model\Entity;

use Cake\ORM\Entity;

class Employment extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
