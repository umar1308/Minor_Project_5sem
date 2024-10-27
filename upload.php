<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
 <!-- Navbar -->
 <nav class="bg-white shadow-lg fixed w-full z-10 top-0">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <!-- Logo -->
      <a href="#" class="text-2xl font-bold text-purple-700">Certify'em</a>

      <!-- Hamburger Menu (Hidden on large screens) -->
      <div class="md:hidden">
        <button id="nav-toggle" class="text-purple-700 focus:outline-none">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>

      <!-- Nav Links -->
      <div id="nav-menu" class="hidden md:flex space-x-6">
        <a href="#" class="text-gray-700 hover:text-purple-700">Home</a>
        <a href="#" class="text-gray-700 hover:text-purple-700">About</a>
        <a href="#" class="text-gray-700 hover:text-purple-700">Logout</a>
      </div>
    </div>

    <!-- Mobile Nav Links -->
    <div id="mobile-menu" class="hidden bg-white md:hidden">
      <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-purple-100">Home</a>
      <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-purple-100">About</a>
      <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-purple-100">Logout</a>
    </div>
  </nav>
  <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full" style="margin-top:100px;margin-left:35%;">
  <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Data Entered Successfully !</h2>
  <a href="upload.html" style="color:blue;margin:auto;">Add Another</a><br>
        <a href="dashboard.html" style="color:blue;margin:auto;">Go to Dashboard..</a>
    
    </div>
<?php
 $tempname = null;
 $folder = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dept = $_POST['dept'];
    
    // Check if 'certi' is set in $_FILES and assign the name if it exists
    $certi = isset($_FILES['certi']['name']) ? $_FILES['certi']['name'] : null;
    
    // Ensure that 'certi' is uploaded
    if ($certi) {
        $tempname = $_FILES['certi']['tmp_name'];
        $folder = "upload_certi/" . $certi;

        // Move the uploaded file to the designated folder
        if (move_uploaded_file($tempname, $folder)) {
            echo "File uploaded successfully!";
        } else {
            echo "Failed to upload file.";
        }
    } else {
        echo "No file was uploaded.";
    }
}


$host="localhost";
$user="root";
$password="root123";
$db="certi";
$conn=mysqli_connect($host,$user,$password,$db);
if(!$conn){
    echo "Try again in few minutes........" ;
}
else{
    $sql="Insert into upload_certi(name,email,dept,certi) values('$name','$email','$dept','$certi')";
    $result=mysqli_query($conn, $sql);
    if($result){
        echo "?";
    }
    else{
        echo "<h3>Some Error occured</h3>";
    }
   
    if(move_uploaded_file($tempname,$folder)){
        echo "uploaded successfully";
    }
    else{
        echo "not uploaded";
    }
}
mysqli_close($conn);
$host="localhost";
$user="root";
$password="root123";
$db="certi";
$conn=mysqli_connect($host,$user,$password,$db);
if(!$conn){
    echo "Try again in few minutes........" ;
}
else{
    $name = $_POST['name'];
    $email=$_POST['email'];

// Prepare the SQL query using placeholders
$sql = "SELECT serial_number FROM upload_certi WHERE name = '$name' AND email='$email' ";
    $result=mysqli_query($conn, $sql);
    if($result){
        while ($row = mysqli_fetch_assoc($result)) {
            $serial= $row['serial_number'] ;
    }
}
    else{
        echo "<h3>Some Error occured</h3>";
    }
   

}
mysqli_close($conn);





use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        

       
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mdumar1303@gmail.com';                     //SMTP username
    $mail->Password   = 'beao wibu mllr ahbm';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mdumar1303@gmail.com', 'Certify,em');
    $mail->addAddress($email, '');     //Add a recipient
    //$mail->addAddress('info@dziredestinationstravel.com', 'Recipient 2');


    //Attachments


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'You got a Certificate';
    $mail->Body    = "Dear $name,<br>
    You have earned a certificate <br>Kindly find the below the Serial Number and enter this on Certify'em.com to downlo
    ad your certificate.<br><h3> $serial </h3><br><br>Warm Regards<br>Certify'em
    ";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>           
     <script>
      // Toggle mobile menu visibility
      document.getElementById("nav-toggle").onclick = function () {
        document.getElementById("mobile-menu").classList.toggle("hidden");
      };
    </script>
</body>
</html>
