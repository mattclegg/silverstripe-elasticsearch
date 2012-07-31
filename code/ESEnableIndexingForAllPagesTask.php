<?php

class ESEnableIndexingForAllPagesTask extends BuildTask {

	protected $title = 'Enable Indexing For All Pages Task';
	protected $description = "Checks the 'index this page' checkbox for all pages. Does NOT index on its own.";

	function run($request) {
		if (!Permission::check('ADMIN')) {
			echo 'You need to be admin for this.';
			return;
		}
		$allPages = DataObject::get('SiteTree', 'ESIndexThis = 0');
		if ($allPages) {
			foreach ($allPages as $page) {
				$page->ESIndexThis = 1;
				$page->writeToStage('Stage');
				if ($page->isPublished()) {
					$page->publish('Stage', 'Live');
				}
				echo "Page id" . $page->ID . " title " . $page->Title . " indexing enabled <br>";
			}
		}
		else{
			echo 'No pages to be enabled.';
		}
	}

}