<?php
class Player extends AppModel {
	public $name = 'Player'; // Nome do model
	public $useTable = 'players'; // Tabela usada pelo model
	public $actsAs = array(); // Ações que o Model usa
	public $belongsTo = array( // Associação com outros models
        'Account' => array(
            'className' => 'Account',
            'foreignKey' => 'account_id'
        )
    );
	public $validate = array( // Validação
		'name' => array(
			'between' => array(
				'rule' => array('between', 3, 20),
				'message' => 'Só é permitido character name entre 3 e 20 caracteres.'
			),
			'caracteres' => array(
				'rule' => '/^[A-Z][a-z]+( ([A-Z][a-z]+|[a-z]{2,})){0,2}$/i',
				'message' => 'Só é permitido letras e espaços, e deve começar com uma letra maiúscula.'
			),
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'O nome do character não pode ficar em branco!'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'O nome do character já existe!'
			)
		),
		'sex' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'O sexo não pode ficar em branco!'
			),
			'valid' => array(
                'rule' => array('inList', array(0, 1)),
                'message' => 'O sexo não é válido'
            )
		),
		'vocation' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'A vocation não pode ficar em branca!'
			)
		),
		'town_id' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'A cidade não pode ficar em branca!'
			)
		),
		'world' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'O world não pode ficar em branco!'
			)
		)
	);
	
	// Método beforeSave (Antes de salvar)
	public function beforeSave($options = array()) {
	}
}