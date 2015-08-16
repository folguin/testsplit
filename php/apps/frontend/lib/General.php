<?php

/**
 * Modificación : M001
 * Fecha        : 20141121
 * Autor        : RContreras (MZZO)
 * Descripción  : Se solicita quitar el valor agregado
 *                de $500, al realizar una recarga con
 *                diferencia de saldo y valor antiplan.
 */

class General{  

    public function setLog($modulo="",$archivo="frontend"){      
        //LOG
        $parametro_log = $modulo."_".time()+3600*24*7;
        $logFechaNombre = $archivo."_".date("Ymd").".log";
        $logPath = sfConfig::get('sf_log_dir').'/'.$logFechaNombre;
        $log = new sfFileLogger(new sfEventDispatcher(), array('level' => sfFileLogger::DEBUG,'file' => $logPath,'type' => $parametro_log)); 
        return $log;       
    }
    
    public function get_OS(){
        $user_os = $_SERVER['HTTP_USER_AGENT'];
        $os_device ="";                              
        if( (preg_match("/iPhone/i", $user_os))||
            (preg_match("/iPod/i", $user_os)) ||
            (preg_match("/iPad/i", $user_os))){
            $os_device = "https://itunes.apple.com/us/app/virgin-mobile-chile/id925747157?l=es&ls=1&mt=8";
        }
        if(preg_match("/Android/i", $user_os)){
            $os_device = "https://play.google.com/store/apps/details?id=cl.virginmobile.m.virgin&hl=es";
        }      
		return $os_device;   
    }
    
	public function encrypt($string, $key){
		$result = '';
			for($i=0; $i<strlen($string); $i++)
			{
				$char = substr($string, $i, 1);
				$keychar = substr($key, ($i % strlen($key))-1, 1);
				$char = chr(ord($char)+ord($keychar));
				$result.=$char;
			}
		return $this->base64url_encode($result);
  	}

	public function base64url_encode($data){ 
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
	}
	
	public function isJson($string) {
	        return ((is_string($string) &&
	                (is_object(json_decode($string)) ||
	                is_array(json_decode($string))))) ? true : false;
	}	
	public function enviarImagenOCR($file){	
		$general= new General();
		$log=$general->setLog("executeEnviarBoleta","OCRWEBSERVICE");
		$filePath=$file;
		
		$json='{"ErrorMessage":"","AvailablePages":21,"OCRText":[["SODIMAC S.A. AU. LAS CONDES 11049 LAS CONDES SODIMAC S.A. RUT : 96.792.430-K AV. LAS CONDES 11049 LAS CONDES DISTRIB. MATERIALES DE CONSTRUCCION BOLETA Nro :021854679 04/06/2008 CC:00034 CAJA:0017 CAJERO:690 10:03:58 346721 SPRAY METALIC PLATA 485ML. CU 1 X 1.890 1.890 277398 TEE PVC-P 20MM CEM CU 8 X 138 1.104 227064 TUBO PUC-P C16 2OMMX1MT CEM CU 2 X 263 526 274402 TUBO PVC-P C16 2OX6000MM CEM CU 9 X 1.432 12.888 TOTAL 16.408 ##20## Formas de Pago EF 16408 FUNDACION NUESTROS HIJOS #06633 CAJERA(0) ELIZABETH BOCA (CAJAS) i 2 TIMBRE ELECTRONICO S.I.I. RES. 71 de 2006 GUARDE ESTA BOLETA Y PRESENTELA EN CASO DE RECLAMO O CAMBIO DE PRODUCTO GRACIAS POR PREFERIRNOS EN SODIMAC USTED SIEMPRE ENCONTRARA LOS MEJORES PRECIOS CLIENTE "]],"OutputFileUrl":"","OutputFileUrl2":"","OutputFileUrl3":"","Reserved":[],"OCRWords":[],"TaskDescription":null}';
		$productos=array("primero"=>array("cola - cola","1200"),
						"segundo"=>array("postre","200"),
						"tercero"=>array("cafe","500"));
		$json=json_encode($productos);
		$log->debug("json ".print_r($json,true));
		//$json=json_decode($productos);
		return $json; 

	        /*
	           Sample project for OCRWebService.com (REST API).
	           Extract text from scanned images and convert into editable formats.
	           Please create new account with ocrwebservice.com via http://www.ocrwebservice.com/account/signup and get license code
			===========================================
			Login        : folguin
			License code : 98BF59FE-A1D6-4F07-982B-66B5F5D040D7
			===========================================        
	*/

	        // Provide your user name and license code
			$license_code = "98BF59FE-A1D6-4F07-982B-66B5F5D040D7";
	        $username =  "folguin";


	        /*

	           You should specify OCR settings. See full description http://www.ocrwebservice.com/service/restguide

	           Input parameters:

		   [language]     - Specifies the recognition language. 
		   		    This parameter can contain several language names separated with commas. 
	                            For example "language=english,german,spanish".
				    Optional parameter. By default:english

		   [pagerange]    - Enter page numbers and/or page ranges separated by commas. 
				    For example "pagerange=1,3,5-12" or "pagerange=allpages".
	                            Optional parameter. By default:allpages

	           [tobw]	  - Convert image to black and white (recommend for color image and photo). 
				    For example "tobw=false"
	                            Optional parameter. By default:false

	           [zone]         - Specifies the region on the image for zonal OCR. 
				    The coordinates in pixels relative to the left top corner in the following format: top:left:height:width. 
				    This parameter can contain several zones separated with commas. 
			            For example "zone=0:0:100:100,50:50:50:50"
	                            Optional parameter.

	           [outputformat] - Specifies the output file format.
	                            Can be specified up to two output formats, separated with commas.
				    For example "outputformat=pdf,txt"
	                            Optional parameter. By default:doc

	           [gettext]	  - Specifies that extracted text will be returned.
				    For example "tobw=true"
	                            Optional parameter. By default:false

	           [description]  - Specifies your task description. Will be returned in response.
	                            Optional parameter. 


		   !!!!  For getting result you must specify "gettext" or "outputformat" !!!!  

		*/


	        // Build your OCR:

	        // Extraction text with English language
	        $url = 'http://www.ocrwebservice.com/restservices/processDocument?gettext=true&language=english,spanish&outputformat=csv';

	        // Extraction text with English and german language using zonal OCR
	        //$url = 'http://www.ocrwebservice.com/restservices/processDocument?language=english&zone=0:0:600:400,500:1000:150:400';

	        // Convert first 5 pages of multipage document into doc and txt
	        // $url = 'http://www.ocrwebservice.com/restservices/processDocument?language=english&pagerange=1-5&outputformat=doc,txt';


	        // Full path to uploaded document
	        //$filePath = '/Users/folguin/Sites/divideme/web/uploads/boleta.jpg';
			$log->debug("Enviando Archivo: ".$filePath);

	        $fp = fopen($filePath, 'r');
	        $session = curl_init();

	        curl_setopt($session, CURLOPT_URL, $url);
	        curl_setopt($session, CURLOPT_USERPWD, "$username:$license_code");

	        curl_setopt($session, CURLOPT_UPLOAD, true);
	        curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'POST');
	        curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($session, CURLOPT_TIMEOUT, 200);
	        curl_setopt($session, CURLOPT_HEADER, false);


	        // For SSL using
	        //curl_setopt($session, CURLOPT_SSL_VERIFYPEER, true);

	        // Specify Response format to JSON or XML (application/json or application/xml)
	        curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

	        curl_setopt($session, CURLOPT_INFILE, $fp);
	        curl_setopt($session, CURLOPT_INFILESIZE, filesize($filePath));

	        $result = curl_exec($session);

	  		$httpCode = curl_getinfo($session, CURLINFO_HTTP_CODE);
	        curl_close($session);
	        fclose($fp);

	        if($httpCode == 401) 
			{
	           // Please provide valid username and license code
				$log->err("Ha ocurrido un error con las credenciales.");
	           die('Unauthorized request');
	        }

	        // Output response
		$data = json_decode($result);
		$log->debug("Respuesta OCRWEBSERVICE: ".print_r($data,true));

	        if($httpCode != 200) 
		{
		   // OCR error
	           die($data->ErrorMessage);
	        }

	        // Task description
		//echo 'TaskDescription:'.$data->TaskDescription."\r\n";

	        // Available pages 
		//echo 'AvailablePages:'.$data->AvailablePages."\r\n";

	        // Extracted text
	        //echo 'OCRText='.$data->OCRText[0][0]."\r\n";
			$dataOutput=$data->OCRText[0][0];
			$log->debug("Retorno el JSON: ".$result);		

	        // For zonal OCR: OCRText[z][p]    z - zone, p - pages

	        // Get First zone from each page 
	        //echo 'OCRText[0][0]='.$data->OCRText[0][0]."\r\n";
	        //echo 'OCRText[0][1]='.$data->OCRText[0][1]."\r\n";


	        // Get second zone from each page
	        //echo 'OCRText[1][0]='.$data->OCRText[1][0]."\r\n";
	        //echo 'OCRText[1][1]='.$data->OCRText[1][1]."\r\n";


	        // Download output file (if outputformat was specified)

	        $url = $data->OutputFileUrl;   
			$file = fopen ($url, "r");
			if (!$file) {
			    $log->err("No pude leer el contenido de ".$url);
			    exit;
			}
			
			$aux=array();
			while (!feof ($file)) {
			    $line = fgets ($file, 1024);
				$log->debug("Texto : ".$line);
				array_push($aux,$line);
			}
			fclose($file);	
			$log->debug("Array texto : ".print_r($aux,true));
			return $aux;	
	        //$content = file_get_contents($url);
	        //file_put_contents('converted_document.doc', $content);

	        // End recognition	
	}
	
	public function uploadOCR(){
		$general= new General();
		$log=$general->setLog("uploadOCR","NewOCR");
		$this->file = realpath($this->file);
		$log->debug("Envio el archivo ".$this->file);
	  	$ch = curl_init();
		$key="c65d40da61f841c65157947e081cff8a";
		$url="http://api.newocr.com/v1/upload?key=".$key;
		$log->debug("Url Upload: ".$url);
	  	curl_setopt($ch, CURLOPT_URL, $url);
	  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	  	curl_setopt($ch, CURLOPT_POST, TRUE);
	  	curl_setopt($ch, CURLOPT_POSTFIELDS, array('file' => '@'.$this->file));
	  	$result_aux = curl_exec($ch);
		$result=json_decode($result_aux);
		$log->debug("result--- ".print_r($result,true));
		$this->fileId=$result->data->file_id;
		$log->debug("Result file_id: ".$this->fileId);
	  	curl_close ($ch);
		$this->getContentOCR();
		$log->debug("String obtenido: ".$this->data);
		return $this->data;
	}
	
	private function getContentOCR(){
		$general= new General();
		$log=$general->setLog("getContentOCR","NewOCR");
		$key="c65d40da61f841c65157947e081cff8a";
		$url2="http://api.newocr.com/v1/ocr?key=".$key."&file_id=".$this->fileId."&page=1&lang=spa&psm=6";
		$log->debug("Url getContentOCR ".$url2);
		$ch2 = curl_init($url2);
	  	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, TRUE);		
	  	curl_setopt($ch2, CURLOPT_HEADER, 0);
	  	$result2 = curl_exec($ch2);
	  	curl_close($ch2);
		$log->debug("Retorno getContentOCR ".print_r($result2, true));
		$result2=json_decode($result2);
		$log->debug("result content ".print_r($result2,true));
		$this->data=$result2->data->text;
		$log->debug("this->data ".print_r($this->data,true));
	  	//return $result;	
	}
/*	
	public function uploadFile($archivo){
		$general= new General();
		$log=$general->setLog("uploadFile");		
		$uploaddir = '/Users/folguin/Sites/divideme/web/uploads';
		$uploadfile = $uploaddir . basename($_FILES['$nombreCampo']['name']);

		if (move_uploaded_file($_FILES['$nombreCampo']['tmp_name'], $uploadfile)) {
		    //echo "El archivo es válido y fue cargado exitosamente.\n";
			$log->debug("Archivo ".$uploadfile." se subio correctamente");
			return true;
		} else {
		    //echo "¡Posible ataque de carga de archivos!\n";
			$log->err("Ha ocurrido un error al cargar el archivo ".$uploadfile);
			return false;
		}	
		
	}
*/
}