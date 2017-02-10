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



namespace Contao;


class MultiLanguageFE extends Frontend
{
	/**
	 * Detect and set the language
	 *
	 * @param none
	 *
	 * @return none
	 */
	public function detectAndSetLanguage() 
	{ 

		$objRootPage = \PageModel::findById($GLOBALS['objPage']->rootId);

		// if page have fallback languages
		if ($objRootPage->fallback)
		{
	
			$languages = $objRootPage->language . ',' . $objRootPage->altLanguages;
 		
			// get the first prefered language we can deliver
			foreach(\Environment::get('httpAcceptLanguage') as $strLanguage)
			{
				if (strpos($languages, $strLanguage) !== false)
				{
					$GLOBALS['TL_LANGUAGE'] = $_SESSION['TL_LANGUAGE'] = $strLanguage;
					$GLOBALS['objPage']->language = $strLanguage;
					break;
				}
			}
		
			// Reload the language file in RegularPage.php
			\System::loadLanguageFile('default',$GLOBALS['TL_LANGUAGE'], true);
		}
	}

	/**
	 * Check the elements language
	 *
	 * @param Database_Result $objElement   The database result object from tl_content, tl_module or tl_article
	 * @param boolean         $blnIsVisible The current visibility state
	 *
	 * @return boolean The new visibility state
	 */
	public function checkLanguage($objElement, $blnIsVisible) 
	{ 
		if ($objElement->language && TL_MODE=='FE')
		{
			// Make invisible if elements language don't match
			if ($objElement->language != $GLOBALS['TL_LANGUAGE'])
			{
				$blnIsVisible = false;			
			}
		}
	
		return $blnIsVisible;
	}

}


class MultiLanguageBE extends Backend
{
	/**
	 * Collect the languages from all content elements under a page root
	 *
	 * @param object $dc The DataContainer object
	 *
	 * @return none
	 */
	public function CollectLanguages(DataContainer $dc)
	{
		// Get root page where this element belong to
		$objContent = \ContentModel::findById($dc->id);					  
		$objArticle = \ArticleModel::findById($objContent->pid);					  
		$objPage = \PageModel::findWithDetails($objArticle->pid);
 
		if (!$objPage->rootId) return; // if nothing returned from database

		// get all languages from the content elements from this article as an array
		$arrLanguages = $this->Database->prepare("SELECT id,language FROM tl_content WHERE pid=? AND ptable='tl_article'")
									  ->execute($objContent->pid)
									  ->fetchAllAssoc();
									  
		// load all alternative languages from the root pade into the language collection
		$objAltLanguages = $this->Database->prepare("SELECT altLanguages FROM tl_page WHERE id=?")
									  ->execute($objPage->rootId)
									  ->fetchAllAssoc();
									  
		$arrLanguageCollection = ($objAltLanguages[0]['altLanguages'] != '') ? array_flip(explode(',', $objAltLanguages[0]['altLanguages'])) : array();	
	
		// add missing languages of content elements into the language collection
		foreach($arrLanguages as $elem)
		{
			if ($elem['language'])
			{
				if (!array_key_exists($elem['language'], $arrLanguageCollection))
				{
					$arrLanguageCollection[$elem['language']] = true;
				}
			}
		}

		// remove root page language
		unset($arrLanguageCollection[$objPage->language]);
		
		// make string for database
		if (is_array($arrLanguageCollection))
		{
			$strLanguageCollection = implode(',',array_keys($arrLanguageCollection));
		}
		else
		{
			$strLanguageCollection =  '';
		}
		
		// write to page table
		$objPage = $this->Database->prepare("UPDATE tl_page SET altLanguages=? WHERE id=?")
								  ->execute($strLanguageCollection,$objPage->rootId);
		
		
	}
	
		
}

