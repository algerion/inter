<?php
include_once('../compartidos/clases/DbCon.php');

class Inter extends TPage
{
	private $cn;

	public function onLoad($param)
	{
		parent::onLoad($param);

		$this->cn = new DbCon($this, "db");

		$consulta = "SELECT id_persona FROM datos WHERE codigo = :codigo";
		$parametros = array("codigo"=>$this->Request["codigo"]);
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
		$con = "SELECT nombre, movil, nacimiento, " . $dom . $foto . " FROM datos WHERE codigo ";
		$order = " ORDER BY codigo " . $desc . " LIMIT 1";
	
		$consulta = $con . $signo . " :codigo" . $order;
		$parametros = array("codigo"=>$this->Request["codigo"]);
		$result = $this->cn->consulta($consulta, $parametros);
		if(count($result) < 1)
		{
			$consulta = $con . " = (SELECT " . $sel . "(codigo) FROM datos)" . $order;
			$result = $this->cn->consulta($consulta);
		}
		$grid->DataSource = $result;
		$grid->dataBind();
	}
	
}
?>