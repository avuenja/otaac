<?php
class GuildsController extends AppController {
	public $name = 'Guilds'; // Nome do controller
	public $uses = array('Guild', 'GuildMember', 'GuildRank', 'GuildInvite'); // Model usado pelo controller
	public $helpers = array('Html', 'Form', 'Js'); // Helpers usados pela view

	// Método de funções carregadas antes de qualquer coisa
	function beforeFilter() {
		parent::beforeFilter();
	}
	
	// Método de guilds
	function index() {
		$guilds = $this->Guild->find( // Busca todas as guildas
			'all',
			array(
				'contain' => array('Player'),
				'fields' => array(
					'Guild.id',
					'Guild.name',
					'Guild.motd',
					'Player.name'
				)
			)
		);
		$this->set('guilds', $guilds);
	}
	
	// Método de create guild
	function create() {
		if($this->Session->check('Account')) { // Se existe uma sessão criada:
			$this->loadModel('Player'); // Carrega o model dos Players
			$characters = $this->Player->find( // Busca os characters relacionado a conta do usuario logado
				'list', 
				array(
					'conditions' => array( // Condições de busca
						'Player.account_id' => $this->Session->read('Account.id'),
						'Player.deletion' => 0
					),
					'fields' => array( // Campos trazidos
						'Player.id',
						'Player.name'
					)
				)
			);
			$this->set('characters', $characters); // Seta os dados para a view
			if($this->request->is('post')) { // Se a requisição for do tipo POST:
				$countGuild = $this->Guild->find('count', array('conditions' => array('Guild.ownerid' => $this->request->data['Guild']['ownerid']))); // Verifica se o player selecionado não tem guild ainda
				$countGuildMember = $this->GuildMember->find('count', array('conditions' => array('GuildMember.player_id' => $this->request->data['Guild']['ownerid']))); // Verifica se o player selecionado não tem guild ainda
				if($countGuild == 0 && $countGuildMember == 0) { // Se não faz parte de nenhuma guild:
					$this->Guild->create(); // Cria o registro no model
					if($this->Guild->save($this->request->data)) { // Se salvar o registro:
						return $this->redirect(array('action' => 'index')); // Retorna verdadeiro (redireciona)
					} else { // Se não:
						return $this->Session->setFlash('Não foi possível salvar o registro!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
					}
				} else {
					return $this->Session->setFlash('Você não pode criar uma guild, verifique se você já não faz parte de uma!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
				}
			}
		} else { // Se não:
			return $this->redirect('/'); // Redireciona pois não tem permissão
		}
	}

	// Método de invite a guild
	function invite($id) {
		if($this->Session->check('Account')) { // Se existe uma sessão criada:
			$guildOwner = $this->Guild->find('first', array('conditions' => array('Guild.ownerid' => $this->Session->read('Account.id'), 'Guild.id' => $id)));
			if(empty($guildOwner)) {
				$this->loadModel('Player'); // Carrega o model dos Players
				$characters = $this->Player->find( // Busca os characters relacionado a conta do usuario logado
					'list', 
					array(
						'conditions' => array( // Condições de busca
							'Player.account_id' => $this->Session->read('Account.id'),
							'Player.deletion' => 0
						),
						'fields' => array( // Campos trazidos
							'Player.id',
							'Player.name'
						)
					)
				);
				$this->set('characters', $characters); // Seta os dados para a view
				if($this->request->is('post')) { // Se a requisição for do tipo POST:
					$countGuild = $this->Guild->find('count', array('conditions' => array('Guild.ownerid' => $this->request->data['Guild']['player_id']))); // Verifica se o player selecionado não tem guild ainda
					$countGuildMember = $this->GuildMember->find('count', array('conditions' => array('GuildMember.player_id' => $this->request->data['Guild']['player_id']))); // Verifica se o player selecionado não tem guild ainda
					if($countGuild == 0 && $countGuildMember == 0) { // Se não faz parte de nenhuma guild:
						$this->GuildInvite->create(); // Cria o registro no model
						$this->request->data['Guild']['guild_id'] = $id;
						if($this->GuildInvite->save($this->request->data)) { // Se salvar o registro:
							return $this->redirect(array('action' => 'index')); // Retorna verdadeiro (redireciona)
						} else { // Se não:
							return $this->Session->setFlash('Não foi possível enviar sua solicitação!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
						}
					} else {
						return $this->Session->setFlash('Você não pode enviar um convite a guild, você já faz parte de uma!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
					}
				}
			} else {
				$this->Session->setFlash('Você é o dono desta guild!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
				return $this->redirect(array('action' => 'index')); // Retorna erro (redireciona)
			}
		} else { // Se não:
			return $this->redirect('/'); // Redireciona pois não tem permissão
		}
	}
}