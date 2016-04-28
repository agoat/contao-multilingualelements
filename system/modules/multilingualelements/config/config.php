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
 * HOOKS
 */

$GLOBALS['TL_HOOKS']['getPageLayout'][] = array('MultiLanguageFE', 'detectAndSetLanguage'); 
$GLOBALS['TL_HOOKS']['isVisibleElement'][] = array('MultiLanguageFE', 'checkLanguage'); 
 
