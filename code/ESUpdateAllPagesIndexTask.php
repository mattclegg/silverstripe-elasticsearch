<?php

class ESUpdateAllPagesIndexTask extends BuildTask {

    protected $title = 'Elastic Search Update All Page Index Task';
    protected $description = 'Updates the index (adds/removes) for all pages (good if index name has changed)';

    function run($request) {
        if (!Permission::check('ADMIN')) {
            echo 'You need to be admin for this.';
            return;
        }
        $allPages = DataObject::get('SiteTree');
        foreach ($allPages as $page) {
            if ($page->ESIndexThis) {
                $pageType = new ESPageType();
                $pageType->prepareData($page);
                $pageType->indexData();
                echo "Page id".$page->ID." title ".$page->Title." (re)added to index <br>";
            } else {
                $pageType = new ESPageType();
                $pageType->deleteByID($page->ID);
                echo "Page id".$page->ID." title ".$page->Title." removed from index (if it was in it) <br>";
            }
        }
    }

}
