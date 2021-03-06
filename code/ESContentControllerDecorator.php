<?php

class ESContentControllerDecorator extends Extension {

	function ESSearchForm() {
		$fields = new FieldSet(
				new TextField('q', 'Search Query')
				);
		$actions = new FieldSet(
				$fa = new FormAction('doESSearch', 'Search')
				);
		$fa->setFullAction('');
		$form = new Form($this->owner, 'ESSearchForm', $fields, $actions);
		$form->setFormAction('q/');
		$form->setFormMethod('GET');
		$form->disableSecurityToken();
		return $form;
	}

}