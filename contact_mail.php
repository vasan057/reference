<?php

if (isset($_POST['Con_submit'])) {

    $Con_name = $_POST['Con_name'];
    $Con_email = $_POST['Con_email'];
    $Con_phone = $_POST['Con_phone'];
    $Con_project = $_POST['Con_project'];
    $Con_bud = $_POST['Con_bud'];
    $Con_msg = $_POST['Con_msg'];


    //$to = 'vani.gvel@gmail.com';
    $to = 'info@falconnecttech.com';
    $headers = "From: " .$Con_email. "\r\n";
    $headers .= "Reply-To: info@falconnecttech.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    $subject = "Contact Forms";

    $message = '<div style="background-color:#F2F2F2; width:100%; height:100%; position:relative; float:left;" >
    <div style="width:590px; position:relative; margin:40px auto; padding-bottom:15px;">
        <div style="width:100%; float:left; z-index:100; height:auto; min-height:200px; background:#FFF; position:relative; ">
        <table style=" width: 100%;">
            <tbody>
                <tr>
                    <td colspan="2"><h3 style="text-align: center;text-transform: uppercase; background: #FF5F5F; color: #fff;padding: 7px 0px; border-radius: 5px;">Dear Admin</h3></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #D0D0D0;padding: 5px;">Name</td><td style="border: 1px solid #D0D0D0;padding: 5px;">' .$Con_name. '</td>					
                </tr>
                 <tr>
                    <td style="border: 1px solid #D0D0D0;padding: 5px;">Phone</td><td style="border: 1px solid #D0D0D0;padding: 5px;">' .$Con_email. '</td>					
                </tr>
				<tr>
                    <td style="border: 1px solid #D0D0D0;padding: 5px;">Email</td><td style="border: 1px solid #D0D0D0;padding: 5px;">' .$Con_phone. '</td>					
                </tr>
              
				<tr>
                    <td style="border: 1px solid #D0D0D0;padding: 5px;">Package</td><td style="border: 1px solid #D0D0D0;padding: 5px;">' .$Con_project. '</td>					
                </tr>
				<tr>
                    <td style="border: 1px solid #D0D0D0;padding: 5px;">Date</td><td style="border: 1px solid #D0D0D0;padding: 5px;">' .$Con_bud. '</td>					
                </tr>
				<tr>
                    <td style="border: 1px solid #D0D0D0;padding: 5px;">Adult</td><td style="border: 1px solid #D0D0D0;padding: 5px;">' .$Con_msg. '</td>					
                </tr>
		
            </tbody>
        </table>
        <div style="width:100%; height:20px;font-family:Arial,Helvetica,sans-serif;font-size:16px;color:#5e5d5d;line-height:20px;float:left;"></div>
                
		</div>
	</div>
</div>';
echo "<pre>";
    print_r($headers);
    
    if (mail($to, $subject, $message, $headers)) {
        return json_encode(array('success'=>"Successful"));
    } else {
        return json_encode(array('failed'=>"Failed"));
    }
}
?>