<?php

class ESResultsController extends Page_Controller {

    function init() {
        parent::init();
    }

    function index() {
        return $this->renderWith(array('ESPage_results', 'Page'));
    }

    protected function _fetchResults($from = 0) {
        $results = NULL;
        if (isset($_GET['q'])) {
            $client = new SSElasticSearch();
            $query = trim((string) $_GET['q']);
            $results = $client->search($query, $from);
        }
        return $results;
    }

    function Results() {
        $results = $this->_fetchResults();
        if ($results) {
            if ($results->count() > 0) {
                $set = new DataObjectSet();
                $resultSet = new DataObjectSet();
                foreach ($results->getResults() as $result) {
                    $content = new HTMLText();
                    $content->setValue($result->content);
                    $data = array(
                        'Title' => $result->title,
                        'MenuTitle' => $result->title,
                        'Content' => $content,
                        'Link' => $result->url,
                    );
                    $resultSet->push(new ArrayData(($data)));
                }
                $set->push(new ArrayData(array(
                            'TotalHits' => $results->getTotalHits(),
                            'Results' => $resultSet
                        )));
                return $set;
            }
        }
    }

    function NextResults() {
        $results = $this->_fetchResults($this->_getNextFrom());
        if ($results && $results->count() > 0) {
            return true;
        }
        return false;
    }

    function PreviousResults() {
        if (!isset($_GET['start']) || (int) $_GET['start'] == 0) {
            return false;
        }
        $results = $this->_fetchResults($this->_getPreviousFrom());
        if ($results && $results->count() > 0) {
            return true;
        }
        return false;
    }

    function getPrevLink() {
        return HTTP::setGetVar('start', $this->_getPreviousFrom());
    }

    function getNextLink() {
        return HTTP::setGetVar('start', $this->_getNextFrom());
    }

    protected function _getNextFrom() {
        $from = 0;
        if (isset($_GET['start'])) {
            $from = (int) $_GET['start'];
        }
        $from = $from + (int) SiteConfig::current_site_config()->ESSearchResultsLimit;
        return $from;
    }

    protected function _getPreviousFrom() {
        $from = 0;
        if (isset($_GET['start'])) {
            $from = (int) $_GET['start'];
        }
        $limit = (int) SiteConfig::current_site_config()->ESSearchResultsLimit;
        if ($from < $limit) {
            $from = 0;
        } else {
            $from = $from - $limit;
        }
        return $from;
    }

}