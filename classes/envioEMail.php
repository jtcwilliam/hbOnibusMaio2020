<?php
// The message
$message = "Line 1\nLine 2\nLine 3";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70);

// Send
if(mail('jtcwilliam@gmail.com', 'My Subject', $message))
{
    echo 'email enviado';
}
?>