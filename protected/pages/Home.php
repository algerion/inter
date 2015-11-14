<?php
Prado::using('System.Web.UI.ActiveControls.*');
include_once('../compartidos/clases/DbCon.php');

class Home extends TPage
{
	var $codigo;
	
	public function onLoad($param)
	{
		parent::onLoad($param);
		
		$this->codigo = $this->hidFacebook->Value; 
	}
	
	public function cbCodigo_Callback($sender, $param)
	{
		$this->codigo = $this->hidFacebook->Value;
		if($this->codigo != "")
			$this->Response->redirect("index.php?page=Inter&amp;codigo=" . $this->codigo);
	}
}
?>