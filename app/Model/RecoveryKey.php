<?php
class RecoveryKey extends AppModel {
	public $name = 'RecoveryKey'; // Nome do model
	public $useTable = 'otaac_recovery_key'; // Tabela usada pelo model
	public $actsAs = array(); // Ações que o Model usa
	public $belongsTo = array( // Associação com outros models
        'Account' => array(
            'className' => 'Account',
            'foreignKey' => 'account_id'
        )
    );
	
    // Método de chave de segurança (recovery_key)
    public function chave_seguranca() {
        $string = Configure::read('Security.salt').Configure::read('Security.cipherSeed'); // String com os salts do core
        $chave_seguranca = ''; // Cria a chave de segurança vazia
        for($i = 0; $i < 20; $i++) { // Percorre gerando a chave, o numero 20 é o tamanho do campo da key na database
            $chave_seguranca .= $string[rand(0, strlen($string) - 1)];
        }
        return $chave_seguranca;
    }
    
	// Método beforeSave (Antes de salvar)
	public function beforeSave($options = array()) {
	    if(!isset($this->data['RecoveryKey']['recovery_key'])) { // Se não tiver a recovery:
            if(!empty($this->data['Account']['id'])) { // Se não vazio e for identica a password repeat:
                $this->data['RecoveryKey']['account_id'] = $this->data['Account']['id']; // Recebe id da conta
                $this->data['RecoveryKey']['recovery_key'] = $this->chave_seguranca(); // Recebe a chave de segurança
            } else { // Se não:
                return false; // Retorna falso
            }
        }
	}
}
