<?php
class PostsController extends AppController {
	public $name = 'Posts'; // Nome do controller
	public $uses = array('Post'); // Model usado pelo controller
	public $helpers = array('Html', 'Form', 'Js'); // Helpers usados pela view
	public $components = array('Paginator');

	// Método de funções carregadas antes de qualquer coisa
	function beforeFilter() {
		parent::beforeFilter();
	}
	
	// Método index
	function index() {
		$this->Paginator->settings = array( // Configurações de paginação
			'order' => array('Post.id' => 'DESC'),
	        'conditions' => array('Post.situation' => 'A'),
	        'limit' => 5,
	        'contain' => array('Account'),
			'fields' => array('Post.title', 'Post.body', 'Post.created', 'Account.name')
	    );
		$posts = $this->Paginator->paginate('Post'); // Busca todos os registros
		$this->set('posts', $posts); // Passa os dados da busca para a view
	}
	
	// Método consult posts (Acessivel apenas para administradores ou publicadores)
	function consult() {
		if($this->OTAAC->authAdmin()) { // Componente de autorização
			$posts = $this->Post->find(
				'all',
				array(
					'conditions' => array(
						'Post.situation' => 'A'
					),
					'contain' => array(
						'Account'
					),
					'fields' => array(
						'Post.id',
						'Post.title',
						'Post.created',
						'Account.name'
					)
				)
			);
			$this->set('posts', $posts); // Passando para a view os posts
		}
	}
	
	// Método create a post (Acessivel apenas para administradores ou publicadores)
	function create() {
		if($this->OTAAC->authAdmin()) { // Componente de autorização
			if($this->request->is('post')) { // Se a requisição for do tipo POST:
				$this->Post->create(); // Cria o post no model
				$this->request->data['Post']['created_by'] = $this->Session->read('Account.id'); // Adiciona quem esta logado como criador do post
				if($this->Post->save($this->request->data)) { // Se salvar o POST:
					return $this->redirect(array('action' => 'consult')); // Retorna verdadeiro (redireciona)
				} else { // Se não:
					return $this->Session->setFlash('Não foi possível criar seu post', 'default', array('class'=>'alert alert-danger')); // Retorna erro
				}
			}
		}
	}
	
	// Método edit a post
	function edit($id) {
		if($this->OTAAC->authAdmin()) { // Componente de autorização
			$this->Post->id = $id; // Atribuimos o id passado para o id do registro
			if($this->request->is('get')) { // Se a requisição for do tipo GET:
				$this->request->data = $this->Post->read(); // Exibe na view
			} else { // Se não:
				if($this->Post->save($this->request->data)) { // Se salvar a conta:
					$this->Session->setFlash('Post atualizado com sucesso!', 'default', array('class'=>'alert alert-success')); // Retorna sucesso
					return $this->redirect(array('action' => 'consult')); // Retorna verdadeiro (redireciona)
				} else { // Se não:
					return $this->Session->setFlash('Não foi possível salvar sua conta', 'default', array('class'=>'alert alert-danger')); // Retorna erro
				}
			}
		}
	}
	
	// Método delete a post (Inactivate)
	function delete($id) {
		if($this->OTAAC->authAdmin()) { // Componente de autorização
			$this->Post->id = $id; // Atribuimos o id passado para o id do registro
			$this->Post->updateAll( // Atualizamos o post com a situação para Inativa
				array('Post.situation' => "'I'"),
				array('Post.id' => $id)
			);
			return $this->redirect(array('action' => 'consult')); // Retorna verdadeiro (redireciona)
		}
	}
	
}