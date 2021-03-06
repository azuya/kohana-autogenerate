<?php

class Controller_Autogenerate_Orm extends Controller_Template {

	public $template = 'autogenerate/index';
	
	public function action_index()
	{
		$view = new View('autogenerate/orm/index');
		$this->template->body = $view;
	}
	
	public function action_create()
	{
		$this->auto_render = FALSE;
		
		$view = new View('autogenerate/orm/create');
		$view->className = $_POST['className'];
		$view->tableName = $_POST['tableName'];
		
		$fields = explode(' ', $_POST['migrateFields']);
		
		$view->belongs_to = [];
		$view->has_one = [];
		$view->has_many = [];
		
		foreach($fields as $field):
			if(strstr($field, 'belongs_to')):
				list($name, $model) = explode(':', str_replace('belongs_to:', '', $field));
				$view->belongs_to[$name] = array('model' => $model, 'foreign_key' => strtolower($model).'_id');
			endif;
			if(strstr($field, 'has_one')):
				list($name, $model) = explode(':', str_replace('has_one:', '', $field));
				$view->has_one[$name] = array('model' => $model, 'foreign_key' => strtolower($_POST['className']).'_id');
			endif;
			//has_many:field:Model
			if(strstr($field, 'has_many')):
				list($name, $model) = explode(':', str_replace('has_many:', '', $field));
				$view->has_many[$name] = array('model' => $model, 'foreign_key' => strtolower($_POST['className']).'_id');
			endif;
			//many_many:field:Model:table1_table2
			if(strstr($field, 'many_many')):
				list($name, $model, $table) = explode(':', str_replace('many_many:', '', $field));
				$view->has_many[$name] = array('model' => $model, 'through' => $table);
			endif;
		endforeach;
		
		if(Kohana_Core::VERSION < 3.3):
			$filename = APPPATH.'classes/model/'.strtolower($_POST['className']).'.php';
		else:
			$filename = APPPATH.'classes/Model/'.$_POST['className'].'.php';
		endif;
		
		$f = fopen($filename, 'w+');
		fwrite($f, $view->render());
		fclose($f);
		
		if($this->request->is_initial())
			$this->request->redirect('autogenerate/orm/index');
		
		return;
	}

}
