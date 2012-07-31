<?php

class ESSiteConfigDecorator extends DataObjectDecorator {
    public function extraStatics() {
        return array(
            'db' => array(
                'ESIndexName' => 'Varchar(255)',
                'ESHost' => 'Varchar(150)',
                'ESPort' => 'Varchar',
                'ESTransport' => 'Varchar',
                'ESIndexCustomSettings' => 'Text',
                'ESSearchResultsLimit' => 'Int(10)'
            ),
            'defaults' => array(
                'ESIndexName' => 'ss',
                'ESSearchResultsLimit' => 10
            )
        );
    }

    public function updateCMSFields(&$fields) {
        $fields->addFieldsToTab('Root.ElasticSearch', array(
            new TextField('ESIndexName', 'Index Name'),
            new LiteralField('info', '<p>
                <a href="dev/tasks/ESEnableIndexingForAllPagesTask" target="new">Enable indexing for all pages</a>
                <br>
                <a href="dev/tasks/ESUpdateAllPagesIndexTask" target="new">Update index of all pages  (good if index name has changed or after index deletion)</a>
                <br>
                <br>              
                <a href="dev/tasks/ESDeleteIndexTask" target="new">Delete index (careful!)</a>
                </p>'),
            new TextField('ESHost', 'Host (optional - default: localhost)'),
            new TextField('ESPort', 'Port (optional - default: 9200)'),
            new TextField('ESTransport', 'Transport (optional)'),
            new TextField('ESSearchResultsLimit', 'Search results limit per page'),
            new TextareaField('ESIndexCustomSettings', 'Index custom settings (optional)', 8)            
        ));
       
    }

}