<?php
class Post extends AppModel {
	public $name = 'Post'; // Nome do model
	public $useTable = 'otaac_posts'; // Tabela usada pelo model
	public $actsAs = array(); // Ações que o Model usa
	public $validate = array( // Validação
		'title' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'O titulo não pode ficar em branco!'
			)
		),
		'body' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'O conteúdo não pode ficar em branco!'
			)
		)
	);
}
