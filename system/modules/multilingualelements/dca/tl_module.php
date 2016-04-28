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


 
// add the language select field to all content elements
$GLOBALS['TL_DCA']['tl_module']['config']['onload_callback'][] = array('MultiLanguageModule', 'addLangMOD');

// adjust the type field
$GLOBALS['TL_DCA']['tl_module']['fields']['name']['eval']['tl_class'] = 'w50';


// Language field
$GLOBALS['TL_DCA']['tl_module']['fields']['language'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['language'],
	'inputType'               => 'text',
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(10) NOT NULL default ''"
);


// some classes
class MultiLanguageModule extends tl_module
{
	/**
	 * Add language field
	 */
	public function addLangMOD()
	{
		foreach ($GLOBALS['TL_DCA']['tl_module']['palettes'] as &$strPalette)
		{
			$strPalette = str_replace(',name', ',name,language', $strPalette);
		}
	}	

}

