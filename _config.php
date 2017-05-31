<?php

define('PORTFOLIO_PATH', __DIR__);
define('PORTFOLIO_DIR', basename(__DIR__));

BreadcrumbNavigation::$includeHome = false;
BreadcrumbNavigation::$includeSelf = true; 
BreadcrumbNavigation::$maxDepth = 20; 
BreadcrumbNavigation::$stopAtPageType = false; 
BreadcrumbNavigation::$showHidden = false; 
BreadcrumbNavigation::$homeURLSegment = 'home';

ShortcodeParser::get('default')->register('languagelink', array('Shortcodes', 'parseLanguageLink'));
ShortcodeParser::get('default')->register('frameworklink', array('Shortcodes', 'parseFrameworkLink'));
    
    
?>