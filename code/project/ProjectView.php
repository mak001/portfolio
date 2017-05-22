<?php 

class ProjectView extends ProjectLink {
    
    public function Title() {
        if ($this->Title && $this->Title != '') {
            return $this->Title;
        }
        return "View";
    }
    
    public function ShowLink($id)
    {
        return $this->ProjectPage()->Link(ProjectPage::SHOW_ROUTE) . '/' . $id;
    }
    
}

?>