<?php

class ESDeleteIndexTask extends BuildTask {

	protected $title = 'Elastic Search Delete Index Task';
	protected $description = 'Deletes the current index set in site config';
	
	function run($request){
		if(!Permission::check('ADMIN')){
			echo 'You need to be admin for this.';
			return;
		}
		$siteConfig = SiteConfig::current_site_config();
		if($siteConfig->ESIndexName){
			$client = new SSElasticSearch();
			$client->deleteIndex();
			echo "index ".$siteConfig->ESIndexName." deleted.";
		}
	}
}
