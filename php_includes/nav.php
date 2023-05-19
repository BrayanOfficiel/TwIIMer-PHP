<button id="navToggle" class="nav_toggle open"></button>

<nav id="mainNav" class="nav open">

  <div>

    <a class="nav_logo" href="/home.php">
      <img class="logo" src="img/logo_400.png" alt="logo">
      <h1 class="logo_text">TwIIMer</h1>
    </a>

    <ul class="nav_list">
      <li><a href="/home.php"><i class="fa-solid fa-house"></i>Accueil</a></li>
      <li><a href="explorer.php"><i class="fa-solid fa-hashtag"></i>Explorer</a></li>
      <li><a href="notifications.php"><i class="fa-solid fa-bell"></i>Notifications</a></li>
      <li><a href="messagerie.php"><i class="fa-solid fa-message"></i>Messagerie</a></li>
      <li><a href="signets.php"><i class="fa-solid fa-tag"></i>Signets</a></li>
    </ul>

  </div>

  <ul class="nav_list_user">
    <?php if (isset($_SESSION['user'])) { ?>
      <li>
        <a href="profile.php">
          <img class="pp" src="<?= $_SESSION['user']['photo'] ?>" alt="Photo de profil">
          <span class="id">
            <?= $_SESSION['user']['identifiant'] ?>
          </span>
        </a>
        <a class="logout_icon" href="php_includes/logout.php"><i class="fa-solid fa-power-off"></i></a>
      </li>
    <?php } else { ?>
      <li><a href="/connexion.php"><i class="fa-solid fa-user"></i>Connexion</a></li>
      <li><a href="/inscription.php"><i class="fa-solid fa-user-pen"></i>Inscription</a></li>
    <?php } ?>
  </ul>
</nav>

<script>
  const navToggle = document.getElementById('navToggle');
  const mainNav = document.getElementById('mainNav');

  navToggle.addEventListener('click', () => {
    mainNav.classList.toggle('open');
    navToggle.classList.toggle('open');
  });
</script>