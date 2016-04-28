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
	/**
	 * Add language field
	 */
	public function addLangCE()
	{
		foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as &$strPalette)
		{
			$strPalette = str_replace(',type', ',type,language', $strPalette);
		}
	}

	/**
	 * Add language label to content element type
	 */

	public function addLabeltoElement($arrRow)
	{
		// Check if ContentBlock extension is loaded
		if (in_array('Contao\ContentBlocks', array_flip(ClassLoader::getClasses())))
		{
			$strElement = \tl_content_element::addCteType($arrRow);
		}
		else
		{
			$strElement = \tl_content::addCteType($arrRow);
		}
		
		
		if ($arrRow['language'])
		{
			$arrElement = explode('</div>', $strElement);
			$arrElement[0] = $arrElement[0].'<span style="color:#888888;"> - '.$arrRow['language'].'</span>';
			$strElement = implode('</div>',$arrElement);
		}
		return $strElement;
	}	
}

