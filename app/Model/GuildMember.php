<?php
class GuildMember extends AppModel {
	public $name = 'GuildMember'; // Nome do model
	public $useTable = 'guild_membership'; // Tabela usada pelo model
	public $actsAs = array(); // Ações que o Model usa
	public $belongsTo = array( // Associação com outros models
        'Player' => array(
            'className' => 'Player',
            'foreignKey' => 'player_id'
        ),
        'Guild' => array(
            'className' => 'Guild',
            'foreignKey' => 'guild_id'
        ),
        'GuildRank' => array(
            'className' => 'GuildRank',
            'foreignKey' => 'rank_id'
        ),
    );
	public $validate = array( // Validação
		'player_id' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'O player não pode ficar em branco!'
			)
		)
	);
	
	// Método beforeSave (Antes de salvar)
	public function beforeSave($options = array()) {
	}
}
