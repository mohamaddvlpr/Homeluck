<?php

namespace Web\Model;

use Web\Entities\SettingEntity;

class Setting extends Model{
    protected $FileName = 'setting';
    protected $entityClass = SettingEntity::class;
}