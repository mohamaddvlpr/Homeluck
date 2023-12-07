<?php

namespace Web\Model;

use Web\Model\Model;
use Web\Entities\HomeEntity;

class Home extends Model{
    protected $FileName = 'home';
    protected $entityClass = HomeEntity::class;
}