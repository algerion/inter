<?php
Prado::using('System.Web.UI.ActiveControls.*');
include_once('../compartidos/clases/DbCon.php');

class Inter extends TPage
{
	private $cn;
	private $codigo;

	public function onLoad($param)
	{
		parent::onLoad($param);

		$this->cn = new DbCon($this, "db");

		$this->codigo = $this->Request["codigo"];
		
		$consulta = "SELECT id_persona FROM datos WHERE codigo = :codigo";
		$parametros = array("codigo"=>$this->codigo);
		$result = $this->cn->consulta($consulta, $parametros);
		if(count($result) > 0)
		{
			$this->grids(">");
			$this->grids("<");
		}
	}
	
	public function grids($signo)
	{
		//Inamovibles
		$sel = ($signo == "<") ? "MAX" : "MIN";
		$desc = ($signo == "<") ? "DESC" : "";

		//Ajustables
		$grid = ($signo == "<") ? $this->dgEntregar : $this->dgRecibir;
		$dom = ($signo == "<") ? "domicilio, sugerencias, " : "";

		$foto = " CONCAT('<img src=\"fotos/', codigo, foto, '\" style=\"max-width: 100px;\"/>') AS foto ";
		$regalo = ", CASE WHEN regalo IS NOT NULL AND regalo <> '' THEN CONCAT('<img src=\"regalos/', " .
				"codigo, regalo, '\" style=\"max-width: 100px;\"/>') ELSE '' END " .
				"AS regalo, cod_rastreo ";
		$reg = ($signo == "<") ? "" : $regalo;
		$con = "SELECT nombre, movil, nacimiento, " . $dom . $foto . $reg . " FROM datos WHERE codigo ";
		$order = " ORDER BY codigo " . $desc . " LIMIT 1";
	
		$consulta = $con . $signo . " :codigo" . $order;
		$parametros = array("codigo"=>$this->codigo);
		$result = $this->cn->consulta($consulta, $parametros);
		if(count($result) < 1)
		{
			$consulta = $con . " = (SELECT " . $sel . "(codigo) FROM datos)" . $order;
			$result = $this->cn->consulta($consulta);
		}
		$grid->DataSource = $result;
		$grid->dataBind();
	}
	
	public function fileUploaded($sender, $param)
    {
        if($sender->HasFile)
			$sender->saveAs("regalos/" . $this->codigo . $sender->FileName);
    }
	
	public function btnGuardar_Click($sender, $param)
	{
		mt_srand(time());
		$parametros = array(
			"cod_rastreo"=>$this->txtRastreo->Text,
			"mail"=>$this->hidMail->Value
		);
        if($this->uplFoto->HasFile)
			$parametros = array_merge(
				$parametros,
				array("regalo"=>$this->uplFoto->FileName)
			);
		$busqueda = array("codigo"=>$this->codigo);
		$this->cn->actualiza("datos", $parametros, $busqueda);
		$this->ClientScript->registerBeginScript("guardado",
				"alert('Sus datos han sido almacenados correctamente');\n"
				. "document.location.href = 'index.php?page=Inter&codigo=" . $this->codigo . "';\n"
		);
	}
}
?>