<?php
    include('connection.php');
    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($conn, $_POST['user']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpass']);

        
        //Check's  Thus this Username And Exist Before
        $sql = "Select * from signup where username='$username'";
        $result = mysqli_query($conn, $sql);        
        $count_user = mysqli_num_rows($result);  

        $sql = "Select * from signup where email='$email'";
        $result = mysqli_query($conn, $sql);        
        $count_email = mysqli_num_rows($result);  
        
        if($count_user == 0 && $count_email==0){  
            
            if($password == $cpassword) {
                
                // $hash = password_hash($password,  PASSWORD_DEFAULT);
                     
                // Password Hashing is not used here. 
                $sql = "INSERT INTO signup(username, email, password) VALUES('$username', '$email','$password')";
        
                $result = mysqli_query($conn, $sql);
        
                if ($result) {
                    header("Location: index.php");
                }
            } 
            else { 
                echo  '<script>
                       
                        alert("Passwords do not match")
                        window.location.href = "first.php";
                       
                    </script>';
            }      
        }  
        else{  
            if($count_user>0){
                echo  '<script>
                        window.location.href = "first.php";
                        alert("Username already exists!!")
                    </script>';
            }
            if($count_email>0){
                echo  '<script>
                        window.location.href = "first.php";
                        alert("Email already exists!!")
                    </script>';
            }
        }     
    }
    ?>