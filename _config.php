<?php

define('PORTFOLIO_PATH', __DIR__);
define('PORTFOLIO_DIR', basename(__DIR__));

BreadcrumbNavigation::$includeHome = false;
BreadcrumbNavigation::$includeSelf = true; 
BreadcrumbNavigation::$maxDepth = 20; 
BreadcrumbNavigation::$stopAtPageType = false; 
BreadcrumbNavigation::$showHidden = false; 
BreadcrumbNavigation::$homeURLSegment = 'home';

if (!Director::isDev()) {
    SS_Log::add_writer(new SS_LogFileWriter('../ss_error-warning.log', SS_Log::WARN, '<='));
    SS_Log::add_writer(new SS_LogFileWriter('../ss_error.log', SS_Log::ERR));
    SS_Log::add_writer(new SS_LogFileWriter('../ss_notices.log', SS_Log::NOTICE));
}

?>