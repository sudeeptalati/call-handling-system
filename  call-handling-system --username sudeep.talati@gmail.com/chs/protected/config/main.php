<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'UK Whitegoods',
	'defaultController'=>'servicecall/freeSearch',
	
		

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.yii-mail.*',
		'application.extensions.yii-zip.*',
		'application.extensions.yii-RGridView.*',
		//'application.extensions.*',

		'application.vendors.*',
		),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'chs',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
			
			'ePdf' => array(
					'class'         => 'ext.yii-pdf.EYiiPdf',
					'params'        => array(
							'mPDF'     => array(
									'librarySourcePath' => 'application.vendors.mpdf.*',
									'constants'         => array(
											'_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
									),
									'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
									/*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
											'mode'              => '', //  This parameter specifies the mode of the new document.
											'format'            => 'A4', // format A4, A5, ...
											'default_font_size' => 0, // Sets the default document font size in points (pt)
											'default_font'      => '', // Sets the default font-family for the new document.
											'mgl'               => 15, // margin_left. Sets the page margins for the new document.
											'mgr'               => 15, // margin_right
											'mgt'               => 16, // margin_top
											'mgb'               => 16, // margin_bottom
											'mgh'               => 9, // margin_header
											'mgf'               => 9, // margin_footer
											'orientation'       => 'P', // landscape or portrait orientation
									)*/
							),

				'HTML2PDF' => array(
									'librarySourcePath' => 'application.vendors.html2pdf.*',
											'classFile'         => 'html2pdf.class.php', // For adding to Yii::classMap
											/*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
													'orientation' => 'P', // landscape or portrait orientation
													'format'      => 'A4', // format A4, A5, ...
													'language'    => 'en', // language: fr, en, it ...
													'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
													'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
													'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
											)*/
									),
								),
							),

			/*
			 *MAIL CONFIGURATION 
			 */
					
			'mail' => array(
		        'class' => 'application.extensions.yii-mail.YiiMail',
		        'transportType'=>'smtp', /// case sensitive!
		        'transportOptions'=>array(
		            'host'=>'mail.laser.com',
		            'username'=>'stalati@ukwhitegoods.co.uk',
		            // or email@googleappsdomain.com
		            'password'=>'#rev1s1on',
		            'port'=>'543',
		            //'encryption'=>'ssl',
		            ),
		        'viewPath' => 'application.views.mail',
		        'logging' => true,
		        'dryRun' => false
		    ),	
			
			
			
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			),
			

		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				//accessing gii.
				'gii'=>'gii',
            	'gii/<controller:\w+>'=>'gii/<controller>',
            	'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
				//ACCESSING OTHER CONTROLLERS.
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				//FOR ACCESSING FREESEARCH.
				'<controller:\w+>/<action:\w+>/<keyword:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/chs.db',
		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
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
		
	),//end of components.

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'stalati@ukwhitegoods.co.uk',
		'company_name'=>'UK Whitegoods',
		'company_address'=>'Kilmarnock',
		'company_contact_details'=>'Telephone:321321312 Fax:23132231 E-mail:stalati@ukwhitegoods.co.uk',
		'vat_in_percentage'=>'20%',	
		'software_version'=>'0.5beta',	

	),

);