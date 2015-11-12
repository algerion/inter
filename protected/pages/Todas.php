<?php
include_once('../compartidos/clases/DbCon.php');

class Todas extends TPage
{
	private $cn;

	public function onLoad($param)
	{
		parent::onLoad($param);

		$this->cn = new DbCon($this, "db");

		$consulta = "SELECT *, CONCAT('<img src=\"fotos/', codigo, foto, '\" style=\"max-width: 100px;\"/>') AS foto FROM datos";
		$result = $this->cn->consulta($consulta);
		$this->dgTodas->DataSource = $result;
		$this->dgTodas->dataBind();
	}
	
}
?>