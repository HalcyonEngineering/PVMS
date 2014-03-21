<?php
return array (
  'Volunteer' => 
  array (
    'type' => 2,
    'description' => 'Volunteers',
    'bizRule' => 'return Yii::app()->user->hasRole($params{\'role_id\']);',
    'data' => NULL,
  ),
  'Manager' => 
  array (
    'type' => 2,
    'description' => 'Managers',
    'bizRule' => 'return true;',
    'data' => NULL,
    'children' => 
    array (
      0 => 'Volunteer',
    ),
  ),
  'Admin' => 
  array (
    'type' => 2,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
);
