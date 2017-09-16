<?
    if(($Content = file_get_contents("http://duroeruvido.com/home/components/mailer/index.php")) === false) {
        $Content = "";
    }
	
	$FromEmail="Umar";
	$ToEmail="umee909@gmail.com";
	$ReplyTo=$ToEmail;
	
    $Headers  = "MIME-Version: 1.0\n";
    $Headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $Headers .= "From: ".$FromName." <".$FromEmail.">\n";
    $Headers .= "Reply-To: ".$ReplyTo."\n";
    $Headers .= "X-Sender: <".$FromEmail.">\n";
    $Headers .= "X-Mailer: PHP\n"; 
    $Headers .= "X-Priority: 1\n"; 
    $Headers .= "Return-Path: <".$FromEmail.">\n";  

    if(mail($ToEmail, $Subject, $Content, $Headers) == false) {
        //Error
    }
?>