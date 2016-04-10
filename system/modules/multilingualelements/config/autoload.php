<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package  	 MultiLingualElements
 * @author   	 Arne Stappen
 * @license  	 LGPL-3.0+ 
 * @copyright	 Arne Stappen 2015
 */
 


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'Contao\MultiLanguageFE' => 'system/modules/multilingualelements/classes/MultiLanguage.php',
	'Contao\MultiLanguageBE' => 'system/modules/multilingualelements/classes/MultiLanguage.php'

));

