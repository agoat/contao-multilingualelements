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
 * HOOKS
 *
 * Hooks are stored in a global array called "TL_HOOKS". You can register your
 * own functions by adding them to the array.
 */


$GLOBALS['TL_HOOKS']['getPageLayout'][] = array('MultiLanguageFE', 'getPageLayoutHook'); 
$GLOBALS['TL_HOOKS']['isVisibleElement'][] = array('MultiLanguageFE', 'isVisibleElementHook'); 
 
