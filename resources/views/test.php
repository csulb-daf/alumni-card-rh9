<?php

/**
 * Processing the sign-up form.
 *
 * NOTE: This is a procedural page, but it has NO output.
 *
 * PHP version 5
 *
 * @category   ITSWebApplication
 *
 * @author     Ed Lara <Ed.Lara@csulb.edu>
 * @author     Steven Orr <Steven.Orr@csulb.edu>
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (isset($_POST['submit'])) {
    // echo "session token " . $_SESSION['token'] . "<br />";
    // echo "Post token " .$_POST['csrf_token'] . "<br />";

    $filterArray = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if (! empty($filterArray)) {
        if ($_SESSION['token'] != $filterArray['csrf_token']) {
            header('HTTP/1.0 403 Forbidden');
            exit('Forbidden');
        }
    }
    require_once '_config.php';
    // echo "I got here 1";
    require_once '_connect-mysqli.php';
    // echo "I got here 2";
    // require_once '_connect-oracle.php';

    // echo "I got here 3";
    // exit();

    // elseif (!$oracle_connect) {
    // header("Location: resource-unavailable.php?err=Oracle%20Connect");
    // Stop and redirect, if any database resources are unavailable.
    if ($mysqli->connect_error) {
        header('Location: resource-unavailable.php?err=MySQLi%20Connect');
    } else {
        // Gather POST variables.
        $crs_date = $_POST['cdate'];
        $crs_end = date('G:i', strtotime($_POST['cetime']));
        $crs_id = $mysqli->real_escape_string($_POST['tid']);
        $crs_name = $_POST['course'];

        $crs_start = date('G:i', strtotime($_POST['cstime']));
        $crs_wait = $_POST['wait'];

        $reg_email = $mysqli->real_escape_string($_POST['e_mail']);

        $pos = strpos($reg_email, '@csulb.edu');

        if ($pos === false) {

            header("Location: signup.php?TID={$crs_id}&msg=invalidemail");
            exit();
        }

        $reg_empdiv = $_POST['division'];
        $reg_empdpt = $mysqli->real_escape_string($_POST['dept']);
        $reg_empid = $_POST['emp_id'];
        $reg_ext = $_POST['extension'];
        $reg_first = $mysqli->real_escape_string(ucfirst($_POST['fname']));
        $reg_last = $mysqli->real_escape_string(ucfirst($_POST['lname']));
        $reg_status = $_POST['emp_status'];
        $reg_super = (isset($_POST['super_email'])) ? $_POST['super_email'] : '';

        if (strlen($reg_first) < 2) {
            header("Location: signup.php?TID={$crs_id}&msg=first");
            exit();

        } elseif (strlen($reg_last) < 2) {
            header("Location: signup.php?TID={$crs_id}&msg=last");
            exit();
        } elseif (! isValidEmail($reg_email)) {
            header("Location: signup.php?TID={$crs_id}&msg=email");
            exit();
        } elseif (! is_numeric($reg_empid)) {

            header("Location: signup.php?TID={$crs_id}&msg=beachID");
            exit();
        }
        //

        $cleanid = trim($reg_empid);

        if (! is_numeric($cleanid)) {
            header("Location: signup.php?TID={$crs_id}&tip=true");
            exit();
        }

        // Send away if already signed up for course.
        $result = $mysqli->query("SELECT EmpID FROM Trainees WHERE Email='{$reg_email}' AND TID='{$crs_id}'");
        if ($result->num_rows > 0) {
            header("Location: signup.php?TID={$crs_id}&dup=1");
            exit();
        }
        $result->close();

        // Pull current course seat count and update variables.
        $result = $mysqli->query("SELECT TSeats,Email_Confirm,TWait,course_email FROM Training Where TID='{$crs_id}'");
        $row = $result->fetch_assoc();
        $email_from = (! is_null($row['course_email'])) ? $row['course_email'] : MAIL_GROUP;
        $email_msg = $row['Email_Confirm'];
        $newseats = (int) $row['TSeats'] - 1;
        $newwaits = (int) $row['TWait'] + $crs_wait;
        $result->close();

        // Update the appropriate seat count. If wait-listed they are not marked as attending, by default.
        if ($crs_wait) {
            $mysqli->query("UPDATE Training SET TWait={$newwaits} WHERE TID='{$crs_id}'");
            $attend = null;
        } else {

            // Update number of enrolled students, ONLY IF not already at zero.
            $mysqli->query("UPDATE Training SET TSeats={$newseats} WHERE TID='{$crs_id}' AND TSeats!=0");
            if (! $result) {
                header("Location: signup.php?TID=$id&full=true");
            }
            $attend = 1;
        }

        $asmResult = json_decode(file_get_contents('https://its-svcmgmt03.its.csulb.edu/oracle-external-api/training/'.$reg_empid), true);
        $asm_email = $asmResult['email_addr'];
        $asm_name = $asmResult['name'];

        // Pull ASM information.
        //   $asm_email = 'wdc@csulb.edu';
        //   $asm_name = 'Unknown';
        //   $parsed = oci_parse($oracle_connect, "SELECT EMAIL_ADDR,NAME FROM sysadm.PS_LB_HR_WO_ASM_VW WHERE emplid='{$reg_empid}'");
        //   $product = oci_execute($parsed);
        //   if (!$product) {
        //     // Cannot combine following function in Write context; must separate.
        //     $e = oci_error($parsed);
        //     if (empty($e)) {
        //       $e = oci_error();
        //     }
        //     $h = "MIME-Version: 1.0\r\nFrom: ".MAIL_GROUP;
        //     $m = "Environment: ".ENVIRONMENT."\nHost: ".ORACLE_SVR."\nDB: ".ORACLE_DBS."\nOCI Error: ".htmlentities($e['message'])."\nSQL: ".htmlentities($e['sqltext']);
        //     $s = "Oracle View Error: ".$_SERVER['REQUEST_URI'];
        //     mail('wdc@csulb.edu', $s, $m, $h);
        //   } else {
        //     $row = oci_fetch_array($parsed, OCI_ASSOC);
        //     $asm_email = $row['EMAIL_ADDR'];
        //     $asm_name = $row['NAME'];
        //   }
        //   oci_free_statement($parsed);

        // Prepare and insert new registrant.
        $cols = 'FirstName, LastName, Email, Division, Dept, ASM, EmpID, EmpStatus, Ext, '
            .'TDate, TStartTime, TEndTime, Description, TID, Attend, Wait';
        $vals = "'{$reg_first}', '{$reg_last}', '{$reg_email}', '{$reg_empdiv}', '{$reg_empdpt}', '{$asm_name}', "
            ."'{$reg_empid}', '{$reg_status}', '{$reg_ext}', "
            ."'{$crs_date}', '{$crs_start}', '{$crs_end}', '{$crs_name}', '{$crs_id}', '{$attend}', '{$crs_wait}'";
        $mysqli->query("INSERT INTO Trainees ( {$cols} ) VALUES ( {$vals} )");

        // Prepare and send appropriate email to registrant and ASM.
        $headers = "MIME-Version: 1.0\r\nContent-type:text/html;charset=iso-8859-1\r\nFrom: ".MAIL_GROUP."\r\n";
        if ($crs_wait) {
            $msg = "Thank you for your registration. You were put on a wait-list for *{$crs_name}* on *{$crs_date}*. ".'You will be contacted before the event if a seat becomes available. Have a great day! ';
        } else {
            $msg = $email_msg;
        }
        $to = "{$reg_email}";
        if ($config_alertASM) {
            $to .= ", {$asm_email}";
        }
        mail($to, 'Training Registration Confirmation', $msg, $headers);

        // send confirmation email to administrator
        $admin_headers = "MIME-Version: 1.0\r\nContent-type:text/html;charset=iso-8859-1\r\nFrom: ".MAIL_GROUP."\r\n";
        $admin_msg = '<p>This is a confirmation email for the following person: '.$reg_first.' &nbsp;'.$reg_last.'&nbsp;('.$reg_empid.')';
        $admin_msg .= (empty($email_msg)) ? 'You have been enrolled in a '.NAME_GROUP.' course.' : $email_msg;
        $admin_to = $email_from;
        mail($admin_to, 'Training Registration Confirmation', $admin_msg, $admin_headers);

        // send confirmation email to supervisor if selected
        if ($reg_super) {
            $super_headers = "MIME-Version: 1.0\r\nContent-type:text/html;charset=iso-8859-1\r\nFrom: ".MAIL_GROUP."\r\n";
            $super_msg = '<p>This is a confirmation email for the following person: '.$reg_first.' &nbsp;'.$reg_last.'&nbsp;('.$reg_empid.')';
            $super_msg .= (empty($email_msg)) ? 'You have been enrolled in a '.NAME_GROUP.' course.' : $email_msg;
            $super_to = $reg_super;
            mail($super_to, 'Training Registration : Supervisor Notification', $super_msg, $super_headers);
        }

        // oci_close($oracle_connect);
        $mysqli->close();

        header('Location: confirm.php');
    }
}
exit('Direct access not permitted');

function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
