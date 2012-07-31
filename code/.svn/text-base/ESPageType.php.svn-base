<?php

class ESPageType extends ESAbstractType {

    protected $_type = 'sspage';
    protected $_data;

    public function getMappingProps() {
        $props = array();
        $props['id'] = array(
            'type' => 'integer',
            'index' => 'not_analyzed'
        );
        $props['title'] = array(
            'type' => 'string'
        );
        $props['menutitle'] = array(
            'type' => 'string'
        );
        $props['content'] = array(
            'type' => 'string'
        );
        $props['url'] = array(
            'type' => 'string',
            'index' => 'not_analyzed'
        );
        $props['created'] = array(
            'type' => 'date',
            'format' => 'YYYY-MM-dd HH:mm:ss',
            'index' => 'not_analyzed'
        );
        $props['lastedited'] = array(
            'type' => 'date',
            'format' => 'YYYY-MM-dd HH:mm:ss',
            'index' => 'not_analyzed'
        );
        return $props;
    }

    public function prepareData($page) {
        $data = array();
        $data['id'] = $page->ID;
        $data['lastedited'] = $page->LastEdited;
        $data['created'] = $page->Created;
        $data['title'] = $page->Title;
        $data['menutitle'] = $page->MenuTitle ? $page->MenuTitle : $page->Title;
        $data['url'] = $page->AbsoluteLink();
        $data['content'] = $page->Content;

        $this->_data = $data;
    }

    public function indexData() {
        if (!isset($this->_data)) {
            return;
        }
        try {
            $pageDocument = new Elastica_Document($this->_data['id'], $this->_data);
            $this->_eType->addDocument($pageDocument);
            $this->_eClient->refreshIndex();
        } catch (Elastica_Exception_Client $e) {
            return Debug::log($e->getMessage());
        } catch (Exception $e) {
            return Debug::log($e->getMessage());
        }
    }

}