<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Trang quản lý thành viên Passion Investment',

	// preloading 'log' component
	'preload'=>array('log'),
     'defaultController' => 'Login', 
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.models.base.*',
		'application.components.*',
		'application.extensions.ckeditor.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'dunghoi??',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		 
		 'piadmin'=>array(
              'defaultController' => 'Login',
		 ),
		
	),
	// application components
	'components'=>array(

		// 'user'=>array(
		// 	// enable cookie-based authentication
		// 	'allowAutoLogin'=>true,
		// ),

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
             // 'urlSuffix'=>'.html',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			//'errorAction'=>'Home/err',
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
        /*'Smtpmail'=>array(
            'class'=>'application.extensions.smtpmail.PHPMailer',
            'Host'=>"localhost",
            'Username'=>'',
            'Password'=>'',
            'Mailer'=>'smtp',
            'Port'=>25,
            'SMTPSecure'=>'none',
            'SMTPAuth'=>'0', 
        ),*/
        'Smtpmail'=>array(
            'class'=>'application.extensions.smtpmail.PHPMailer',
            'Host'=>"host01.emailserver.vn",
            'Username'=>'tuvan@pif.vn',
            'Password'=>'ZFi{NfM-V2sN',
            'Mailer'=>'smtp',
            'Port'=>465,
            'SMTPSecure'=>'ssl',
            'SMTPAuth'=>true, 
        ),
		'session' => array(
		             // 'class' => 'CDbHttpSession',
                        'timeout' => 20059200
		   
         ),
		'ePdf' => array( 
			 'class'         => 'ext.yii-pdf.EYiiPdf',
			  'params'        => array( 
			  	  'mpdf'     => array(
			  	  	  'librarySourcePath' => 'application.vendors.mpdf.*',
			  	  	   'constants'         => array( 
			  	  	   	  '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
			  	  	   	),
			  	  	   'class'=>'mpdf',
 
			  	  	),
			  	   'HTML2PDF' => array( 
			  	   	 'librarySourcePath' => 'application.vendors.html2pdf.*',
			  	   	 'classFile'         => 'html2pdf.class.php', // For adding to 
			  	   	),
			  	)
			)
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'pager'=>30,
	),
);
