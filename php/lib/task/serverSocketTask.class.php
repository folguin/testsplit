<?php

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
	//$log = $this->setLog("execute");
	//$log->debug("Creando el socket a la ".$arguments["ip"]." y el puerto ".$arguments["puerto"]);
	//$directorio_local_xml = sfConfig::get("sf_root_dir").DIRECTORY_SEPARATOR."xml";
    // initialize the database connection
	
	//$this->logSection('do', ucfirst($arguments['verb']).' '.ucfirst($options['name']));
   
    // add your code here
  }

  private function setLog($modulo="",$archivo="task_server"){
      //LOG
      $logFechaNombre = $archivo."_".date("Ymd").".log";
      $logPath = sfConfig::get('sf_log_dir').'/'.$logFechaNombre;
      $log = new sfFileLogger(new sfEventDispatcher(), array('level' => sfFileLogger::DEBUG,'file' => $logPath,'type' => $modulo)); 
      return $log;

  }
}
