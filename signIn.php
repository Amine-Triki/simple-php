<?php
session_start(); // بدء الجلسة في بداية الصفحة

// الاتصال بقاعدة البيانات
$db = new PDO('sqlite:database.db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // الحصول على البيانات المدخلة
    $email = $_POST['email'];
    $password = $_POST['password'];

    // البحث عن المستخدم في قاعدة البيانات
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // التحقق من كلمة المرور
        if (password_verify($password, $user['password'])) {
            // تحديث وقت آخر تسجيل دخول
            $updateQuery = "UPDATE users SET last_login = :last_login WHERE id = :id";
            $stmt = $db->prepare($updateQuery);
            $last_login = date('Y-m-d H:i:s'); // تعيين وقت آخر تسجيل دخول
            $stmt->bindParam(':last_login', $last_login);
            $stmt->bindParam(':id', $user['id']);
            $stmt->execute();
    
            // حفظ بيانات المستخدم في الجلسة
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['userName'] = $user['userName'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['last_login'] = $last_login;
    
            // إعادة التوجيه إلى الصفحة الشخصية
            header('Location: profile.php');
            exit();
        } else {
            echo "كلمة المرور غير صحيحة";
        }
    } else {
        echo "المستخدم غير موجود";
    }
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Amine Triki -- sign in</title>
  <meta name="description" content="amine triki web site">
  <meta name="keywords" content="amine triki , front end">
  <meta name="robots" content="index, follow">
  <meta name="author" content="amine triki">
  <link rel="stylesheet" href="./output.css">
</head>
<body>
<?php include 'nav.php'; ?>

<main class=" container  mx-auto sm:my-10 md:my-12 flex justify-center flex-col items-center">


<form method="POST" action="" class=" w-72 sm:my-10 md:my-12">

    <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required />
    </div> 
    <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required />
    </div> 

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>
<p>
    you don't have account ! <a class=" text-green-400 font-semibold	" href="signUp.php" sign up>sign up</a> 
</p>

</main>

<?php include 'footer.php'; ?>
    
</body>
</html>