<?php

class Paginator
{
    public $count;

    public $limit;
    
    public $offset;
    /**
     * @param int $count общее кол-во записей
     * @param int $limit по скольку записей выводить
     */
    public function __construct($count, $limit)
    {
        $this->count = (int)$count;
        $this->limit = (int)$limit;
    }

    public function html()
    {
        $action = $_GET['r'];
        $countOfPages = floor($this->count / $this->limit);
        $html = '';
        $html .='<ul class="pagination">';
        $html .='<li><a href="#">&laquo;</a></li>';
        for($i=0; $i<=$countOfPages; $i++)
        {
            $html .='<li><a href="?r='.$action.'&offset='.($i*5).'">'.($i+1).'</a></li>';
        }
        $html .='<li><a href="#">&raquo;</a></li>';
        $html .='</ul>';
        
        return $html;
    }
}