<?php

session_start();

// إنشاء قاعدة البيانات إذا لم تكن موجودة
$db = new PDO('sqlite:database.db');

// إنشاء جدول المستخدمين إذا لم يكن موجودًا
$query = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY,
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL,
    userName TEXT NOT NULL,
    email TEXT NOT NULL,
    password TEXT NOT NULL,
    last_login DATETIME
)";
$db->exec($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // التحقق من تطابق كلمة المرور مع التأكيد
    if ($_POST['password'] !== $_POST['confirm_password']) {
        echo "كلمة المرور غير متطابقة";
        exit();
    }

    // تشفير كلمة المرور
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // التحقق مما إذا كان البريد الإلكتروني أو اسم المستخدم موجودًا بالفعل
    $checkQuery = "SELECT * FROM users WHERE email = :email OR userName = :userName";
    $stmt = $db->prepare($checkQuery);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':userName', $_POST['userName']);
    $stmt->execute();
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        echo "البريد الإلكتروني أو اسم المستخدم موجود بالفعل";
        exit();
    }

    // إدخال البيانات في قاعدة البيانات
    $last_login = date('Y-m-d H:i:s');
    $query = "INSERT INTO users (first_name, last_name, userName, email, password , last_login) 
              VALUES (:first_name, :last_name, :userName, :email, :password , :last_login)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':first_name', $_POST['first_name']);
    $stmt->bindParam(':last_name', $_POST['last_name']);
    $stmt->bindParam(':userName', $_POST['userName']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':last_login', $last_login);

    // التأكد من نجاح إدخال البيانات قبل إعادة التوجيه
    if ($stmt->execute()) {
        // تسجيل دخول المستخدم تلقائيًا
        $_SESSION['user_id'] = $db->lastInsertId();
        $_SESSION['first_name'] = $_POST['first_name'];
        $_SESSION['last_name'] = $_POST['last_name'];
        $_SESSION['userName'] = $_POST['userName'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['last_login'] = $last_login;

    
        header('Location: profile.php');
        exit();
    
    
    } else {
        echo "حدث خطأ أثناء تسجيل البيانات";
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


<form method="POST" action="" class="  w-96 p-2 sm:my-10 md:my-12">

    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
            <input type="text" id="first_name" name="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
        </div>
        <div>
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
            <input type="text" id="last_name" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required />
        </div>

    </div>
    <div class="mb-6">
        <label for="userName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">user Name</label>
        <input type="userName" id="userName" name="userName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="user name" required />
    </div> 
    <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required />
    </div> 
    <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required />
    </div> 
    <div class="mb-6">
        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
        <input type="password" id="confirm_password" name="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required />
    </div> 
    <div class="flex items-start mb-6">
        <div class="flex items-center h-5">
        <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required />
        </div>
        <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree with the <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and conditions</a>.</label>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>

<p>
    you have account ! <a class=" text-blue-400 font-semibold	" href="./signIn.php" sign up>sign in</a>
</p>

</main>

<?php include 'footer.php'; ?>
    
</body>
</html>