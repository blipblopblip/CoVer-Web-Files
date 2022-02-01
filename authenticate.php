<?php 
    session_start();
    require_once('connection.php');
    function Decrypt($strToDecrypt){
        global $strD;
        $key64 = "cPSQAC05GBXzMhRRz7tm8cqg+vHdHyN5";
        $iv64 = "jIShBJVBfXo=";
        $encryptedString64 = $strToDecrypt;
        $keybytes = base64_decode($key64);
        $ivbytes = base64_decode($iv64);
         
        $encryptedStringbytes = base64_decode($encryptedString64);
         
        // use mcrypt library for encryption
        $decryptRaw = mcrypt_decrypt(MCRYPT_3DES, $keybytes, $encryptedStringbytes, MCRYPT_MODE_CBC, $ivbytes);
        $decryptString=trim($decryptRaw,"\x00..\x1F");
        print "Decrypted by PHP:<br>$decryptString<br/>"; //The decrypted string should be "blueberry"
    }

    if(isset($_POST['login']))
    {
        $bday = mysqli_real_escape_string($conn,$_POST['bday']);
        $key1 = mysqli_real_escape_string($conn,$_POST['key1']);

        if(!empty($bday) && !empty($key1))
        {            
            global $strD;
            $key64 = "cPSQAC05GBXzMhRRz7tm8cqg+vHdHyN5";
            $iv64 = "jIShBJVBfXo=";
            $encryptedString64 = $key1;
            $keybytes = base64_decode($key64);
            $ivbytes = base64_decode($iv64);
             
            $encryptedStringbytes = base64_decode($encryptedString64);
             
            // use mcrypt library for encryption
            $decryptRaw = mcrypt_decrypt(MCRYPT_3DES, $keybytes, $encryptedStringbytes, MCRYPT_MODE_CBC, $ivbytes);
            $decryptString=trim($decryptRaw,"\x00..\x1F");
            // print "Decrypted by PHP:<br>$decryptString<br/>"; //The decrypted string should be "blueberry"

            echo $decryptString;
            $sql = "SELECT a.ID FROM tbl_customer a 
            INNER JOIN tbl_swabissuance b on a.ID = b.CustomerID WHERE a.Birthday = '$bday' and b.SwabIssuanceCode = '$decryptString'";
            
            $result = mysqli_query($conn,$sql);
            if (!$result) {
                printf("Error: %s\n", mysqli_error($conn));
                exit();
            }
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $ID = $row['ID'];
            $count = mysqli_num_rows($result);
            
            // If result matched $myusername and $mypassword, table row must be 1 row
                
            if($count == 1) {
               $_SESSION['login_userid'] = $ID;
                header("location: index.php");
            }
            else {
                $error = "Invalid Account";
                $_SESSION["error"] = $error;
                header("location: login.php?key1=".$key1); //send user back to the login page.
            }
        } 
        else if(empty(['key1'])) {
            $error = "Invalid Private Key";
            $_SESSION["error"] = $error;
            header('location: login.php');
        }
        else {
            header('location: login.php');
        }
    } 
    else {
        header('location: login.php');
    }
?>