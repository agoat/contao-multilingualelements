<?php

 /**
 * Contao Open Source CMS - MultiLingualElements extension
 *
 * Copyright (c) 2015-2016 Arne Stappen (aGoat)
 *
 *
 * @package   contentblocks
 * @author    Arne Stappen <http://agoat.de>
 * @license	  LGPL-3.0+
 */




/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'Contao\MultiLanguageFE' => 'system/modules/multilingualelements/classes/MultiLanguage.php',
	'Contao\MultiLanguageBE' => 'system/modules/multilingualelements/classes/MultiLanguage.php'

));

