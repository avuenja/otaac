<?php
// Configurações necessárias para o bom funcionamento do OT AAC
// Configurações de banco de dados
$config['Database'] = array(
	'hostname' 	=> 'localhost',
	'username' 	=> 'root',
	'password' 	=> '',
	'database' 	=> 'otaac', // Do not use numbers in the name of your database
);
// Configurações de servidor
$config['Server'] = array(
	'name' 		=> 'OpenTibia',
	'title' 	=> 'OT AAC - The best web application for Open Tibia Servers',
	'tfs' 		=> '1.0', // 1.0 or 0.3.6
	'dir' 		=> 'C:\\'
);
// Configurações de Engine
$config['Engine'] = array(
	'layout' 	=> 'default',
	'theme' 	=> 'otaac',
	'url' 		=> 'http://localhost/otaac/'
);
// Configurações de vocações ativas para a escolha do player
$config['Vocations'] = array(
	1 	=> 'Sorcerer',
	2 	=> 'Druid',
	3 	=> 'Paladin',
	4 	=> 'Knight'
);
// Configurações de todas as vocações existentes no servidor
$config['AllVocations'] = array(
	0 	=> 'No vocation',
	1 	=> 'Sorcerer',
	2 	=> 'Druid',
	3 	=> 'Paladin',
	4 	=> 'Knight',
	5 	=> 'Master Sorcerer',
	6 	=> 'Elder Druid',
	7 	=> 'Royal Paladin',
	8 	=> 'Elite Knight'
);
// Configurações de cidades
$config['Cities'] = array(
	0 	=> array(
		'name' 	=> 'Thais',
		'x' 	=> 2168,
		'y' 	=> 1265,
		'z' 	=> 7
	),
	1 	=> array(
		'name' 	=> 'Venore',
		'x' 	=> 1897,
		'y' 	=> 2654,
		'z' 	=> 6
	)
);
// Configurações de mundos (servidores)
$config['Worlds'] = array(
	0 	=> 'Parlon',
	1 	=> 'Grihon'
);
// Configurações de rates
$config['Rates'] = array(
    'exp'   => 5,
    'magic' => 7,
    'skill' => 30,
    'loot'  => 3
);