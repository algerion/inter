<?php
include_once('../compartidos/clases/DbCon.php');

class Telefonos extends TPage
{
	private $cn;

	public function onLoad($param)
	{
		parent::onLoad($param);

		$this->cn = new DbCon($this, "db");

		$consulta = "SELECT nombre, /*CONCAT('<a target=\"inter\" href=\"index.php?page=Datos&codigo=', codigo, '\">' , codigo, \"</a>\") AS codigo,*/ movil FROM datos ORDER BY movil";
		$result = $this->cn->consulta($consulta);
		$this->dgTodas->DataSource = $result;
		$this->dgTodas->dataBind();
	}
	
}
?>