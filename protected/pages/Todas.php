<?php
include_once('../compartidos/clases/DbCon.php');

class Todas extends TPage
{
	private $cn;

	public function onLoad($param)
	{
		parent::onLoad($param);

		$this->cn = new DbCon($this, "db");

		$consulta = "SELECT *, CONCAT('<a target=\"inter\" href=\"index.php?page=Inter&codigo=', codigo, '\">' , codigo, \"</a>\") AS codigo, CONCAT('<img src=\"fotos/', codigo, foto, '\" style=\"max-width: 100px;\"/>') AS foto FROM datos ORDER BY codigo";
		$result = $this->cn->consulta($consulta);
		$this->dgTodas->DataSource = $result;
		$this->dgTodas->dataBind();
	}
	
}
?>