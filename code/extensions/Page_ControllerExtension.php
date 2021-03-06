<?php

class Page_ControllerExtension extends DataExtension {

	public function onAfterInit() {

		Requirements::set_combined_files_folder("{$this->owner->ThemeDir()}/combined");
		
		Requirements::combine_files(
		    'theme.css',
		    array(
		        "{$this->owner->ThemeDir()}/css/font-awesome.min.css",
		        "{$this->owner->ThemeDir()}/css/prism.css",
		        "{$this->owner->ThemeDir()}/css/style.css"
		    )
		);
		
		Requirements::combine_files(
		    'script.js',
		    array(
		        "{$this->owner->ThemeDir()}/javascript/jquery-3.1.1.slim.min.js",
		        "{$this->owner->ThemeDir()}/javascript/tether.min.js",
		        "{$this->owner->ThemeDir()}/javascript/bootstrap.min.js",
		        "{$this->owner->ThemeDir()}/javascript/jquery.matchHeight.js",
		        "{$this->owner->ThemeDir()}/javascript/prism.js",
		        "{$this->owner->ThemeDir()}/javascript/samplecode.js"
		    )
		);
		
		Requirements::block(THIRDPARTY_DIR.'/jquery/jquery.min.js');
	}

}

?>