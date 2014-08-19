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
		'name' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'O nome da guild não pode ficar em branco!'
			),
			'between' => array(
				'rule' => array('between', 3, 50),
				'message' => 'Só é permitido nomes de guilds entre 3 e 50 caracteres.'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'O nome da guild já existe!'
			)
		),
		'ownerid' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'O dono da guild não pode ficar em branco!'
			)
		),
		'motd' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'O motd da guild não pode ficar em branco!'
			)
		)
	);
	
	// Método beforeSave (Antes de salvar)
	public function beforeSave($options = array()) {
	}
}
