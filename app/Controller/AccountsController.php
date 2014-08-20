<?php
class AccountsController extends AppController {
	public $name = 'Accounts'; // Nome do controller
	public $uses = array('Account'); // Model usado pelo controller
	public $helpers = array('Html', 'Form', 'Js'); // Helpers usados pela view

	// Método de funções carregadas antes de qualquer coisa
	function beforeFilter() {
		parent::beforeFilter();
	}

	// Método de criação de conta
	function create() {
		if($this->request->is('post')) { // Se a requisição for do tipo POST:
			$this->Account->create(); // Cria a conta no model
			if($this->Account->save($this->request->data)) { // Se salvar a conta:
				return $this->redirect(array('action' => 'login')); // Retorna verdadeiro (redireciona)
			} else { // Se não:
				return $this->Session->setFlash('Não foi possível criar sua conta', 'default', array('class'=>'alert alert-danger')); // Retorna erro
			}
		}
	}
	
	// Método de login
	function login() {
		if($this->request->is('post')) { // Se a requisição for do tipo POST:
			$account = $this->Account->find( // Busca a conta no banco de dados
				'first',
				array(
					'conditions' => array( // Condições da busca
						'Account.name' => $this->data['Account']['name'], // Account name
						'Account.password' => hash('sha1', $this->data['Account']['password']) // Criptografa a senha para encontra-la no banco
					),
					'fields' => array( // Campos que serão trazidos
						'Account.id',
						'Account.name',
						'Account.type'
					)
				)
			);
			if(!empty($account)) { // Se a conta existe:
				$this->loadModel('Guild');
				$guildOwner = $this->Guild->find('first', array('conditions' => array('Guild.ownerid' => $account['Account']['id']), 'fields' => array('Guild.id','Guild.name'))); // Busca se ele é o dono ou não da guild
				if(!$this->Session->check('Account')) { // Se não existe nenhuma sessão criada:
					$accountSession = $this->Session->write('Account.id', $account['Account']['id']);
					$accountSession = $this->Session->write('Account.name', $account['Account']['name']);
					$accountSession = $this->Session->write('Account.type', $account['Account']['type']);
					if(!empty($guildOwner)) {
						$accountSession = $this->Session->write('Account.guild_id', $guildOwner['Guild']['id']);
						$accountSession = $this->Session->write('Account.guild', $guildOwner['Guild']['name']);
					}
					$this->redirect(array('action' => 'manager'));
				} else { // Se não:
					$this->Session->destroy(); // Destrói a sessão
				}
			} else { // Se não:
				return $this->Session->setFlash('Conta incorreta! Verifique os dados digitados, ou crie uma conta!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
			}
		}
	}

	// Método de manager account
	function manager() {
		if($this->Session->check('Account')) { // Se existe uma sessão criada:
			$this->loadModel('Player'); // Carrega o model dos Players
			$characters = $this->Player->find( // Busca os characters relacionado a conta do usuario logado
				'all', 
				array(
					'conditions' => array( // Condições de busca
						'Player.account_id' => $this->Session->read('Account.id'),
						'Player.deletion' => 0
					),
					'fields' => array( // Campos trazidos
						'Player.id',
						'Player.name',
						'Player.vocation',
						'Player.level',
						'Player.lastlogin'
					)
				)
			);
			$this->set('characters', $characters); // Seta os dados para a view
			$vocation_player = array(); // Cria array vazio para se usar
			foreach(Configure::read('Vocations') as $vocation_id => $vocation) { // Percorre o array de registros
				$vocation_player[$vocation_id] = $vocation; // Cria o array para exibir na view
			}
			$this->set('vocation', $vocation_player); // Envia para a view os dados
		} else { // Se não:
			return $this->redirect('/'); // Redireciona pois não tem permissão
		}
	}
	
	// Método de change account
	function change($id) {
		if($this->OTAAC->authAccount($id)) { // Componente de autorização de conta
			$this->Account->id = $id; // Atribuimos o id passado para o id do registro
			if($this->request->is('get')) { // Se a requisição for do tipo GET:
				$this->request->data = $this->Account->read(); // Exibe na view
			} else { // Se não:
				if($this->Account->save($this->request->data)) { // Se salvar a conta:
					return $this->redirect('/'); // Retorna verdadeiro (redireciona)
				} else { // Se não:
					return $this->Session->setFlash('Não foi possível salvar sua conta', 'default', array('class'=>'alert alert-danger')); // Retorna erro
				}
			}
		}
	}

	// Método de logout
	function logout() {
		if ($this->Session->valid()) { // Se for uma sessão valida:
			$this->Session->destroy(); // Destrói a sessão
			return $this->redirect('/'); // Redireciona o usuário
		}
	}

}
