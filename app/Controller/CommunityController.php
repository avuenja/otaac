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
				foreach(Configure::read('Vocations') as $vocation_id => $vocation) { // Percorre o array de registros
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
			}
		}
	}
	
	// Método highscores
	function highscores() {
        $options = array(
            'experience' => 'Experience',
            'magiclevel' => 'Magic Level',
            'fist' => 'Fist',
            'club' => 'Club',
            'sword' => 'Sword',
            'axe' => 'Axe',
            'distance' => 'Distance',
            'shield' => 'Shield',
            'fishing' => 'Fishing'
        );
        $this->set('options', $options);
        $order = ''; // variável de ordenação
        $orderName = ''; // variável com o nome da ordenação
        if(isset($this->params['pass'][0]) && !empty($this->params['pass'][0])) { // Se setado e não vazio o sort:
            if($this->params['pass'][0] == 'experience') { // Se a ordenação for por experience:
                $order = 'Player.experience';
                $orderName = 'Experience';
            }
            if($this->params['pass'][0] == 'magiclevel') { // Se a ordenação for por magic level:
                $order = 'Player.maglevel';
                $orderName = 'Magic level';
            }
            if($this->params['pass'][0] == 'fist') { // Se a ordenação for por fist:
                $order = 'Player.skill_fist';
                $orderName = 'Fist';
            }
            if($this->params['pass'][0] == 'club') { // Se a ordenação for por club:
                $order = 'Player.skill_club';
                $orderName = 'Club';
            }
            if($this->params['pass'][0] == 'sword') { // Se a ordenação for por sword:
                $order = 'Player.skill_sword';
                $orderName = 'Sword';
            }
            if($this->params['pass'][0] == 'axe') { // Se a ordenação for por axe:
                $order = 'Player.skill_axe';
                $orderName = 'Axe';
            }
            if($this->params['pass'][0] == 'distance') { // Se a ordenação for por distance:
                $order = 'Player.skill_dist';
                $orderName = 'Distance';
            }
            if($this->params['pass'][0] == 'shield') { // Se a ordenação for por shield:
                $order = 'Player.skill_shielding';
                $orderName = 'Shield';
            }
            if($this->params['pass'][0] == 'fishing') { // Se a ordenação for por fishing:
                $order = 'Player.skill_fishing';
                $orderName = 'Fishing';
            }
        } else {
            $order = 'Player.experience'; // Valor padrão do sort
            $orderName = 'Experience'; // Nome padrão do sort
        }
        $this->loadModel('Player'); // Carrega o Model para ser usado
        if(tfs === '1.0') {
            $situacao = 'deletion';
        } else if(tfs === '0.3.6') {
            $situacao = 'deleted';
        }
        $characters = $this->Player->find( // Busca os characters relacionado a conta do usuario logado
            'all',
            array(
                'conditions' => array( // Condições de busca
                    'Player.'.$situacao => 0
                ),
                'contain' => array( // Tabelas associadas
                    'Account'
                ),
                'fields' => array( // Campos
                    'Player.name',
                    'Player.vocation',
                    'Player.level',
                    'Player.experience',
                    'Player.maglevel',
                    'Player.skill_fist',
                    'Player.skill_club',
                    'Player.skill_sword',
                    'Player.skill_axe',
                    'Player.skill_dist',
                    'Player.skill_shielding',
                    'Player.skill_fishing',
                    'Account.premdays'
                ),
                'order' => array(
                    $order => 'DESC'
                )
            )
        );
        if(!empty($characters)) { // Se não vazio o array de character:
            $this->set('characters', $characters); // Seta os dados para a view
            $vocation_player = array(); // Cria array vazio para se usar
            foreach(Configure::read('Vocations') as $vocation_id => $vocation) { // Percorre o array de registros
                $vocation_player[$vocation_id] = $vocation; // Cria o array para exibir na view
            }
            $this->set('vocation', $vocation_player); // Envia para a view os dados
            $this->set('sortName', $orderName); // Envia para a view os dados
        } else { // Se não:
            $this->Session->setFlash('Não foi possível encontrar este player!', 'default', array('class'=>'alert alert-danger')); // Retorna erro
        }
	}
	
}