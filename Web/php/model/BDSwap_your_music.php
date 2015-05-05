<?php
/*
* Connection with the database called 'swap_your_music' 
* author: Juan Antonio Muñoz
* version: 1
* date: 05/05/2015
*/
	class BDSwap_your_music extends mysqli
	{
		function __construct(){
			parent::__construct(
				"localhost",
				"root",
				"",
				"swap_your_music"
			);
		}
	}
?>
