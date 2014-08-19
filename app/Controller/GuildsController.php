<?php
class GuildsController extends AppController {
	public $name = 'Guilds'; // Nome do controller
	public $uses = array('Guild', 'GuildMember'); // Model usado pelo controller
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
				if($countGuild == 0) {
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
}