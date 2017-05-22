<?php 

class FigureAdmin extends ModelAdmin
{
    
    private static $menu_title = 'Photos';
    
    private static $url_segment = 'photos';
    
    private static $managed_models = array(
        'Photo'
    );
    
    private static $menu_icon = 'mysite/icons/property.png';
}

?>