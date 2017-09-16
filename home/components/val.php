<?php
$GLOBALS['__ValFlag']=1;


//Name Validation
function val_name($name){
	if($name==""){
		$GLOBALS['__ValFlag']=0;
		echo "Enter Name".'</br>';
	}
	elseif(!preg_match("%^[a-z A-Z 0-9 .,!@/-/&$]{3,100}$%",$name)){
		$GLOBALS['__ValFlag']=0;
		echo "Invalid Name".'</br>';
	}
}

//Email Validation
function val_email($email){
	if($email==""){
		$GLOBALS['__ValFlag']=0;
		echo "Enter Email".'</br>';
	}
	elseif(!preg_match("%^[a-z A-Z 0-9 */()><.,!@&#$]{2,100}[@]{1,1}[a-zA-Z]{3,16}[.]{1,1}[a-zA-Z]{2,16}[.]{0,1}[a-z]{0,16}$%",$email)){
		$GLOBALS['__ValFlag']=0;
		echo "Invalid Email".'</br>';
	}
}


//Phone number Validation
function val_phone($phone){
	if($phone==""){
		$GLOBALS['__ValFlag']=0;
		echo "Enter Phone".'</br>';
	}
	elseif(!preg_match("%^[+ ]{0,2}[0-9 ]{10,13}$%",$phone)){
		$GLOBALS['__ValFlag']="0";
		echo "Invalid Phone Number".'</br>';
	}
}


//Description Validation
function val_desc($desc){
	if($desc==""){
		$GLOBALS['__ValFlag']=0;
		echo "Enter Description".'</br>';
	}
	elseif(!preg_match("%^[a-z A-Z 0-9 +=(/)/{/}/ .,!@/-/&$]{4,1000}$%",$desc)){
		$GLOBALS['__ValFlag']=0;
		echo "Invalid Description".'</br>';
	}
}

//Testing here

//val_desc("+khbsjjhv[]{}-");
//val_name("ghhhgc123'");
?>