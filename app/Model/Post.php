<?php
class Post extends AppModel {
	public $name = 'Post'; // Nome do model
	public $useTable = 'otaac_posts'; // Tabela usada pelo model
	public $actsAs = array(); // Ações que o Model usa
	public $belongsTo = array( // Associação com outros models
        'Account' => array(
            'className' => 'Account',
            'foreignKey' => 'created_by'
        )
    );
	public $validate = array( // Validação
		'title' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'O titulo não pode ficar em branco!'
			),
			'between' => array(
				'rule' => array('between', 3, 80),
				'message' => 'Só é permitido titulos entre 3 e 80 caracteres.'
			)
		),
		'body' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'O conteúdo não pode ficar em branco!'
			)
		)
	);
	
	// Método beforeSave (Antes de salvar)
	public function beforeSave($options = array()) {
		$this->data['Post']['created_by'] = $this->Session->read('Account.id');
	}
}
