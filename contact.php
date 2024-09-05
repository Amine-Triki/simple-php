<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Amine Triki</title>
  <meta name="description" content="amine triki web site">
  <meta name="keywords" content="amine triki , front end">
  <meta name="robots" content="index, follow">
  <meta name="author" content="amine triki">
  <link rel="stylesheet" href="./output.css">
</head>

<body>
  <?php include 'nav.php'; ?>

  <main class=" container  min-h-screen 	mx-auto my-10">

    <form class="p-20"  action="" method="POST">
      <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
          <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
          <input type="text" id="first_name" name="first_name"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="your first name" required />
        </div>
        <div>
          <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
          <input type="text" id="last_name" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="your last name" required />
        </div>

      </div>
      <div class="mb-6">
        <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">subject</label>
        <input type="text" id="subject"  name="subject" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="you subject" required />
      </div>
      <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required />
      </div>

      <div class="mb-6">

        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
        <textarea id="message" name="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
      </div>
        
      <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>

  </main>


  <?php include 'footer.php'; ?>
</body>

</html>

<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

 include 'config.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $subject = htmlspecialchars($_POST['subject']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Setting PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP Server Settings
        $mail->isSMTP();
        $mail->Host       = 'smtp-mail.outlook.com'; // SMTP server for service provider
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USER; // Your email
        $mail->Password   = SMTP_PASS; //mail password    
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587; // SMTP port for TLS

        // Email Settings
        $mail->setFrom('test.codeigniter4@outlook.com', "$firstName $lastName");
        $mail->addAddress('test.codeigniter4@outlook.com'); // Who will the mail be sent to?
        $mail->addReplyTo($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New message from $firstName $lastName: $subject";
        $mail->Body    = "
            <h3>New message</h3>
            <p><strong>Name:</strong> $firstName $lastName</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        // Send Email
        $mail->send();
        echo 'Message sent successfully!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  var_dump($_POST);
}

?>
