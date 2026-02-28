<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Setup - Update this to your business email
    $to = "your-email@domain.com"; 
    $formType = $_POST['form_type']; // Tells us which form was used

    // 2. Common Fields (Used by both forms)
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    // 3. Logic Switch
    if ($formType == "booking") {
        // Booking Specific Fields
        $phone = strip_tags(trim($_POST["phone"]));
        $vehicle = strip_tags(trim($_POST["vehicle"]));
        $service = $_POST['service'];
        $date = $_POST['date'];

        $subject = "New Booking: $service - $name";
        
        $email_content = "--- NEW BOOKING REQUEST ---\n\n";
        $email_content .= "Client Name: $name\n";
        $email_content .= "Phone: $phone\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Vehicle: $vehicle\n";
        $email_content .= "Service: $service\n";
        $email_content .= "Preferred Date: $date\n\n";
        $email_content .= "Notes:\n$message\n";

    } else {
        // Contact Specific Fields
        $user_subject = strip_tags(trim($_POST["subject"]));
        $subject = "Contact Inquiry: " . ($user_subject ? $user_subject : $name);

        $email_content = "--- NEW CONTACT INQUIRY ---\n\n";
        $email_content .= "Name: $name\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Subject: $user_subject\n\n";
        $email_content .= "Message:\n$message\n";
    }

    // 4. Email Headers
    // Note: Some hosts require the 'From' to be an email @yourdomain.com
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";

    // 5. Send and Redirect
    if (mail($to, $subject, $email_content, $headers)) {
        // Redirect back to home with success parameter for the popup
        header("Location: index.html?status=success");
        exit;
    } else {
        // Redirect back with error if mail fails
        header("Location: index.html?status=error");
        exit;
    }

} else {
    // Prevent direct access to the script
    header("Location: index.html");
    exit;
}
?>
