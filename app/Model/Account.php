<?php
class Account extends AppModel {
	public $name = 'Account'; // Nome do model
	public $useTable = 'accounts'; // Tabela usada pelo model
	public $actsAs = array(); // Ações que o Model usa
	public $validate = array( // Validação
		'name' => array(
			'between' => array(
				'rule' => array('between', 3, 20),
				'message' => 'Só é permitido name account entre 3 e 25 caracteres.'
			),
			'caracteres' => array(
				'rule' => '/^[A-Z][a-z]+( ([A-Z][a-z]+|[a-z]{2,})){0,2}$/i',
				'message' => 'Só é permitido letras e espaços, e deve começar com uma letra maiúscula.'
			),
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'O nome da conta não pode ficar em branco!'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'O nome da conta já existe!'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'A senha não pode ficar em branca!'
			),
			'between' => array(
				'rule' => array('between', 6, 25),
				'message' => 'Só é permitido senhas de 6 a 25 caracteres'
			)
		),
		'password_repeat' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'A senha não pode ficar em branca!'
			),
			'between' => array(
				'rule' => array('between', 6, 25),
				'message' => 'Só é permitido senhas de 6 a 25 caracteres'
			)
		),
		'email' => array(
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Este email já esta em uso!'
			)
		)
	);
	
	// Método beforeSave (Antes de salvar)
	public function beforeSave($options = array()) {
		if($this->params['action'] == 'create') { // Se o método for o create:
			if($this->data['Account']['password'] === $this->data['Account']['password_repeat'] && !empty($this->data['Account']['password'])) { // Se não vazio e for identica a password repeat:
				$this->data['Account']['password'] = hash('sha1', $this->data['Account']['password']); // Criptografa a senha
				$this->data['Account']['password_repeat'] = hash('sha1', $this->data['Account']['password_repeat']); // Criptografa o repeat password (por segurança)
			} else { // Se não:
				return false; // Retorna falso
			}
		}
	}
}
