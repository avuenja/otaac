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
			if(tfs === '1.0') {
				$situacao = 'deletion';
			} else if(tfs === '0.3.6') {
				$situacao = 'deleted';
			}
			$characters = $this->Player->find( // Busca os characters relacionado a conta do usuario logado
				'list', 
				array(
					'conditions' => array( // Condições de busca
						'Player.account_id' => $this->Session->read('Account.id'),
						'Player.'.$situacao => 0
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
			$guildOwner = $this->Guild->find( // Busca se ele é o dono ou não da guild
				'first', 
				array(
					'conditions' => array(
						'Guild.ownerid' => $this->Session->read('Account.id'), 
						'Guild.id' => $id
					),
					'fields' => array(
						'Guild.id'
					)
				)
			);
			if(empty($guildOwner)) { // Se vazio:
				$this->loadModel('Player'); // Carrega o model dos Players
				if(tfs === '1.0') {
					$situacao = 'deletion';
				} else if(tfs === '0.3.6') {
					$situacao = 'deleted';
				}
				$characters = $this->Player->find( // Busca os characters relacionado a conta do usuario logado
					'list', 
					array(
						'conditions' => array( // Condições de busca
							'Player.account_id' => $this->Session->read('Account.id'),
							'Player.'.$situacao => 0
						),
						'fields' => array( // Campos trazidos
							'Player.id',
							'Player.name'
						)
					)
				);
				$this->set('characters', $characters); // Seta os dados para a view
				if($this->request->is('post')) { // Se a requisição for do tipo POST:
					$this->request->data['GuildInvite']['guild_id'] = $id; // Pega o id da guild
					$countGuild = $this->Guild->find('count', array('conditions' => array('Guild.ownerid' => $this->request->data['GuildInvite']['player_id']))); // Verifica se o player selecionado não tem guild ainda
					$countGuildMember = $this->GuildMember->find('count', array('conditions' => array('GuildMember.player_id' => $this->request->data['GuildInvite']['player_id']))); // Verifica se o player selecionado não tem guild ainda
					$countGuildInvite = $this->GuildInvite->find('count', array('conditions' => array('GuildInvite.player_id' => $this->request->data['GuildInvite']['player_id'], 'GuildInvite.guild_id' => $id), 'fields' => array('GuildInvite.guild_id' => $id))); // Verifica se o player selecionado não tem guild ainda
					if($countGuild == 0 && $countGuildMember == 0 && $countGuildInvite == 0) { // Se não faz parte de nenhuma guild:
						$this->GuildInvite->create(); // Cria o registro no model
						// pr($this->request->data);exit();
						if($this->GuildInvite->save($this->request->data)) { // Se salvar o registro:
							return $this->redirect(array('action' => 'index')); // Retorna verdadeiro (redireciona)
						} else { // Se não:
							return $this->Session->setFlash('Não foi possível enviar sua solicitação!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
						}
					} else {
						return $this->Session->setFlash('Você não pode enviar um convite a guild, você já faz parte de uma ou já mandou o convite para a mesma!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
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

	// Método de manage de guild
	function manage($id) {
		if($this->Session->check('Account')) { // Se existe uma sessão criada:
			$guildOwner = $this->Guild->find('first', array('conditions' => array('Guild.ownerid' => $this->Session->read('Account.id'), 'Guild.id' => $id), 'fields' => array('Guild.name'))); // Busca se ele é o dono ou não da guild
			if(!empty($guildOwner)) { // Se ele é o dono da guild
				$this->set('guild', $guildOwner); // Passa o nome da guild para a view
				$guildInvites = $this->GuildInvite->find( // Busca os convites de players para esta guild
					'all', 
					array(
						'conditions' => array(
							'GuildInvite.guild_id' => $id
						),
						'contain' => array(
							'Player',
							'Guild'
						),
						'fields' => array(
							'Player.id',
							'Player.name',
							'Guild.id'
						)
					)
				);
				$this->set('guildInvites', $guildInvites); // Seta os convites para a view
				$guilInfo = $this->Guild->find(
					'first',
					array(
						'conditions' => array(
							'Guild.id' => $id
						),
						'fields' => array(
							'Guild.id',
							'Guild.name',
							'Guild.motd'
						)
					)
				);
				$this->set('guildInfo', $guilInfo);
			} else { // Se não:
				$this->Session->setFlash('Você não é o dono desta guild!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
				return $this->redirect(array('action' => 'index')); // Retorna erro (redireciona)
			}
		} else { // Se não:
			return $this->redirect('/'); // Redireciona pois não tem permissão
		}
	}

	// Método de delete de invite
	function delete_invite($pid, $gid) {
		if($this->Session->check('Account')) { // Se existe uma sessão criada:
			if($this->GuildInvite->deleteAll(array('GuildInvite.player_id' => $pid, 'GuildInvite.guild_id' => $gid), false)) {
				return $this->redirect(array('action' => 'manage', $gid)); // Retorna erro (redireciona)
			}
		} else { // Se não:
			return $this->redirect('/'); // Redireciona pois não tem permissão
		}
	}
}