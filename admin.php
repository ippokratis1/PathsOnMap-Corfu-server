<?php #admin/index.php 
           #####[make sure you put this code before any html output]#####

//connect to server
$dbc = mysqli_connect('localhost','pa277408_ippokra','!lissos78') or 
           die('could not connect: '. mysqli_connect_error());

//select db
mysqli_select_db($dbc, 'pa277408_mapmaker2') or die('no db connection');

//check if the login form has been submitted
if(isset($_POST['go'])){
	#####form submitted, check data...#####
	
        //step 1a: sanitise and store data into vars (storing encrypted password)
	$usr = mysqli_real_escape_string($dbc, htmlentities($_POST['u_name']));
	$psw = SHA1($_POST['u_pass']) ; //using SHA1() to encrypt passwords  
     
        //step2: create query to check if username and password match
	$q = "SELECT * FROM users WHERE username='$usr' AND password='$psw'  ";
	
	//step3: run the query and store result
	$res = mysqli_query($dbc, $q);

	//make sure we have a positive result
	if(mysqli_num_rows($res) == 1){
		#########  LOGGING IN  ##########
		//starting a session  
                session_start();

                //creating a log SESSION VARIABLE that will persist through pages   
		$_SESSION['log'] = 'in';

		//redirecting to restricted page
		header('location:restricted.php');
	} else {
                //create an error message   
		$error = 'Wrong details. Please try again';	
	}
}//end isset go
?> 
<!-- HTML FORM GOES HERE -->
<!-- LOGIN FORM in: admin/index.php -->
<form method="post" action="#">
    <p><label for="u_name">username:</label></p>
    <p><input type="text" name="u_name" value=""></p>
    
    <p><label for="u_pass">password:</label></p>
    <p><input type="password" name="u_pass" value=""></p>
    
    <p><button type="submit" name="go">log me in</button></p>
</form>
<!-- A paragraph to display eventual errors -->
<p><strong><?php if(isset($error)){echo $error;}  ?></strong></p> 