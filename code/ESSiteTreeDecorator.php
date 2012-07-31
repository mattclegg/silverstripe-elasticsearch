<?php

class ESSiteTreeDecorator extends SiteTreeDecorator {

	public function extraStatics() {
		return array(
			'db' => array(
				'ESIndexThis' => 'Boolean'
			),
			'defaults' => array(
				'ESIndexThis' => 1
			)
		);
	}

	public function updateCMSFields(&$fields) {
		$fields->addFieldsToTab('Root.ElasticSearch', array(
			new CheckboxField('ESIndexThis', 'Index this page in elastic search? (on publish)')
		));
	}

	function onAfterPublish(&$original) {
		if ($this->owner->ESIndexThis) {
			$pageType = new ESPageType();
			$pageType->prepareData($this->owner);
			$pageType->indexData();
		} else {
			$pageType = new ESPageType();
			$pageType->deleteByID($this->owner->ID);
		}
	}

	function onAfterUnpublish() {
		$pageType = new ESPageType();
		$pageType->deleteByID($this->owner->ID);
	}

}