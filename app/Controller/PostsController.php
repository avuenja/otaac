<?php
class PostsController extends AppController {
	public $name = 'Posts'; // Nome do controller
	public $uses = array('Post'); // Model usado pelo controller
	public $helpers = array('Html', 'Form', 'Js'); // Helpers usados pela view

	// Método de funções carregadas antes de qualquer coisa
	function beforeFilter() {
		parent::beforeFilter();
	}
	
	// Método index
	function index() {
		$posts = $this->Post->find( // Busca todos os registros
			'all',
			array(
				'order' => array(
					'Post.id' => 'DESC' // Traz o mais novo primeiro
				)
			)
		);
		$this->set('posts', $posts); // Passa os dados da busca para a view
	}
	
}