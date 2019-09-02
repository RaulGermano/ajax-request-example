<?php

	$obj=[
		'nome'=>$_POST['nome'],
		'email'=>$_POST['email']
	];

	echo json_encode($obj);
