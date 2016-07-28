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
        $countOfPages = floor($this->count / $this->limit);

        $curpos=(($this->offset)/5); //Текущая позиция
        $startpos=($curpos<3) ? 0 : ($curpos-2);
        $finpos=($curpos+3)>$countOfPages ? $countOfPages : ($curpos+2);
        $action = $_GET['r'];

        //$html = ''.($curpos+1)."/".($countOfPages+1);
        $html = '';
        $html .='<ul class="pagination">';

        $html .='<li><a href="?r='.$action.'&offset=0">&laquo;</a></li>';

        //for($i=0; $i<=$countOfPages; $i++)
        for($i=$startpos; $i<=$finpos; $i++)
        {
            $html .='<li><a href="?r='.$action.'&offset='.($i*5).'">'.($i+1).'</a></li>';
        }

        $html .='<li><a href="?r='.$action.'&offset='.($countOfPages*5).'">&raquo;</a></li>';
        $html .='</ul>';
        
        return $html;
    }
}