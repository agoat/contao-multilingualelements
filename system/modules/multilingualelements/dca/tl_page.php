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
 * Page
 */

$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'fallback';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['fallback'] = 'altLanguages';


$GLOBALS['TL_DCA']['tl_page']['fields']['fallback']['eval'] = array('submitOnChange'=>true, 'doNotCopy'=>true, 'tl_class'=>'w50 m12');

// Language field
$GLOBALS['TL_DCA']['tl_page']['fields']['altLanguages'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['altLanguages'],
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>255, 'tl_class'=>'long'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
