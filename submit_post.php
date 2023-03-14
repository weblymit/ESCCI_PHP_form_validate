<?php
$title_page = "Redirection avec POST";
include('partials/_header.php');
?>
<main class="pt-20 pb-12">
  <h2 class="text-2xl pb-10 font-semibold text-indigo-500">Message du formulaire</h2>

  <!-- traitement formulaire -->
  <?php
  // stock les datas input dans variable
  // isset == existe
  // je verie que les inputs de mes variables existent
  if (isset($_POST['nom']) && isset($_POST['age']) && isset($_POST['message'])) {
    $nom = $_POST['nom'];
    $age = $_POST['age'];
    $message = $_POST['message'];
  }
  // 1- verifie si les input ne sont pas vide
  if (empty($nom) || empty($age) || empty($message)) {
    echo "<p>Il faut remplir tous les champs!</p>";
  } else { ?>
    <p>Nom : <?= trim(htmlspecialchars($nom)) ?></p>
    <p>Age : <?= htmlspecialchars($age) ?></p>
    <p>Message : <?= htmlspecialchars($message) ?></p>
  <?php } ?>

</main>
<!-- footer -->
<?php
include('partials/_footer.php')
?>