<?php
return array (
  'volunteer' => 
  array (
    'type' => 2,
    'description' => 'Volunteers',
    'bizRule' => 'return Yii::app()->user->hasRole($role_id)',
    'data' => NULL,
  ),
  'manager' => 
  array (
    'type' => 2,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
      0 => 'volunteer',
    ),
  ),
  'admin' => 
  array (
    'type' => 2,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
  ),
);
