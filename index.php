<?php
	include("config.php");
	#ob_start();
	session_start();
	$error = "";
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		// username and password sent from form 
		$login_user = $_POST['username'];
		$login_pwd = $_POST['password']; 
		# Create connection to Heroku Postgres
		$pg_heroku = pg_connect($conn_string);
		# Get data by query
		$sql = "SELECT * FROM users WHERE username = '$login_user' and password = '$login_pwd'";
		$result = pg_query($pg_heroku,$sql);
		
		$num_rows = pg_num_rows($result);

		// If result matched $login_user and $login_pwd, table row must be 1 row
		if($num_rows == 1) 
		{
			$row = pg_fetch_array($result, 0);
			$users = $row['username'];
			$pass = $row['password'];
		}
        else 
		{
			$error = "Your Login Name or Password is invalid";
		}	
			if ($users == "emyeuanh" && $pass == "141520")
			{
				#echo "lgoin for admin";
				header("location: mylove.php");
			}
			
			pg_close();	
		}
		
?>

<html> 

   <head>
	
      <title> Hi My Love </title>
     <style>
      body {
        background-image: url('huy1.jpeg');
        background-attachment: fixed;
        background-size: 100%100%;
      }
    </style>
      
   </head>
   
   <body>
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Đăng nhập để được tiếp tục nha em yêu:</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Username  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = "Submit"/><br />
				</form>
                <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
               
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>
