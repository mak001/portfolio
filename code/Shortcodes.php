<?php 

class Shortcodes {
    
    public static function parseLanguageLink($args, $text, $parser, $tag) {
        $holder = ProjectHolder::get()->First();
        if ($holder != null && $holder->exists())
            return '<a href="' . ProjectHolder::get()->First()->LanguageLink() . '">' . $text . '</a>';
            return $text;
    }
    
    public static function parseFrameworkLink($args, $text, $parser, $tag) {
        $holder = ProjectHolder::get()->First();
        if ($holder != null && $holder->exists())
            return '<a href="' . ProjectHolder::get()->First()->FrameworkLink() . '">' . $text . '</a>';
            return $text;
    }
    
}

?>