<?php
// Requerimento das configurações personalizadas definidas pelo usuário
require_once ROOT.'/config.php';

// Definição de constantes
// Contantes da database
define('hostname', $config['Database']['hostname']);
define('username', $config['Database']['username']);
define('password', $config['Database']['password']);
define('database', $config['Database']['database']);
// Constantes do servidor
define('nameServer', $config['Server']['name']);
define('titleServer', $config['Server']['title']);
define('tfs', $config['Server']['tfs']);
define('dir_server', $config['Server']['dir']);
// Constante da Engine (Aplicação)
define('layoutAAC', $config['Engine']['layout']);
define('themeAAC', $config['Engine']['theme']);
define('url',  $config['Engine']['url']);