<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <title>Certify'em | Your Certificate</title>
    <style>
        /* Ensure background images are printed */
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }
        .certificate{
            background-image:url('https://i.pinimg.com/736x/ab/17/9e/ab179e4552f76f9ac0e8130bfd90b174.jpg');
            background-size:cover;
        }
    </style>
</head>
<body>
    <?php
        error_reporting(E_ALL & ~E_NOTICE);
        $serial=$_POST["serial_number"];
        if($serial==""){
            echo "PLease go back and enter a valid Serial number";
        }
        else{
            
            $serial_number=intval($serial);
           
            $host="localhost";
            $user="root";
            $password="root123";
            $db="certi";
            $conn=mysqli_connect($host,$user,$password,$db);
            if(!$conn){
                echo "Try again in few minutes........" ;
            }
            else{
                $sql="select * from certificate where serial_number='$serial_number'";
                $sql1="select * from upload_certi where serial_number='$serial_number'";
                $result=mysqli_query($conn, $sql);
                $result1=mysqli_query($conn,$sql1);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $name=$row['name'];
                        $event=$row['event'];
                        $date= date('Y-m-d',strtotime($row['date']));
                        $e=$row['email'];
                        $college=$row['venue'];
                        $dean=$row['dean_name'];
                        $dept=$row['dept'];

                       echo "<certificate>
        <div class='certificate' style='border:1px solid grey;text-align:center;border-radius:5px;padding:30px;width:700px;height:500px;margin:auto;box-shadow:6px 4px 10px grey;'>
            
            <div class='certificate-body' style='padding:10px;border-radius:5px;margin-top:50px;'>
                <div class='certificate-heading'>
                    <h2 style='font-family:'old english text mt';font-size:45px;'>Certifcate of Acheivement</h2>
                </div>
                <p>This is to certify that</p>
                <h3 style='font-family:'times new roman'; font-weight:bold;font-style:italics;'>$name</h3>
                <hr>
                <p style='font-family:'times new roman';'>Has contributed in the $event on the date <b>$date</b> held at <b>$college </b>.<br>We recognize the effort annd wish him/her all the best for the future</p>
                <h4>$dean</h4>
                <p>Dean-$dept</p>
                <p style='font-size:5px;'d>Digitally Signed</p>
            </div>
        </div>
    </certificate><br>";
                    }
                    
                }
                else if(mysqli_num_rows($result1) > 0){
                    while($row = mysqli_fetch_assoc($result1)){
                        echo "<div class='upload_certi' style='width:700px;height:500px;margin:auto;'>
                                <img src='upload_certi/".$row['certi'] ."' style='width:700px;height:500px;' >
                              </div>";
                    }
                }
                
                

            }
            mysqli_close($conn);
        }
    ?>
    <br><br>


    
    <div class="download-btn" style="width:fit-content;margin:auto;">
        <button onclick="printPage()" style="width:200px;background-color:red; color:white;border:none;heught:50px;">Download as PDF</button>

    </div>
    <br><br>
    
<script>
function printPage() {
    window.print();
}
</script>
    

</body>
</html>