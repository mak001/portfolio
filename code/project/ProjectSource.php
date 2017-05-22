<?php 

class ProjectSource extends ProjectLink {
    
    public function Title() {
        if ($this->Title && $this->Title != '') {
            return $this->Title;
        }
        return "Source";
    }
    
}

?>