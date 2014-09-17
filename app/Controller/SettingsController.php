<?php
class SettingsController extends AppController {
  public $name = 'Settings'; // Nome do controller
  public $uses = array(''); // Model usado pelo controller
  public $helpers = array('Html', 'Form', 'Js'); // Helpers usados pela view

  // Método de funções carregadas antes de qualquer coisa
  function beforeFilter() {
    parent::beforeFilter();
  }

  // Função para o gerenciamento de paginas
  function server() {
    if($this->OTAAC->authAdmin()) {}
  }
}
