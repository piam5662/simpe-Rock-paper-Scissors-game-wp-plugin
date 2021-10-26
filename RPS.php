<?php

/*
Plugin Name: RPS
Plugin URI: https://github.com/piam5662/simpe-Rock-paper-Scissors-game-wp-plugin
Description: This is a simple Rock Paper Scissors game.
Author: piam
Version: 1

*/
session_start();


function gamePlay()
{


    $message = "";
    if (isset($_POST['Reset'])) {
        $_SESSION['win'] = 0;
        $_SESSION['pcWin'] = 0;
    }// reset the game

    if (isset($_POST['Play'])) { //check if form was submitted

        $op = $_POST['op']; //get input text
        $computer = rand(1, 3);//random value
        $op_ar = array(
            "1" => 'Rock',
            "2" => 'Paper',
            "3" => 'Scissors'

        );

        if ($op == $computer) {
            $message = 'draw';// if same -> draw
        } else {

            switch ($op) {// checking pc vs player input
                case '1':

                    switch ($computer) {
                        case '1':
                            $message = 'draw';
                            break;

                        case '2':
                            $message = 'lose';
                            break;

                        case '3':
                            $message = 'Win';
                            break;


                    }
                    break;

                case '2':
                    switch ($computer) {
                        case '1':
                            $message = 'Win';
                            break;

                        case '2':

                            $message = 'draw';
                            break;

                        case '3':
                            $message = 'lose';
                            break;


                    }
                    break;

                case '3':
                    switch ($computer) {
                        case '1':
                            $message = 'lose';
                            break;

                        case '2':
                            $message = 'Win';
                            break;

                        case '3':
                            $message = 'draw';

                            break;


                    }
                    break;


            }

            if ($message == 'Win') {// session store
                if (isset($_SESSION['win'])) {
                    $_SESSION['win'] += 1;
                } else {
                    $_SESSION['win'] = 1;
                }

            } elseif ($message == 'lose') {

                if (isset($_SESSION['pcWin'])) {
                    $_SESSION['pcWin'] += 1;
                } else {
                    $_SESSION['pcWin'] = 1;
                }

            }


        }

//echo $computer;
    }

    ?>
    <html>
    <body>
    <form action="" method="post">
        <?php
        echo "
        <style type='text/css'>
        .dance {
  background-image: url('https://www.google.com/logos/2012/halloweenmonsters/halloweenmonsters-hp-skeleton.png');
  background-repeat: no-repeat;
  width: 250px;
  height: 71px;
  animation: lovelydance 0.85s steps(1) infinite;
}

@keyframes lovelydance {
    0% {
        background-position: 120px -233px;
  }
  10% {
        background-position: 100px -311px;
  }
  20% {
        background-position: 120px -467px;
  }
  30% {
        background-position: 70px -542px;
  }
  40% {
        background-position: 50px -622px;
  }
  50% {
        background-position: 180px -700px;
  }
  60% {
        background-position: 120px -775px;
  }
  70% {
        background-position: 260px -854px;
  }
  80% {
        background-position: 140px -921px;
  }
  90% {
        background-position: 140px -1000px;
  }
  100% {
        background-position: 100px -1080px;
  }
}
.box1 {
    background-color: wheat;
    color: black;
     text-align: center;
  border: 3px solid green;
  max-width: 400px;
    margin-left: auto;
  margin-right: auto;
//   opacity: .5;
}

/////////////////////////////








</style>
        ";
        ?>
        <div class="box box1">
            <?php
            if ($message == 'Win') {
                echo '<div class="dance"></div>computer Took : ' . $op_ar[$computer];
                echo '<br> <div style="color: #0A246A; font-weight: bold;font-style: italic"> so The result is : .....' . $message . '</div>';
            } else {
                echo '&#128540 computer Took : ' . $op_ar[$computer];
                echo '<br> <div style="color: #0A246A; font-weight: bold;font-style: italic"> so The result is : .....' . $message . '</div>';
            }

            echo "<br>You :" . $_SESSION["win"];
            echo "<br>PC :" . $_SESSION["pcWin"];

            ?><br>

            <label>Choose One :
                <select required name="op">
                    <option value="1">Rock</option>
                    <option value="2">Paper</option>
                    <option value="3">Scissors</option>


                </select>
            </label>

            <br>
            <input type="submit" name="Play" value="Play"/>
            <input type="submit" name="Reset" value="Reset"/>
    </form>
    </body>
    </html>
    </div>
    <?php
}

// Now we set that function up to execute when the admin_notices action is called.
add_action('wp_head', 'gamePlay');
