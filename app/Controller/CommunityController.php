<?php
class CommunityController extends AppController {
	public $name = 'Community'; // Nome do controller
	public $uses = array(); // Model usado pelo controller
	public $helpers = array('Html', 'Form', 'Js'); // Helpers usados pela view

	// Método de funções carregadas antes de qualquer coisa
	function beforeFilter() {
		parent::beforeFilter();
	}
	
	// Método characters search
	function characters() {
		if(!empty($this->data)) { // Se o $this->data não esta vazio:
			if(isset($this->data['name']) && !empty($this->data['name'])) { // Se estiver sendo passado $this->data['name'] e ele não estiver vazio:
				$name = $this->data['name']; // $name recebe o valor do campo
			} else if(isset($this->data['Player']['name']) && !empty($this->data['Player']['name'])) { // Se não, se estiver sendo passado $this->data['Player']['name'] e ele não estiver vazio:
				$name = $this->data['Player']['name']; // $name recebe o valor do campo
			}
			$this->loadModel('Player'); // Carrega o Model para ser usado
			$character = $this->Player->find( // Busca os characters relacionado a conta do usuario logado
				'first', 
				array(
					'conditions' => array( // Condições de busca
						'Player.name' => $name
					),
					'contain' => array( // Tabelas associadas
						'Account'
					),
					'fields' => array( // Campos
						'Player.name',
						'Player.vocation',
						'Player.level',
						'Player.sex',
						'Player.lastlogin',
						'Player.posx',
						'Player.posy',
						'Player.posz',
						'Account.premdays'
					)
				)
			);
			if(!empty($character)) { // Se não vazio o array de character:
				$this->set('character', $character); // Seta os dados para a view
				$vocation_player = array(); // Cria array vazio para se usar
				foreach(Configure::read('Vocations') as $vocation_id => $vocation) { // Percorre o array de registros
					$vocation_player[$vocation_id] = $vocation; // Cria o array para exibir na view
				}
				$this->set('vocation', $vocation_player); // Envia para a view os dados
			} else { // Se não:
				$this->Session->setFlash('Não foi possível encontrar este player!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
			}
		}
	}
	
	// Método highscores
	function highscores() {
	}
	
}