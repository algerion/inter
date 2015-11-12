<?php
include_once('../compartidos/clases/DbCon.php');

class Datos extends TPage
{
	private $cn, $codigo;

	public function onLoad($param)
	{
		parent::onLoad($param);

		$this->cn = new DbCon($this, "db");

		$this->codigo = $this->Request["codigo"];
		if(!$this->IsPostBack)
		{
			$consulta = "SELECT * FROM datos WHERE codigo = :codigo";
			$parametros = array("codigo"=>$this->codigo);
			$result = $this->cn->consulta($consulta, $parametros);
			if(count($result) > 0)
			{
				$this->txtNombre->Text = $result[0]["nombre"];
				$this->txtDomicilio->Text = $result[0]["domicilio"];
				$this->txtTelefono->Text = $result[0]["telefono"];
				$this->txtMovil->Text = $result[0]["movil"];
				$this->txtCorreo->Text = $result[0]["correo"];
				$this->datNacimiento->Timestamp = strtotime($result[0]["nacimiento"]);
				$this->txtSugerencia->Text = $result[0]["sugerencias"];
				$this->imgFoto->ImageUrl = "fotos/" . $this->codigo . $result[0]["foto"];
			}
			else
			{
				$this->getClientScript()->registerBeginScript("error",
						"alert('El código proporcionado es incorrecto');\n"
//						. "document.location.href = 'index.php?page=Datos&codigo=' . $codigo;\n"
				);
			}
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
			"nombre"=>$this->txtNombre->Text,
			"domicilio"=>$this->txtDomicilio->Text,
			"telefono"=>$this->txtTelefono->Text,
			"movil"=>$this->txtMovil->Text,
			"correo"=>$this->txtCorreo->Text,
			"nacimiento"=>date("Y-m-d", $this->datNacimiento->Timestamp),
			"sugerencias"=>$this->txtSugerencia->Text
		);
        if($this->uplFoto->HasFile)
		$parametros = array_merge(
			$parametros,
			array("foto"=>$this->uplFoto->FileName)
		);
		$busqueda = array(
			"codigo"=>$this->codigo
		);
		$this->cn->actualiza("datos", $parametros, $busqueda);
		//$id = $this->ultimoIdGenerado();
		$this->ClientScript->registerBeginScript("guardado",
				"alert('Sus datos han sido actualizados correctamente');\n"
				. "document.location.href = 'index.php?page=Datos&codigo=" . $this->codigo . "';\n"
		);
	}
}
?>