<?php
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
}