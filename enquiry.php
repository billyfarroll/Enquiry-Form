<?php

$blockwords="http,href,www";

if(!empty($_SERVER['REMOTE_ADDR'])&&!empty($_POST)){$_POST['REMOTE_ADDR']=$_SERVER['REMOTE_ADDR'];}if(!empty($blockwords)&&!empty($_POST)){$useBlocks=explode(",",$blockwords);foreach($useBlocks as $blockWord){foreach($_POST as $Name=>$Value){$Value=trim($Value);$Value=strtolower($Value);if(!empty($Value)&&strpos($Value,$blockWord)!==false){exit();}}}}
?>
<?php
$email_to = "billy@strawberrymarketing.com";
$name = $_POST["name"];
$telephone = $_POST["telephone"];
$email = $_POST["email"];



if (empty($name))
{
    show_error("Please fill in your Name - hit back in the browser to correct");
}
if (empty($email))
{
    show_error("Please fill in your Email Address - hit back in the browser to correct");
}
if (empty($telephone))
{
    show_error("Please fill in your Telephone Number - hit back in the browser to correct");
}

$email = htmlspecialchars($_POST['email']);
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}


$email_from = "billy@strawberrymarketing.com";
$message = $_POST["message"];
$email_subject = "Test Form";
$headers =
"From: $email_from .\n";
"Reply-To: $email_from .\n";
$message = 
"Name: ". $name . 
"\r\nTelephone Number: " . $telephone . 
"\r\nEmail Address: " . $email;


ini_set("sendmail_from", $email_from);
$sent = mail($email_to, $email_subject, $message, $headers, "-f" .$email_from);
if ($sent)
{
header("Location: http://www.strawberryletting.co.uk/form_test/thank_you.html");
} else {
echo "There has been an error sending your comments. Please try later.";
}

function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>enquiry.php</title>
</head>

<body>

<?php echo $myError; ?>

</body>
</html>



<?php
exit();
}
?>
