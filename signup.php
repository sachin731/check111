<?php
session_start();
if(isset($_SESSION['username'])) 
header('location:myaccount.php'); 
$row_cnt=0;
$msg="";
// Create connection
$con = mysqli_connect("localhost", "root", "", "student");
// Check connection
if (mysqli_connect_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST['submit']) && $_POST['submit'] == "Submit"){
     
     $query="SELECT * FROM tstudent WHERE   username='".$_POST['username']."' ";
    $ex = mysqli_query($con, $query) or die(mysqli_error($con));
    
if ($result = mysqli_query($con, $query)) {
    $row_cnt = mysqli_num_rows($result);

    if($row_cnt==1){
     $msg= "user already exist";
 }else{
     $sql="INSERT INTO tstudent SET
        username='".$_POST['username']."',
        password='".$_POST['password']."',
        firstname='".$_POST['firstname']."',
        lastname='".$_POST['lastname']."',
        emailid='".$_POST['emailid']."',
        gender='".$_POST['gender']."',
        birthday_month='".$_POST['birthday_month']."',
        birthday_day='".$_POST['birthday_day']."',
        birthday_year='".$_POST['birthday_year']."'
       ";
    
 if (!mysqli_query($con,$sql))
 {
 die('Error:' . mysqli_error());
 }
 }
//echo "1 record added";
   mysqli_free_result($result);
  
mysqli_close($con);
 }


}
//print_r($_POST);
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css.css">
        <script type="text/javascript">
            function validateform()
            {
                var f = document.form;
                var username = f.username;
                if (username.value == null || username.value == "")
                {
                    alert("Please enter user name");
                    username.focus();
                    return false;
                }
                 var f = document.form;
                var password = f.password;
                if (password.value == null || password.value == "")
                {
                    alert("Please enter password");
                    password.focus();
                    return false;
                }
                var f = document.form;
                var firstname = f.firstname;
                if (firstname.value == null || firstname.value == "")
                {
                    alert("Please enter first name");
                    firstname.focus();
                    return false;
                }
                var f = document.form;
                var lastname = f.lastname;
                if (lastname.value == null || lastname.value == "")
                {
                    alert("Please enter last name");
                    lastname.focus();
                    return false;
                }
                
                  var x = document.form.emailid.value;
                var atpos = x.indexOf("@");
                var dotpos = x.lastIndexOf(".");
                if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length)
                {
                    alert(" email must be valid out");
                    document.form.emailid.focus();
                    return false;
                }
             
                  var p = document.form.gender.value;
                if ((document.form.gender[0].checked == false)
                        && (document.form.gender[1].checked == false))
                {
                    alert("Please choose your Gender: Male or Female");
                    return false;
                }
                
                var a = document.form.birthday_month.value
                if (a == "") //for text use if(strUser1=="Select")
                {
                    alert("Please select a month.");
                   document.form.birthday_month.focus();
                    return false;
                }
                var b = document.form.birthday_day.value
                if (b == "") //for text use if(strUser1=="Select")
                {
                    alert("Please select a day.");
                   document.form.birthday_day.focus();
                    return false;
                }
                var c = document.form.birthday_year.value
                if (c == "") //for text use if(strUser1=="Select")
                {
                    alert("Please select a year.");
                   document.form.birthday_year.focus();
                    return false;
                }
                
            }
           </script>
    </head>
    <body>
<div id="bg">
	<div id="block">
		<div id="form">
                    
                    <form name="form" action="signup.php" onsubmit="return validateform()" method="post">
			
                        <div id="aa"> <p class="signup">&nbsp;&nbsp;<b>Sign up</b></p>
                        &nbsp;&nbsp;    <a href="login.php">Login</a><hr>
                        <div id="data">
                            <h6><b>Username:<br> <input type="text" name="username" value="<?php echo isset($_POST['username'])?$_POST['username']:'' ?>">   <?php  echo "$msg"?> <br>
                                    Password:<br> <input type="password" name="password" value="<?php echo isset($_POST['password'])?$_POST['password']:'' ?>" > <br>
                               First name:<br> <input type="text" name="firstname" value="<?php echo isset($_POST['firstname'])?$_POST['firstname']:'' ?>" ><br>
                                Last name:<br> <input type="text" name="lastname" value="<?php echo isset($_POST['lastname'])?$_POST['lastname']:'' ?>" ><br>
                                Email id: <br> <input type="text" name="emailid" value="<?php echo isset($_POST['emailid'])?$_POST['emailid']:'' ?>" ><br>
                                Gender:<br><input type="radio" name="gender"   value="male" <?php echo @$_POST['gender'] == 'male' ? 'checked' : '' ?> >&nbsp;Male
                                <input type="radio" name="gender" value="female" <?php echo @$_POST['gender'] == 'female' ? 'checked' : '' ?> >&nbsp;Female<br>
                                        
                                        
                              Dob:<br><select name="birthday_month">
                                            <option value="">month</option>
                                            <option value="jan"<?php echo @$_POST['birthday_month'] == 'jan' ? 'selected' : '' ?>>Jan</option>
                                            <option value="feb"<?php echo @$_POST['birthday_month'] == 'feb' ? 'selected' : '' ?>>Feb</option>
                                            <option value="mar"<?php echo @$_POST['birthday_month'] == 'mar' ? 'selected' : '' ?>>Mar</option>
                                             <option value="apr"<?php echo @$_POST['birthday_month'] == 'apr' ? 'selected' : '' ?>>Apr</option>
                                            <option value="may"<?php echo @$_POST['birthday_month'] == 'may' ? 'selected' : '' ?>>May</option>
                                            <option value="june"<?php echo @$_POST['birthday_month'] == 'june' ? 'selected' : '' ?>>June</option>
                                             <option value="july"<?php echo @$_POST['birthday_month'] == 'july' ? 'selected' : '' ?>>July</option>
                                            <option value="aug"<?php echo @$_POST['birthday_month'] == 'aug' ? 'selected' : '' ?>>Aug</option>
                                            <option value="sept"<?php echo @$_POST['birthday_month'] == 'sept' ? 'selected' : '' ?>>Sept</option>
                                             <option value="oct"<?php echo @$_POST['birthday_month'] == 'oct' ? 'selected' : '' ?>>Oct</option>
                                            <option value="nov"<?php echo @$_POST['birthday_month'] == 'nov' ? 'selected' : '' ?>>Nov</option>
                                            <option value="dec"<?php echo @$_POST['birthday_month'] == 'dec' ? 'selected' : '' ?>>Dec</option>
                                           
                                            </select>
                                 <select name="birthday_day">
                                            <option value="">Day:</option>
                                            <option value="1"<?php echo @$_POST['birthday_day'] == '1' ? 'selected' : '' ?>>1</option>
                                            <option value="2"<?php echo @$_POST['birthday_day'] == '2' ? 'selected' : '' ?>>2</option>
                                            <option value="3"<?php echo @$_POST['birthday_day'] == '3' ? 'selected' : '' ?>>3</option>
                                            <option value="4"<?php echo @$_POST['birthday_day'] == '4' ? 'selected' : '' ?>>4</option>
                                            <option value="5"<?php echo @$_POST['birthday_day'] == '5' ? 'selected' : '' ?>>5</option>
                                            <option value="6"<?php echo @$_POST['birthday_day'] == '6' ? 'selected' : '' ?>>6</option>
                                            <option value="7"<?php echo @$_POST['birthday_day'] == '7' ? 'selected' : '' ?>>7</option>
                                            <option value="8"<?php echo @$_POST['birthday_day'] == '8' ? 'selected' : '' ?>>8</option>
                                            <option value="9"<?php echo @$_POST['birthday_day'] == '9' ? 'selected' : '' ?>>9</option>
                                            <option value="10"<?php echo @$_POST['birthday_day'] == '10' ? 'selected' : '' ?>>10</option>
                                            <option value="11"<?php echo @$_POST['birthday_day'] == '11' ? 'selected' : '' ?>>11</option>
                                            <option value="12"<?php echo @$_POST['birthday_day'] == '12' ? 'selected' : '' ?>>12</option>
                                            <option value="13"<?php echo @$_POST['birthday_day'] == '13' ? 'selected' : '' ?>>13</option>
                                            <option value="14"<?php echo @$_POST['birthday_day'] == '14' ? 'selected' : '' ?>>14</option>
                                            <option value="15"<?php echo @$_POST['birthday_day'] == '15' ? 'selected' : '' ?>>15</option>
                                            <option value="16"<?php echo @$_POST['birthday_day'] == '16' ? 'selected' : '' ?>>16</option>
                                            <option value="17"<?php echo @$_POST['birthday_day'] == '17' ? 'selected' : '' ?>>17</option>
                                            <option value="18"<?php echo @$_POST['birthday_day'] == '18' ? 'selected' : '' ?>>18</option>
                                            <option value="19"<?php echo @$_POST['birthday_day'] == '19' ? 'selected' : '' ?>>19</option>
                                            <option value="20"<?php echo @$_POST['birthday_day'] == '20' ? 'selected' : '' ?>>20</option>
                                            <option value="21"<?php echo @$_POST['birthday_day'] == '21' ? 'selected' : '' ?>>21</option>
                                            <option value="22"<?php echo @$_POST['birthday_day'] == '22' ? 'selected' : '' ?>>22</option>
                                            <option value="23"<?php echo @$_POST['birthday_day'] == '23' ? 'selected' : '' ?>>23</option>
                                            <option value="24"<?php echo @$_POST['birthday_day'] == '24' ? 'selected' : '' ?>>24</option>
                                            <option value="25"<?php echo @$_POST['birthday_day'] == '25' ? 'selected' : '' ?>>25</option>
                                            <option value="26"<?php echo @$_POST['birthday_day'] == '26' ? 'selected' : '' ?>>26</option>
                                            <option value="27"<?php echo @$_POST['birthday_day'] == '27' ? 'selected' : '' ?>>27</option>
                                            <option value="28"<?php echo @$_POST['birthday_day'] == '28' ? 'selected' : '' ?>>28</option>
                                            <option value="29"<?php echo @$_POST['birthday_day'] == '29' ? 'selected' : '' ?>>29</option>
                                            <option value="30"<?php echo @$_POST['birthday_day'] == '30' ? 'selected' : '' ?>>30</option>
                                            <option value="31"<?php echo @$_POST['birthday_day'] == '31' ? 'selected' : '' ?>>31</option>
                                             </select>
                                            
                                <select name="birthday_year" >
                                            <option value="">Year:</option>
                                            <option value="2013"<?php echo @$_POST['birthday_year'] == '2013' ? 'selected' : '' ?>>2013</option>
                                            <option value="2012"<?php echo @$_POST['birthday_year'] == '2012' ? 'selected' : '' ?>>2012</option>
                                            <option value="2011"<?php echo @$_POST['birthday_year'] == '2011' ? 'selected' : '' ?>>2011</option>
                                            <option value="2010"<?php echo @$_POST['birthday_year'] == '2010' ? 'selected' : '' ?>>2010</option>
                                            <option value="2009"<?php echo @$_POST['birthday_year'] == '2009' ? 'selected' : '' ?>>2009</option>
                                            <option value="2008"<?php echo @$_POST['birthday_year'] == '2008' ? 'selected' : '' ?>>2008</option>
                                            <option value="2007"<?php echo @$_POST['birthday_year'] == '2007' ? 'selected' : '' ?>>2007</option>
                                            <option value="2006"<?php echo @$_POST['birthday_year'] == '2006' ? 'selected' : '' ?>>2006</option>
                                            <option value="2005"<?php echo @$_POST['birthday_year'] == '2005' ? 'selected' : '' ?>>2005</option>
                                            <option value="2004"<?php echo @$_POST['birthday_year'] == '2004' ? 'selected' : '' ?>>2004</option>
                                            <option value="2003"<?php echo @$_POST['birthday_year'] == '2003' ? 'selected' : '' ?>>2003</option>
                                            <option value="2002"<?php echo @$_POST['birthday_year'] == '2002' ? 'selected' : '' ?>>2002</option>
                                            <option value="2001"<?php echo @$_POST['birthday_year'] == '2001' ? 'selected' : '' ?>>2001</option>
                                            <option value="2000"<?php echo @$_POST['birthday_year'] == '2000' ? 'selected' : '' ?>>2000</option
                                </select><br> <a><input type="submit" name="submit" value="Submit"></a>
                                </b>
                                
                            </h6>   
                            </form>	
                        </div
                        </div>
                </div>         <!-- form end-->
	</div>		<!--block end-->
</div> 
 </body>
</html>