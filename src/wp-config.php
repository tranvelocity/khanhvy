<?php
switch ($_SERVER['HTTP_HOST']) {
	case 'hoctran.net':
		$env = 'prod';
		break;
	case 'stage.hoctran.net':
		$env = 'stage';
		break;
	default:
		$env = 'local';
		break;
}

require_once( ABSPATH . 'config/wp-config-' . $env . '.php' );
