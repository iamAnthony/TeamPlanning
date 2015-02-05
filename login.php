<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-type" content="text\html; charset=iso-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel ="stylesheet" type="text/css" href="css/index.css" />
    <title>English PROJECT - Team Calendar</title>
</head>

<?php include ('./include/bddconnect.php'); ?>
<?php
// on teste si le visiteur a soumis le formulaire de connexion
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion')
{
    if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass'])))
    {
        $base = mysql_connect ('localhost', 'root', '');
        mysql_select_db ('teamplanning', $base);

        // on teste si une entrée de la base contient ce couple login / pass
        $sql = 'SELECT count(*) FROM user WHERE mail="'.mysql_real_escape_string($_POST['login']).'" AND password="'.mysql_real_escape_string(md5($_POST['pass'])).'"';
        $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
        $data = mysql_fetch_array($req);

        mysql_free_result($req);
        mysql_close();

        // si on obtient une réponse, alors l'utilisateur est un membre
        if ($data[0] == 1)
        {
            session_start();
            $_SESSION['login'] = $_POST['login'];
            header('Location: accueil.php');
            exit();
        }
        // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
        elseif ($data[0] == 0)
        {
            $erreur = 'Compte non reconnu.';
        }
        // sinon, alors la, il y a un gros problème :)
        else
        {
            $erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
        }
    }
    else
    {
        $erreur = 'Au moins un des champs est vide.';
    }
}
?>

<body>
<center>
    <div class="page-header ">

        <h1>TEAM PLANNING</h1>

    </div>

    <div class="container">

        <form action="index.php" method="post" class="form-signin">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="login" class="sr-only">Email address</label>
            <input type="email" id="login" name="login" class="form-control" placeholder="Email address" required autofocusvalue="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>">
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" class="form-control" placeholder="Password" required value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>">
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="connexion">Sign in</button>
        </form>

        <?php
        if (isset($erreur)) echo '<br /><br />',$erreur;
        ?>

        <p>You don't have an account ? <a href="./inscription.php">Sign up !</a></p>

    </div>

    <?php /*Connection :<br />
    <form action="index.php" method="post">
    Login : <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br />
    Password : <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"><br />
    <input type="submit" name="connexion" value="Connexion">
    </form>
    <?php
    if (isset($erreur)) echo '<br /><br />',$erreur;
    ?>*/ ?>

</center>
</body>
</html>