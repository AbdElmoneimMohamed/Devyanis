<?php
require_once 'functions.php';

Class Repostories {

    // Properties
    private $count = 10;
    private $sort = 'forks';
    private $topic;
    private $created = '2019-01-10';
    private $page = 1;
    private $order = 'desc';

    function set_count($count) {
        $this->count = $count;
    }

    function get_count() {
        return $this->count;
    }

    function set_sort($sort) {
        $this->sort = $sort;
    }

    function get_sort() {
        return $this->sort;
    }

    function set_topic($topic) {
        $this->topic = $topic;
    }

    function get_topic() {
        return $this->topic;
    }

    function set_created($created) {
        $this->created = $created;
    }

    function get_created() {
        return $this->created;
    }

    function set_page($page) {
        $this->page = $page;
    }

    function get_page() {
        return $this->page;
    }

    function set_order($order) {
        $this->order = $order;
    }

    function get_order() {
        return $this->order;
    }

    public function getPopularRepostories()
    {
        $count = $this->get_count() ;
        $sortBy = $this->get_sort();
        $language =  $this->get_topic();
        $createdAt = $this->get_created();
        $page = $this->get_page();
        $order = $this->get_order();
        $url = GITHUB_URL.'?q=created:>'.$createdAt.'+topic='.$language.'&sort=' .$sortBy.'&order='.$order.'&per_page='. $count .'&page='.$page;
        $repositories = CallAPI('GET', $url);
        return $repositories;
    }

    public function setData($data)
    {
        if (isset($data['count'])) {
            $this->set_count($data['count']);
        }
        if (isset($data['sort'])) {
            $this->set_sort($data['sort']);
        }
        if (isset($data['topic'])) {
            $this->set_topic($data['topic']);
        }
        if (isset($data['created'])) {
            $this->set_created($data['created']);
        }
        if (isset($data['page'])) {
            $this->set_page($data['page']);
        }
        if (isset($data['order'])) {
            $this->set_order($data['order']);
        }
    }
}
