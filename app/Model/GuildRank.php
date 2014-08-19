<?php
class GuildRank extends AppModel {
	public $name = 'GuildRank'; // Nome do model
	public $useTable = 'guild_ranks'; // Tabela usada pelo model
	public $actsAs = array(); // Ações que o Model usa
	public $belongsTo = array( // Associação com outros models
        'Guild' => array(
            'className' => 'Guild',
            'foreignKey' => 'guild_id'
        )
    );
	public $validate = array( // Validação
		'name' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'O nome do rank não pode ficar em branco!'
			)
		)
	);
	
	// Método beforeSave (Antes de salvar)
	public function beforeSave($options = array()) {
	}
}
