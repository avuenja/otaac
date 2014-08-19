<?php
class GuildInvite extends AppModel {
	public $name = 'GuildInvite'; // Nome do model
	public $useTable = 'guild_invites'; // Tabela usada pelo model
	public $actsAs = array(); // Ações que o Model usa
	public $belongsTo = array( // Associação com outros models
        'Guild' => array(
            'className' => 'Guild',
            'foreignKey' => 'guild_id'
        ),
        'Player' => array(
            'className' => 'Player',
            'foreignKey' => 'player_id'
        )
    );
	
	// Método beforeSave (Antes de salvar)
	public function beforeSave($options = array()) {
	}
}
