<?php
$title_page = "Validation d'un formulaire avec POST";
include('partials/_header.php');

// validation du formulaire
// 1-creation de mes variables
$error = [];
$errMsgRequire = "<span class='text-red-500'>Ce champs est obligatoire</>";
$success = false;

// 2-Je vérifie si le formualire est soumis
if (!empty($_POST['submited'])) {
  // 3- protege contre faille xss
  ///////////////////////////////
  $nom = trim(htmlspecialchars($_POST['nom']));
  $age = trim(htmlspecialchars($_POST['age']));
  $message = trim(htmlspecialchars($_POST['message']));

  // 4- validation de chaque input
  /////////////////////////////////
  // nom
  if (!empty($nom)) {
    if (strlen($nom) <= 2) {
      $error['nom'] = "<span class='text-red-500'>3 caractères minimum</span>";
    } elseif (strlen($nom) > 20) {
      $error['nom'] = "<span class='text-red-500'>20 caractères maximum</span>";
    }
  } else {
    $error['nom'] = $errMsgRequire;
  }

  // age
  // verifie que user a bien rempli le champs
  if (!empty($age)) {
    // verifie que l'age est un nombre entier
    if (!is_numeric($age)) {
      $error['age'] = "<span class='text-red-500'>Merci de rentrer un age correct</span>";
      // verifie qu'il est majeur
    } elseif ($age < 18) {
      $error['age'] = "<span class='text-red-500'>Tu es mineur</span>";
    }
  } else {
    $error['age'] = $errMsgRequire;
  }

  // message
  if (!empty($message)) {
    if (strlen($message) <= 20) {
      $error['message'] = "<span class='text-red-500'>20 caractères minimum</span>";
    } elseif (strlen($message) > 300) {
      $error['message'] = "<span class='text-red-500'>300 caractères maximum</span>";
    }
  } else {
    $error['message'] = $errMsgRequire;
  }

  // 5- Pas d'erreur => Enregistrement en Base de donnée
  if (count($error) == 0) {
    $success = true;
    // enregistrement en BDD
  }
}



?>

<main class="pt-20">
  <form method="POST">
    <!-- input name -->
    <div class="form-control w-full max-w-xs">
      <label class="label" for="nom">
        <span class="label-text">Nom</span>
      </label>
      <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="nom" id="nom" />
      <p>
        <?php
        if (isset($error['nom'])) {
          echo $error['nom'];
        }
        ?>
      </p>
    </div>
    <!-- input age -->
    <div class="form-control w-full max-w-xs">
      <label class="label" for="age">
        <span class="label-text">Age</span>
      </label>
      <input type="number" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="age" id="age" />
      <p>
        <?php
        if (isset($error['age'])) {
          echo $error['age'];
        }
        ?>
      </p>
    </div>
    <!-- input message -->
    <div class="form-control w-full max-w-xs">
      <label class="label" for="message">
        <span class="label-text">Message</span>
      </label>
      <textarea class="textarea textarea-bordered" placeholder="Bio" id="message" name="message"></textarea>
      <p>
        <?php
        if (isset($error['message'])) {
          echo $error['message'];
        }
        ?>
      </p>
    </div>
    <!-- input/btn submit -->
    <input class="btn bg-blue-600 text-white mt-6" type="submit" id="submited" name="submited" value="Envoyer" />
  </form>
</main>
<!-- footer -->
<?php
include('partials/_footer.php')
?>