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
 


// add the language select field to all content elements
$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('MultiLanguageContent', 'addLangCE');

// adjust the type field
$GLOBALS['TL_DCA']['tl_content']['fields']['type']['eval']['tl_class'] = 'w50';


// collect all languages when saving to database
$GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = array('MultiLanguageBE', 'CollectLanguages');

// add language to elements name
$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['child_record_callback'] = array('MultiLanguageContent', 'addLabeltoElement');


// Language field
$GLOBALS['TL_DCA']['tl_content']['fields']['language'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['language'],
	'inputType'               => 'text',
	'filter'                  => true,
	'eval'                    => array('tl_class'=>'w50'),
	'save_callback'			  => array('MultiLanguageBE', 'CollectLanguagesCE'),
	'sql'                     => "varchar(10) NOT NULL default ''"
);


// some classes
class MultiLanguageContent extends tl_content
{

	public function addLangCE()
	{
		foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as &$strPalette)
		{
			$strPalette = str_replace(',type', ',type,language', $strPalette);
		}
	}

	public function addLabeltoElement($arrRow)
	{
		$strElement = parent::addCteType($arrRow);
		if ($arrRow['language'])
		{
			$arrElement = explode('</div>', $strElement);
			$arrElement[0] = $arrElement[0].'<span style="color:#888888;"> - '.$arrRow['language'].'</span>';
			$strElement = implode('</div>',$arrElement);
		}
		return $strElement;
	}	
}

