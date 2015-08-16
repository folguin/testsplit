<?php
ini_set('display_errors', 1);


class serverTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    $this->addArguments(array(
       new sfCommandArgument('ip', sfCommandArgument::REQUIRED, 'Ip'),
       new sfCommandArgument('puerto', sfCommandArgument::REQUIRED, 'Puerto')
    ));

    $this->addOptions(array(
      //new sfCommandOption('ip', null, sfCommandOption::PARAMETER_REQUIRED, 'Ip para el socket'),
      //new sfCommandOption('port', null, sfCommandOption::PARAMETER_REQUIRED, 'Puerto para el socket'),
    ));

    $this->namespace        = '';
    $this->name             = 'server';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [server|INFO] task does things.
Call it with:

  [php symfony server|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
	echo "sdsddsd";
	require(__DIR__ . '/lib/SplClassLoader.php');
	echo "Execute";
	$log = $this->setLog("execute");
	$log->debug("Creando el socket a la ".$arguments["ip"]." y el puerto ".$arguments["puerto"]);

	ini_set('display_errors', 1);
	error_reporting(E_ALL);



	$classLoader = new SplClassLoader('WebSocket', __DIR__ . '/lib');
	$classLoader->register();

	$ip= sfConfig::get("app_parametros_server_ip");
	$port=sfConfig::get("app_parametros_server_port");
	$server = new \WebSocket\Server($ip, $port, false);

	// server settings:
	$server->setMaxClients(100);
	$server->setCheckOrigin(true);
	$server->setAllowedOrigin('foo.lh');
	$server->setMaxConnectionsPerIp(100);
	$server->setMaxRequestsPerMinute(2000);

	// Hint: Status application should not be removed as it displays usefull server informations:
	$server->registerApplication('status', \WebSocket\Application\StatusApplication::getInstance());
	$server->registerApplication('demo', \WebSocket\Application\DemoApplication::getInstance());

	$server->run();
  }

  private function setLog($modulo="",$archivo="task_server"){
      //LOG
	try {
      $logFechaNombre = $archivo."_".date("Ymd").".log";
      $logPath = sfConfig::get('sf_log_dir').'/'.$logFechaNombre;
      $log = new sfFileLogger(new sfEventDispatcher(), array('level' => sfFileLogger::DEBUG,'file' => $logPath,'type' => $modulo)); 
      return $log;
	} catch (Exception $e) {
		echo $e->getMessage();
	}
  }
}
