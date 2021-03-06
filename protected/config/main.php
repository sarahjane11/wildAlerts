<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'Wild-Alerts',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
		'application.components.bootstrap.*',
		
	),
	
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'admin',
                'api',
                'user',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1234',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
                'import'=>array(
                    'class'=>'ext.import.ImportModule',
                    'onAfterImport' => array('ImportEvent', 'onAfterImport'),
                    'onBeforeShowForm' => array('ImportEvent', 'onBeforeShowForm'),

               ),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
                    //for email
                 'email' => array(
                    'class' => 'application.extensions.email.Email',
                    'delivery' => 'php', //Will use the php mailing function.
                //May also be set to 'debug' to instead dump the contents of the email into the view
                ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                         'showScriptName' => false,
			'rules'=>array(
//                               'api/login'=>'api/default/login',
//                                'api/register'=>'api/default/signup',
                                     // REST patterns
                                
                                array('api/default/login', 'pattern'=>'api/login', 'verb'=>'POST'),
                                array('api/default/signup', 'pattern'=>'api/register', 'verb'=>'POST'),
                                array('api/default/checkemail', 'pattern'=>'api/checkemail', 'verb'=>'POST'),
                                array('api/default/changepassword', 'pattern'=>'api/changepassword', 'verb'=>'POST'),
                                array('api/default/oldpassword', 'pattern'=>'api/oldpassword', 'verb'=>'POST'),
                                array('api/default/checkemail', 'pattern'=>'api/checkemail', 'verb'=>'POST'),
                                array('api/default/resetpassword', 'pattern'=>'api/resetpassword', 'verb'=>'POST'),
                                array('api/default/appverification', 'pattern'=>'api/verification', 'verb'=>'GET'),
                                array('api/threatlevels/threatlist', 'pattern'=>'api/threat/list', 'verb'=>'GET'),
                                array('api/categories/categorieslist', 'pattern'=>'api/categories/list', 'verb'=>'GET'),
                                array('api/animals/animalslist', 'pattern'=>'api/animals/list', 'verb'=>'GET'),
                                array('api/Wildalertposts/wildalertpostslist', 'pattern'=>'api/spotting/list', 'verb'=>'GET'),
                                array('api/Wildalertposts/wildalertposts', 'pattern'=>'api/spotting/add', 'verb'=>'POST'),
                                array('api/userlocations/update', 'pattern'=>'api/location/update', 'verb'=>'POST'),
                                array('api/userlocations/locationdelete', 'pattern'=>'api/locationdelete', 'verb'=>'POST'),
                                array('api/userlocations/location', 'pattern'=>'api/location', 'verb'=>'GET'),
                                array('api/userlocations/currentlocation', 'pattern'=>'api/currentlocation', 'verb'=>'POST'),
                                array('api/notification/notificationsetting', 'pattern'=>'api/notificationsetting', 'verb'=>'POST'),
                                array('api/notification/notification', 'pattern'=>'api/notification', 'verb'=>'GET'),
                                array('api/notification/getsetting', 'pattern'=>'api/getsetting', 'verb'=>'GET'),
                                //array('api/notification/notsetting', 'pattern'=>'api/notsetting', 'verb'=>'POST'),
                                array('api/notification/getanimalimage', 'pattern'=>'api/getanimalimage', 'verb'=>'GET'),
                                //socail share api
                                array('api/socailshare/sharelink', 'pattern'=>'api/sharelink' , 'verb'=>'POST'),
                            
                                
                               
                   
                            
                                // Other controllers
                                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		), 
		
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/wildalerts.sql',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=wildalerts',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
               // 'clientScript' => array('scriptMap' => array('jquery.js' => false, )),
            
            'clientScript'=>array(
                'packages'=>array(
                     'jquery'=>array(
                            'baseUrl'=>BASE_PATH.'/themes/wildalerts/bower_components/jquery/dist/',
                            'js'=>array('jquery.min.js')
                         )                                       
                    )
            ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'amitgpt773@gmail.com',
	),
	'theme' => 'wildalerts',
);
