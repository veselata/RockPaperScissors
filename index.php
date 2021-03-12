<?php
declare(strict_types=1);

error_reporting(E_ALL);
session_start();

use RockPaperScissors\Game as Game;
use RockPaperScissors\GameRound as GameRound;
use RockPaperScissors\Player as Player;

require 'includes/Common/Autoloader.php';
\Common\Autoloader::registerAutoload();

const TOTAL_ROUNDS = 4;

if(!isset($_SESSION['player'])) {
	$_SESSION['player']['score'] = 0;
	$_SESSION['player']['round'] = 1;
}

if(!isset($_SESSION['hits'])) {
	$_SESSION['hits'] = 0;
} else {
	$_SESSION['hits'] ++;
}

// add player details
$user = [
    'username' => 'username',
    'score' => '0',
];

$player = new Player($user);
$player->username = "Veselina";

ob_start();

$choice = filter_input(INPUT_GET, 'choose');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Rock Paper Scissors Game</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="veselata" />
    <meta name="robots" content="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
		<h1>Let's play a game <u><?php echo $player->username; ?></u></h1>
		<form action="" method="get" enctype="multipart/form-data" >
            <input type="radio" name="choose" value="rock" title="Rock" <?php echo ($choice== 'rock') ?  'checked="checked"'  : "" ;  ?> /> Rock <br />
            <input type="radio" name="choose" value="paper" title="Paper" <?php echo ($choice== 'paper') ?  'checked="checked"'  : "" ;  ?> /> Paper <br />
            <input type="radio" name="choose" value="scissors" title="Scissors" <?php echo ($choice== 'scissors') ?  'checked="checked"'  : "" ;  ?> /> Scissors <br />
            <input type="submit" name="submit" value="submit" /> 
        </form>

<?php
$round = new GameRound();

    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'GET') {
		if($choice) {
			$human = $round->player($choice);
			$computer = $round->computer();
			
			$game = new Game();
			$game->playRounds(TOTAL_ROUNDS);
			$_SESSION['output'][$_SESSION['hits']] = $game->play($human, $computer);
			$_SESSION['output'][$_SESSION['hits']] .= $game->winner();
			// 1 is winning, 3 is draw
			$roundWinner = $game->getWinnerStatus();
			if($roundWinner == 1) {
				$_SESSION['player']['score']++;
			}
			if($roundWinner != 3) {
				$_SESSION['player']['round']++;
			}
		}
	}
	

	if(	$_SESSION['player']['round'] > TOTAL_ROUNDS) { 
		echo '<h5>GAME OVER</h5>';
		echo '<div>Your score: '. $_SESSION['player']['score'] . ' from '. TOTAL_ROUNDS .'</div>';
		echo '<a href=\'./\'">New Game</a>';

		session_unset();
		session_destroy();
	}
	
	if(isset($_SESSION['output'])) {
		echo '<pre>'; print_r($_SESSION); echo '</pre>';
	}
?>
	</div>
</body>
</html>

<?php
ob_end_flush();
