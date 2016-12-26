<?php 
class M_session extends CI_Model
{
	function __construct()
	{
		@session_start();
	}
	function m_session()
	{
		@session_start();
	}
	//LẤY THONG TIN SESSION
	function userdata( $name = "session_id" )
	{
		if($name == "session_id")
			return @session_id();
		else
		{
			return isset($_SESSION[$name]) ? $_SESSION[$name] : '';
		}
	}
	//SET GIA TRỊ CHO SESSION
	function set_userdata($name, $value)
	{
		@$_SESSION[$name] = $value;
	}
	//HUY SESSION
	function unset_userdata($name)
	{
		@$_SESSION[$name] = '';
	}
	//HUY TAT CA SESSION
	function destroy()
	{
		@session_start();
		@session_destroy();
	}
}

