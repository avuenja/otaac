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
	function character($name) {
		if(!empty($name)) {
			if(tfs === '1.0') {
				$world = 'Player.town_id';
			} else if(tfs === '0.3.6') {
				$world = 'Player.world_id';
			}
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
						'Account.premdays',
						$world
					)
				)
			);
			if(!empty($character)) { // Se não vazio o array de character:
				$this->set('character', $character); // Seta os dados para a view
				$vocation_player = array(); // Cria array vazio para se usar
				foreach(Configure::read('AllVocations') as $vocation_id => $vocation) { // Percorre o array de registros
					$vocation_player[$vocation_id] = $vocation; // Cria o array para exibir na view
				}
				$this->set('vocation', $vocation_player); // Envia para a view os dados
				$world_player = array(); // Cria array vazio para se usar
				foreach(Configure::read('Worlds') as $world_id => $world) { // Percorre o array de registros
					$world_player[$world_id] = $world; // Cria o array para exibir na view
				}
				$this->set('world', $world_player); // Envia para a view os dados
			} else { // Se não:
				$this->Session->setFlash('Não foi possível encontrar este player!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
				return $this->redirect('/'); // Redireciona pois não foi encontrado o player
			}
		} else {
			return $this->redirect('/'); // Redireciona pois não foi passado nenhum nome de player
		}
	}

	// Método de desativação de player
	function delete($id) {
		if($this->Session->check('Account')) { // Se existe uma sessão criada:
			$player = $this->Player->find(
				'first', 
				array(
					'conditions' => array(
						'Player.id' => $id
					),
					'fields' => array(
						'Player.account_id'
					)
				)
			);
			if($player['Player']['account_id'] == $this->Session->read('Account.id')) {
				$this->Player->id = $id; // Atribuimos o id passado para o id do registro
				if(tfs === '1.0') {
					$situacao = 'deletion';
				} else if(tfs === '0.3.6') {
					$situacao = 'deleted';
				}
				$this->Player->updateAll( // Atualizamos o player com o deletion para 1
					array('Player.'.$situacao => 1),
					array('Player.id' => $id)
				);
				return $this->redirect(array('controller' => 'accounts', 'action' => 'manager')); // Retorna verdadeiro (redireciona)
			} else {
				$this->Session->setFlash('Você não tem permissão para isto!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
				return $this->redirect(array('controller' => 'accounts', 'action' => 'manager')); // Redireciona pois não tem permissão
			}
		} else { // Se não:
			return $this->redirect('/'); // Redireciona pois não tem permissão
		}
	}

	// Método top five player
	function top5() {
		$this->autoRender = false;
		if(tfs === '1.0') {
			$situacao = 'deletion';
		} else if(tfs === '0.3.6') {
			$situacao = 'deleted';
		}
		return $this->Player->find(
			'list',
			array(
				'conditions' => array(
					'Player.'.$situacao => 0
				),
				'fields' => array(
					'Player.name',
					'Player.level'
				),
				'limit' => 5,
				'order' => array(
					'Player.level' => 'DESC'
				)
			)
		);
	}
	
}