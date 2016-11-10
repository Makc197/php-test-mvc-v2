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
        //echo "$this->count  $this->limit)"; die();
        $countOfPages = floor($this->count / $this->limit);
        $curpos = (($this->offset) / 10); //Текущая позиция
        if ($countOfPages>5) {
            $startpos = ($curpos < 3) ? 0 : ($curpos - 2);
            $finpos = ($curpos + 3) > $countOfPages ? $countOfPages : ($curpos + 2);
        }
        else {
            $startpos = 0 ;
            $finpos = $countOfPages;
        }

        $action = $_GET['r'];

        $html = ''.($curpos+1)."/".($countOfPages+1);
        //$html = '';
        $html .= '<ul class="pagination">';

        $html .= '<li><a href="?r=' . $action . '&offset=0">&laquo;</a></li>';

        //for($i=0; $i<=$countOfPages; $i++)
        for ($i = $startpos; $i <= $finpos; $i++) {
			$classname= $i==$curpos ? 'class="current"' : "";
            $html .= '<li '.$classname.'><a href="?r=' . $action . '&offset=' . ($i * 10) . '">' . ($i + 1) . '</a></li>';
        }

        $html .= '<li><a href="?r=' . $action . '&offset=' . (($countOfPages) * 10) . '">&raquo;</a></li>';

        /* from dev2*/
        return $html;

    }
}