<?php
    $time = time();
    $to = "quangthe2104@gmail.com, thele@ecpvn.com, test@lac.edu.vn, test@gmhn.edu.vn, test@cokhi19-8.vn";
    $from = 'admin@pif.vn';
    $name = 'Passion Investment';
    $headers = "MIME-Version: 1.0\r\n";
    $headers.= "From: =?utf-8?b?".base64_encode($name)."?= <".$from_a.">\r\n";
    $headers.= "Content-Type: text/plain;charset=utf-8\r\n";
    $headers.= "X-Mailer: PHP/" . phpversion();
    $subject = 'Email gửi để test mail từ hệ thống lúc '.date("Y-m-d H:i:s", $time) ;
    $body = "Email này được gửi đi từ hệ thống đến các email ". $to; 

    $send = mail($to, $subject, $body, $headers);
    echo $body;
?>
