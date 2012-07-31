<?php

SiteTree::add_extension('SiteTree', 'ESSiteTreeDecorator');
ContentController::add_extension('ContentController', 'ESContentControllerDecorator');
DataObject::add_extension('SiteConfig', 'ESSiteConfigDecorator');

Director::addRules(10, array(
	'q' => 'ESResultsController'
));