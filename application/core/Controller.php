<?php
namespace core;

class Controller {
	
	public $model;
	public $view;
	
	function __construct()
	{
            $this->view = new View();
	}
                
        function getAccess($action)
        {
            return true;
        }
	
	function action_index()
	{
	}

	public function isAjaxRequest()
	{
		return (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
			&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
	}
}