<?php
Prado::using('System.Data.ActiveRecord.*'); 

class DatosRecord extends TActiveRecord 
{
    const TABLE = 'datos';
 
    public $id_persona;
    public $codigo;
	public $nombre;
	public $domicilio;
	public $telefono;
	public $movil;
	public $correo;
	public $nacimiento;
	public $sugerencias;
	public $foto;
	public $regalo;
	public $cod_rastreo;
}
?>