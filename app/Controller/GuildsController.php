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
				$guilInfo = $this->Guild->find( // Busca as informações da Guilda
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
				$this->set('guildInfo', $guilInfo); // Seta as informações para a view
                $guildRanks = $this->GuildRank->find( // Busca os ranks da Guilda
                    'list',
                    array(
                        'conditions' => array(
                            'GuildRank.guild_id' => $id
                        ),
                        'fields' => array(
                            'GuildRank.id',
                            'GuildRank.name'
                        )
                    )
                );
                $this->set('guildRanks', $guildRanks); // Seta os ranks para a view
                $guildMembers = $this->GuildMember->find( // Busca os membros da guilda
                    'all',
                    array(
                        'conditions' => array(
                            'GuildMember.guild_id' => $id
                        ),
                        'contain' => array(
                            'Player' => array(
                                'fields' => array(
                                    'Player.id',
                                    'Player.name',
                                    'Player.level',
                                    'Player.vocation'
                                )
                            ),
                            'GuildRank' => array(
                                'fields' => array(
                                    'GuildRank.id',
                                    'GuildRank.name',
                                    'GuildRank.level'
                                )
                            )
                        )
                    )
                );
                $this->set('guildMembers', $guildMembers); // Seta os membros para a view
                $vocation_player = array(); // Cria array vazio para se usar
                foreach(Configure::read('AllVocations') as $vocation_id => $vocation) { // Percorre o array de registros
                    $vocation_player[$vocation_id] = $vocation; // Cria o array para exibir na view
                }
                $this->set('vocation', $vocation_player); // Envia para a view os dados
			} else { // Se não:
				$this->Session->setFlash('Você não é o dono desta guild!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
				return $this->redirect(array('action' => 'index')); // Retorna erro (redireciona)
			}
		} else { // Se não:
			return $this->redirect('/'); // Redireciona pois não tem permissão
		}
	}

    // Método de delete de guild
    function delete_guild($id) {
        if($this->Session->check('Account')) { // Se existe uma sessão criada:
            $guildOwner = $this->Guild->find('first', array('conditions' => array('Guild.ownerid' => $this->Session->read('Account.id'), 'Guild.id' => $id), 'fields' => array('Guild.name'))); // Busca se ele é o dono ou não da guild
            if(!empty($guildOwner)) { // Se ele é o dono da guild
                if($this->Guild->deleteAll(array('Guild.id' => $id), false)) { // Se deletar a guilda:
                    $this->GuildInvite->deleteAll(array('GuildInvite.guild_id' => $id), false); // Deleta os invites da guilda
                    $this->GuildMember->deleteAll(array('GuildMember.guild_id' => $id), false); // Deleta os membros da guilda
                    $this->GuildRank->deleteAll(array('GuildRank.guild_id' => $id), false); // Deleta os ranks da guilda
                    return $this->redirect(array('action' => 'index')); // Retorna (redireciona)
                }
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
			if($this->GuildInvite->deleteAll(array('GuildInvite.player_id' => $pid, 'GuildInvite.guild_id' => $gid), false))
			{
				return $this->redirect(array('action' => 'manage', $gid)); // Retorna erro (redireciona)
			}
		} else { // Se não:
			return $this->redirect('/'); // Redireciona pois não tem permissão
		}
	}

	// Método de deletar o player
	function delete_player($pid, $gid) {
		if($this->Session->check('Account')) { // Se existe uma sessão criada:
			if($this->GuildMember->deleteAll(array('GuildMember.player_id' => $pid, 'GuildMember.guild_id' => $gid), false))
			{
				return $this->redirect(array('action' => 'manage', $gid)); // Retorna erro (redireciona)
			}
		} else { // Se não:
			return $this->redirect('/'); // Redireciona pois não tem permissão
		}
	}

	// Método que aceita o invite do player
	function accept_invite($pid, $gid, $rid) {
		if($this->Session->check('Account')) { // Se existe uma sessão criada:
            $member['GuildMember'] = array( // Array com os dados para salvar o novo membro
                'player_id' => $pid,
                'guild_id'  => $gid,
                'rank_id'   => $rid
            );
			
			if($this->GuildMember->save($member)) { // Se salva o player na guild
				$this->delete_invite($pid, $gid); // Deleta o player da lista de invites
			} else { // Se não:
				return $this->Session->setFlash('Não foi possível invitar este player', 'default', array('class'=>'alert alert-danger')); // Retorna erro
			}
		} else { // Se não:
			return $this->redirect('/'); // Redireciona pois não tem permissão
		}
	}

	// Método top five guild
	function top5() {
		$this->autoRender = false;
		return $this->Guild->find(
			'list',
			array(
				'fields' => array(
					'Guild.name'
				),
				'limit' => 5,
				'order' => array(
					'Guild.name' => 'ASC'
				)
			)
		);
	}

    // Método de visualização de guild
    function view($guild = null) {
        if(!empty($guild)) { // Se foi passado o id ou o nome da guild
            $guildSearch = $this->Guild->find( // Busca a guild
                'first',
                array(
                    'conditions' => array(
                        'OR' => array(
                            'Guild.id' => $guild,
                            'Guild.name' => $guild
                        )
                    ),
                    'fields' => array('id', 'name')
                )
            );
            if(!empty($guildSearch)) { // Se encontrou a guild
                $id = $guildSearch['Guild']['id']; // Seta o id dela para as demais buscas
                $this->set('guild', $guildSearch); // Passa o nome da guild para a view
                $guilInfo = $this->Guild->find( // Busca as informações da Guilda
                    'first',
                    array(
                        'conditions' => array(
                            'Guild.id' => $id
                        ),
                        'contain' => array(
                            'Player'
                        )
                    )
                );
                $this->set('guildInfo', $guilInfo); // Seta as informações para a view
                $guildRanks = $this->GuildRank->find( // Busca os ranks da Guilda
                    'list',
                    array(
                        'conditions' => array(
                            'GuildRank.guild_id' => $id
                        ),
                        'fields' => array(
                            'GuildRank.id',
                            'GuildRank.name'
                        )
                    )
                );
                $this->set('guildRanks', $guildRanks); // Seta os ranks para a view
                $guildMembers = $this->GuildMember->find( // Busca os membros da guilda
                    'all',
                    array(
                        'conditions' => array(
                            'GuildMember.guild_id' => $id
                        ),
                        'contain' => array(
                            'Player' => array(
                                'fields' => array(
                                    'Player.id',
                                    'Player.name',
                                    'Player.level',
                                    'Player.vocation'
                                )
                            ),
                            'GuildRank' => array(
                                'fields' => array(
                                    'GuildRank.id',
                                    'GuildRank.name',
                                    'GuildRank.level'
                                )
                            )
                        )
                    )
                );
                $this->set('guildMembers', $guildMembers); // Seta os membros para a view
                $vocation_player = array(); // Cria array vazio para se usar
                foreach (Configure::read('AllVocations') as $vocation_id => $vocation) { // Percorre o array de registros
                    $vocation_player[$vocation_id] = $vocation; // Cria o array para exibir na view
                }
                $this->set('vocation', $vocation_player); // Envia para a view os dados
            } else {
                $this->Session->setFlash('Esta guild não existe!! As guilds existentes no servidor são as listadas abaixo.', 'default', array('class'=>'alert alert-danger')); // Retorna erro
                return $this->redirect(array('action' => 'index')); // Retorna erro (redireciona)
            }
        } else { // Se não:
            $this->Session->setFlash('Esta guild não existe!! As guilds existentes no servidor são as listadas abaixo.', 'default', array('class'=>'alert alert-danger')); // Retorna erro
            return $this->redirect(array('action' => 'index')); // Retorna erro (redireciona)
        }
    }
}