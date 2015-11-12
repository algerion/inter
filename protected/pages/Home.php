<?php
Prado::using('System.Web.UI.ActiveControls.*');
include_once('../compartidos/clases/DbCon.php');

class Home extends TPage
{
	private $cn;
	private $codigo;

	public function onLoad($param)
	{
		parent::onLoad($param);

		$this->cn = new DbCon($this, "db");
		$this->codigo = $this->hidFacebook->Value; //mt_rand();
	}
	
	public function cbCodigo_Callback($sender, $param)
	{
		$this->codigo = $this->hidFacebook->Value;
		$this->txtFacebook->Text = $this->codigo;
		if($this->codigo != "")
		{
			$consulta = "SELECT id_persona FROM datos WHERE codigo = :codigo";
			$parametros = array("codigo"=>$this->codigo);
			$result = $this->cn->consulta($consulta, $parametros);
			if(count($result) > 0)
				$this->Response->redirect("index.php?page=Datos&amp;codigo=" . $this->codigo);
/*			else
				$this->Response->redirect("index.php?page=Codigo");*/
		}
	}
	
	public function fileUploaded($sender, $param)
    {
        if($sender->HasFile)
			$sender->saveAs("fotos/" . $this->codigo . $sender->FileName);
    }
	
	public function btnGuardar_Click($sender, $param)
	{
		mt_srand(time());
		$parametros = array(
			"codigo"=>$this->codigo,
			"nombre"=>$this->txtNombre->Text,
			"domicilio"=>$this->txtDomicilio->Text,
			"telefono"=>$this->txtTelefono->Text,
			"movil"=>$this->txtMovil->Text,
			"correo"=>$this->txtCorreo->Text,
			"nacimiento"=>date("Y-m-d", $this->datNacimiento->Timestamp),
			"sugerencias"=>$this->txtSugerencia->Text,
			"foto"=>$this->uplFoto->FileName
		);
		$this->cn->inserta("datos", $parametros);
		//$id = $this->ultimoIdGenerado();
		$this->ClientScript->registerBeginScript("guardado",
				"alert('Sus datos han sido almacenados correctamente');\n"
				. "document.location.href = 'index.php?page=Datos&codigo=" . $this->codigo . "';\n"
		);
	}
}
?>