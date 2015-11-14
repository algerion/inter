<?php
include_once('../compartidos/clases/DbCon.php');

class Telefonos extends TPage
{
	private $cn;

	public function onLoad($param)
	{
		parent::onLoad($param);

		$this->cn = new DbCon($this, "db");

		$consulta = "SELECT nombre, movil FROM datos";
		$result = $this->cn->consulta($consulta);
		$this->dgTodas->DataSource = $result;
		$this->dgTodas->dataBind();
	}
	
}
?>