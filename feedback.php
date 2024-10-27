<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Certification Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 min-h-screen font-sans">
  <!-- Navbar -->
  <nav class="bg-white shadow-lg fixed w-full z-10 top-0">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <!-- Logo -->
      <a href="#" class="text-2xl font-bold text-purple-700">CertifyMe</a>

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
  <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Thank You so much!</h2>
        <p class="text-gray-600 text-center mb-6">We value your feedback  ! </p>
        <a href="dashboard.html" style="color:blue;margin:auto;">Go to Dashboard..</a>
    
    </div>
<?php
$name=$_POST['name'];
$email=$_POST['email'];
$body=$_POST['feedback'];
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
    $mail->addAddress('faiz40449@gmail.com', '');     //Add a recipient
    //$mail->addAddress('info@dziredestinationstravel.com', 'Recipient 2');


    //Attachments


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Feedback(Certify)';
    $mail->Body    = "from $email <br>
    $body
    ";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
           

?>

</body>
</html>