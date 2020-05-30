<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<?php
//by Notaryz
ini_set('display_errors', 0);
define('hote', ''); //HOTE DB - HOST DB
define('user', ''); //UTILISATEUR DB - USER DB
define('pass', ''); //MDP DB - PASSWORD OF THE USER
define('db', ''); //VOTRE DB - YOUR DATABASE

define('emu', '');//VOTRE EMULATEUR CHOIX : ARCTURUS, PLUSEMU, COMET - YOUR EMULATOR CHOICE : ARCTURUS, PLUSEMU, COMET

define('habbo_imager', 'http://www.avatar-api.com/habbo-imaging/avatarimage.php?figure=');//L'HABBO IMAGER QUE VOUS SOUHAITEZ UTILISER - HABBO IMAGER WHICH YOU WILL USE

try {
    $dbh = new PDO('mysql:host='.hote.';dbname='.db.';charset=utf8mb4', ''.user.'', ''.pass.'');
}
catch (PDOException $e) {
    define('errorSql', $e->getMessage());
    echo ("<div style='background-repeat: no-repeat;
		background-position: 10px 50%;
		padding: 10px 10px 10px 10px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		-moz-box-shadow: 0 1px 1px #fff inset;
		box-shadow: 0 1px 1px #fff inset;
		border: 1px solid maroon !important;
		color: #000;
		background: pink;
		display: table;
		margin: 0 auto;
		font-size: 15px;
		font-family: Tahoma;'><b>Erreur de configuration:</b><br>Impossible de se connecter à la base de données ! '".errorSql."</div></body></html>");
    die();
}
if (hote == null OR user == null OR db == null){
    echo ("<div style='background-repeat: no-repeat;
		background-position: 10px 50%;
		padding: 10px 10px 10px 10px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		-moz-box-shadow: 0 1px 1px #fff inset;
		box-shadow: 0 1px 1px #fff inset;
		border: 1px solid maroon !important;
		color: #000;
		background: pink;
		display: table;
		margin: 0 auto;
		font-size: 15px;
		font-family: Tahoma;'><b>API Habbo Imager</b><br>Il semblerait que vous n'avez pas encore configuré la base de données !</div>");
    die();
}
if(isset($_GET['nb_connectes']) ){
    switch(emu){

        case "arcturus":
            $stmt = $dbh->prepare("SELECT count(online) FROM users WHERE online = '1'");
            $stmt->execute();
            $online = $stmt->fetch();
            echo $online['count(online)'];
            break;
        case "comet":
            $stmt1 = $dbh->prepare("SELECT count(online) FROM players WHERE online = '1'");
            $stmt1->execute();
            $online1 = $stmt1->fetch();
            echo $online1['count(online)'];
            break;
        case "plusemu":
            $stmt2 = $dbh->prepare("SELECT count(online) FROM users WHERE online = '1'");
            $stmt2->execute();
            $online2 = $stmt2->fetch();
            echo $online2['count(online)'];
            break;
    }

}
if(isset($_GET['username'])) {
    $username = htmlspecialchars($_GET['username']);
    switch (emu) {
        case "arcturus":
            $stmt = $dbh->prepare("SELECT look FROM users WHERE username = :username");
            $stmt->execute(array(
                ":username" => $username
            ));
            $row = $stmt->fetch();
            if ($stmt->rowCount() == 1) {
                echo '<img src="' . habbo_imager . '' . $row['look'] . '" alt="' . $username . '">';
            } else if (strlen($username) <= 1) {
                echo 'Veuillez entrer un pseudo !';
            } else {
                echo 'Ce joueur n\'existe pas !';
            }
            break;
        case "comet":
            $stmt1 = $dbh->prepare("SELECT figure FROM players WHERE username = :username");
            $stmt1->execute(array(
                ":username" => $username
            ));
            $row1 = $stmt1->fetch();
            if ($stmt1->rowCount() == 1) {
                echo '<img src="' . habbo_imager . '' . $row1['figure'] . '" alt="' . $username . '">';
            } else if (strlen($username) <= 1) {
                echo 'Veuillez entrer un pseudo !';
            } else {
                echo 'Ce joueur n\'existe pas !';
            }
            break;
        case "plusemu":
            $stmt2 = $dbh->prepare("SELECT look FROM users WHERE username = :username");
            $stmt2->execute(array(
                ":username" => $username
            ));
            $row2 = $stmt2->fetch();
            if ($stmt2->rowCount() == 1) {
                echo '<img src="' . habbo_imager . '' . $row2['look'] . '" alt="' . $username . '">';
            } else if (strlen($username) <= 1) {
                echo 'Veuillez entrer un pseudo !';
            } else {
                echo 'Ce joueur n\'existe pas !';
            }
            break;



    }

}
?>
</html>
