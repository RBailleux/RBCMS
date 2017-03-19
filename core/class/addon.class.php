<?php 

class addon{
	
	private $zipPath;
	public function __construct($zipPath){
		$this->zipPath = $zipPath;
 		if(!$this->checkIntegrity()){
 			throw new Exception("The specified zip file is not recognized as a compatible addon");
 		}
	}
	
	public function checkIntegrity(){
		$zip = new ZipArchive();
		if($zip->open($this->zipPath)){
			$addonInfoXML = $zip->getFromName('addonInfo.xml');
			if(!$addonInfoXML){
				return false;
			}
			$addonInfo = new SimpleXMLElement($addonInfoXML);
			if( isset($addonInfo->name) &&
				isset($addonInfo->version) &&
				isset($addonInfo->requires->core) &&
				isset($addonInfo->requires->php) &&
				isset($addonInfo->requires->mysql) &&
				isset($addonInfo->info->description)
			){
				return true;
			}
		}
		return false;
	}
	
}

?>