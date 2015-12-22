<?php

class Esform_View_Project extends Esform_ViewClass
{
	function preforward()
	{
		$projects = array();
		$data = &$this->backend->getManager('Data');
		$fl = &$this->backend->getManager('FileList');
		$file_list = $fl->getList();
		$data_dir = $this->config->get('data_dir');
		$publish_dir = $this->config->get('publish_dir');
		foreach ($file_list as $file) {
			$path = $data_dir . $file;
			$data->load($path);
			$project = $data->getArray();
			unset($project['body'], $project['receipt']);
			$form_file_p = $publish_dir . $project['file'] . '.php';
			$form_file_m = $publish_dir . $project['file'] . $this->config->get('mobile_suffix') . '.php';
			$project['form_file_p'] = $form_file_p;
			$project['form_file_m'] = $form_file_m;
			$project['published_p'] = is_file($form_file_p);
			$project['published_m'] = is_file($form_file_m);
			$project['count'] = count($project['attr']);
			$project['time'] = filemtime($path);
			$projects[] = $project;
		}

		$this->af->setApp('projects', $projects);
		$this->af->setApp('file', $this->af->get('file'));
		$this->af->setApp('name', $this->af->get('name'));
		$this->af->setApp('index', $this->af->get('index'));
	}
}

?>
