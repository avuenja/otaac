<?php
class PlayersController extends AppController {
	public $name = 'Players'; // Nome do controller
	public $uses = array('Player'); // Model usado pelo controller
	public $helpers = array('Html', 'Form', 'Js'); // Helpers usados pela view

	// Método de funções carregadas antes de qualquer coisa
	function beforeFilter() {
		parent::beforeFilter();
	}

	// Método de criação de personagem
	function create() {
		if($this->Session->check('Account')) { // Se existe uma sessão criada:
			$towns = array(); // Cria array vazio para se usar
			$pos = array(); // Cria array vazio para se usar
			foreach(Configure::read('Cities') as $city_id => $city) { // Percorre o array de cidades
				$towns[$city_id] = $city['name']; // Cria o array para exibir na view
				$pos[$city_id] = $city;
			}
			$this->set('towns', $towns); // Envia para a view os dados
			if($this->request->is('post')) { // Se a requisição for do tipo POST:
				$this->Player->create(); // Cria o registro no model
				$this->request->data['Player']['account_id'] = $this->Session->read('Account.id'); // Atribui o id da conta ao player
				$this->request->data['Player']['posx'] = $pos[$this->request->data['Player']['town_id']]['x']; // Atribui a posição da cidade ao player
				$this->request->data['Player']['posy'] = $pos[$this->request->data['Player']['town_id']]['y']; // Atribui a posição da cidade ao player
				$this->request->data['Player']['posz'] = $pos[$this->request->data['Player']['town_id']]['z']; // Atribui a posição da cidade ao player
				if($this->Player->save($this->request->data)) { // Se salvar o registro:
					return $this->redirect('/'); // Retorna verdadeiro (redireciona)
				} else { // Se não:
					return $this->Session->setFlash('Não foi possível salvar o registro!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
				}
			}
		} else { // Se não:
			return $this->redirect('/'); // Redireciona pois não tem permissão
		}
	}

	// Método de visualização do player
	function index($name) {
		if(!empty($name)) {
			$character = $this->Player->find( // Busca os characters relacionado a conta do usuario logado
				'first', 
				array(
					'conditions' => array( // Condições de busca
						'name' => $name
					),
					// 'fields' => array( // Campos trazidos
						// 'Player.name',
						// 'Player.vocation',
						// 'Player.level',
						// 'Player.lastlogin'
					// )
				)
			);
			$this->set('character', $character); // Seta os dados para a view
			$vocation_player = array(); // Cria array vazio para se usar
			foreach(Configure::read('Vocations') as $vocation_id => $vocation) { // Percorre o array de registros
				$vocation_player[$vocation_id] = $vocation; // Cria o array para exibir na view
			}
			$this->set('vocation', $vocation_player); // Envia para a view os dados
		} else {
			return $this->redirect('/'); // Redireciona pois não foi passado nenhum nome de player
		}
	}
	
}