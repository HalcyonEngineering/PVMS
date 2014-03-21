<?php
return array (
  'Volunteer' => 
  array (
    'type' => 2,
    'description' => 'Volunteer',
    'bizRule' => 'return Yii::app()->user->hasRole($params{\'role_id\']);',
    'data' => NULL,
  ),
  'Manager' => 
  array (
    'type' => 2,
    'description' => 'Manager',
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
