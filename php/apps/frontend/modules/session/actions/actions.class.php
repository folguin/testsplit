<?php

/**
 * session actions.
 *
 * @package    divideme
 * @subpackage session
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sessionActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
	$this->token=session_id();
  }

  public function executeEnviarBoleta(sfWebRequest $request)
  {
	$general= new General();
	$log=$general->setLog("executeEnviarBoleta");
	$this->grupo=$request["grupo"];
	$this->token=$request["sesion"];
	foreach ($request->getFiles() as $fileName) {
    	$fileSize = $fileName['size'];
    	$fileType = $fileName['type'];
    	$theFileName = $fileName['name'];
    	$uploadDir = sfConfig::get("sf_upload_dir");
    	$boletas_uploads = $uploadDir."/boletas/";
    	if(!is_dir($boletas_uploads))
        	mkdir($boletas_uploads, 0777);            
    	move_uploaded_file($fileName['tmp_name'], "$boletas_uploads/$theFileName");
	}
	$file=$boletas_uploads."/".$theFileName;
	$general->file=$file;
	$log->debug("general->file ".$general->file);
	$general->uploadOCR();	
/*
	$fco=array();	
	foreach ($textoTmp as $key => $value) {
		$log->debug("value ".$value[0]);
		$aux=$value[0]."|".$value[1];
		array_push($fco,$aux);
	}
*/
	$this->textoOCR=explode("\n", $general->data);
	$log->debug("textoOCR ".print_r($this->textoOCR,true));
	$template="confirmar";	
	$this->setTemplate($template);
  }

  public function executeListado(sfWebRequest $request)
	{
		$general= new General();
		$log=$general->setLog("executeListado");
		$log->debug("Input: ".print_r($request,true));
		$this->max=sizeof($request["producto"]);
		$log->debug("Cantidad: ".$this->max);
		$this->producto=$request["producto"];
		$this->cantidad=$request["cantidad"];
		$this->valor= $request["valor"];	
	}
}
