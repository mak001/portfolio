<?php 

class PageWithLocalNav extends Page {
    
    public function Anchors() {
        $c = $this->Content;
        
        preg_match_all("/<a name=\"(.*?)\">.*?<\/a>/i", $c, $anchors);
        
        $list = array();
        for ($i = 0; $i < count($anchors[1]); $i++) {
            $list[] = ArrayData::create(array(
                'Text' => $anchors[1][$i],
                'Class' => $this->getClass($i)
            ));
        }
        
        return ArrayList::create($list);
    }
    
    private function getClass($i) {
        if ($i % 3 == 0) {
            return 'bg-warning';
        }
        
        if ($i % 2 == 0) {
            return 'bg-info';
        }
        
        return 'bg-success';
        
    }
    
    public function LocalNavCacheKey() {
        return $this->ID . '-' . 'local-nav';
    }
    
    public function ShouldUpdate() {
        if (isset($member))
            return Permission::checkMember($member, 'CMS_ACCESS');
        return false;
    }
}

class PageWithLocalNav_Controller extends Page_Controller {
    
}

?>