//customer registration form
if(isset($_POST["customer"])){
	// if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['email']) || empty($_POST['contact'] || 
	// empty($_POST['alt_contact'])|| empty($_POST['sex'])|| empty($_POST['vehicleType'])|| empty($_POST['password']) || empty($_FILES['image'])){
	// 	header("Location: customer.php?error=All inputs required!");
	//     exit();
	//  }else{}

	 
	$fatName=$_POST['fname'];
	$fatName=mysqli_real_escape_string($conn,$fatName);
	$lName=$_POST['lname'];
	$lName=mysqli_real_escape_string($conn,$lName);
    $email=$_POST['email'];
	$email=mysqli_real_escape_string($conn,$email);
	$contact=$_POST['contact'];
	$contact=mysqli_real_escape_string($conn,$contact);
	$alternative=$_POST['alt_contact'];
	$alternative=mysqli_real_escape_string($conn,$alternative);
	$sex=$_POST['sex'];
	$sex=mysqli_real_escape_string($conn,$sex);
	$vehicleType=$_POST['vehicleType'];
	$vehicleType=mysqli_real_escape_string($conn,$vehicleType);$password=$_POST['password'];
	$password=mysqli_real_escape_string($conn,$password);

    //email check
    $email_check="SELECT * FROM customer WHERE email='{$email}'";
        $sql=mysqli_query($conn,$email_check);

        if($sql){
            if(mysqli_num_rows($sql)>0){
                header("Location: customer.php?error=Email already exists!");
	    exit();
            }else{ 
				if(isset($_POST['customer'])){
 
					$name = $_FILES['img']['name'];
					$target_dir = "upload/";
					$target_file = $target_dir . basename($_FILES["img"]["name"]);
					
				  
					// Select file type
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				  
					// Valid file extensions
					$extensions_arr = array("jpg","jpeg","png","gif");
				  
					// Check extension
					if( in_array($imageFileType,$extensions_arr) ){
					   // Upload file
					   if(move_uploaded_file($_FILES['img']['tmp_name'],$target_dir.$name)){
						echo"success";
					   }
					}else{
						header("Location: customer.php?error=Choose a jpg,jpeg,gif or png!");
	    exit();
					}
				}
				
					$sql_insert="INSERT INTO customer (fname,lname,email,contact,alt_contact,sex,vehicleType,password,img) VALUES 
					('$fatName','$lName','$email','$contact','$alternative','$sex','$vehicleType','".md5($password)."','$target_file')";
					$sql_query=mysqli_query($conn,$sql_insert);
					if($sql_query==TRUE){
						header('location:index.php?success=Your account has been created successfully!');
					}
				
					else {
						header("Location: customer.php?error=Oops, Something went wrong!&$user_data");
						exit();
					}
            }
        }
	
    }
