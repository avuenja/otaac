<?php
class Guild extends AppModel {
	public $name = 'Guild'; // Nome do model
	public $useTable = 'guilds'; // Tabela usada pelo model
	public $actsAs = array(); // Ações que o Model usa
	public $belongsTo = array( // Associação com outros models
        'Player' => array(
            'className' => 'Player',
            'foreignKey' => 'ownerid'
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
	}
}
