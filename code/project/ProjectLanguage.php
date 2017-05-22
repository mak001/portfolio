<?php 

class ProjectLanguage extends ProjectUses {
    
    public function Link() {
        return $this->ProjectHolder()->LanguageLink($this->URLSegment);
    }
    
    public function CssClass() {
        return 'lang-' . $this->URLSegment;
    }
    
    public function getAbsURL() {
        return $this->ProjectHolder()->LanguageLink() . '/';
    }
    
}

?>