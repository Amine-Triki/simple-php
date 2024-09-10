<?php
session_start();

// التحقق من أن المستخدم مسجل الدخول
if(!isset($_SESSION['user_id'])) {
    header('Location: signIn.php');
    exit();
}
?>

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
  <main class=" container  	mx-auto my-10">
    <div class="flex justify-center text-4xl ">
        <ps class="flex flex-col items-start w-96">
            <h2 class="my-10">
            First Name: <?php echo htmlspecialchars($_SESSION['first_name']); ?>
            </h2>
            <h2 class="my-10">
            Last Name: <?php echo htmlspecialchars($_SESSION['last_name']); ?>
            </h2>
            <h2 class="my-10">
            User Name: <?php echo htmlspecialchars($_SESSION['userName']); ?>
            </h2>
            <h2 class="my-10">
            Email: <?php echo htmlspecialchars($_SESSION['email']); ?>
            </h2>
            <h2 class="my-10">
            last login : <?php echo htmlspecialchars($_SESSION['last_login']); ?>
            </h2>
        </ps>
    </div>

  </main>
  
  <?php include 'footer.php'; ?>
</body>

</html>