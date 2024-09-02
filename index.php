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
  <main class=" container  h-screen 	mx-auto my-10">
    <div class="flex   justify-between flex-row items-center	flex-wrap	content-center 	">
      <div class=" p-5 flex flex-col  flex-wrap m-5 h-96 items-center	content-center justify-center">
        <p>
          We are here for your help ; I am
        </p>
        <h1 class="text-4xl	my-4 "><b>Amine Triki</b></h1>
        <?php include 'typing.php'; ?>
      </div>
      <div>
        <img class="w-96 p-5" src="./assets/mat.webp" alt="amine triki">

      </div>
    </div>
    <div class="text-center my-16 flex justify-center flex-col items-center">
      <h2 class=" text-3xl  "> What Services I’m Providing </h2>
      <hr class="w-24 bg-cyan-600  h-1 my-5">
      <h3 class=" text-2xl "> My Services </h3>
    </div>
    <div class="my-5 flex flex-row justify-center gap-5">

          <?php
          $data = [
            'name' => ['Web Development' , 'wordpress'],
            'jobTitle' => ['REACT' , 'WordPress Designer'],
        ];
          for ($x = 0; $x < 2; $x++) {

            $cardData = [
              'name' => $data['name'][$x],
              'jobTitle' => $data['jobTitle'][$x],
          ];

          include 'card.php';
          }
          ?>

    </div>
  </main>
  
  <?php include 'footer.php'; ?>
</body>

</html>