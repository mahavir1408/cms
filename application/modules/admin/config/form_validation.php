<?php
$config = array(    
    'userlogin'=>array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|valid_email|callback_userLogin'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            )
        ),
	'category'=>array(
            array(
                'field' => 'display_name',
                'label' => 'Display name',
                'rules' => 'required'
            ),
            array(
                'field' => 'uri',
                'label' => 'URI',
                'rules' => 'required'
            )
        )
);