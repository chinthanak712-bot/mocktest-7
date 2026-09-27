<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$questions = [

    [
        "question" => "Which language is used to structure a web page?",
        "options" => ["HTML", "CSS", "PHP", "MySQL"],
        "answer" => "HTML"
    ],

    [
        "question" => "Which language is used to style a web page?",
        "options" => ["HTML", "CSS", "PHP", "SQL"],
        "answer" => "CSS"
    ],

    [
        "question" => "Which language is commonly used for server-side web development?",
        "options" => ["HTML", "CSS", "PHP", "XML"],
        "answer" => "PHP"
    ],

    [
        "question" => "Which one is a relational database?",
        "options" => ["MySQL", "HTML", "CSS", "JavaScript"],
        "answer" => "MySQL"
    ],

    [
        "question" => "What does SQL stand for?",
        "options" => [
            "Structured Query Language",
            "Simple Query Language",
            "System Query Language",
            "Sequential Query Language"
        ],
        "answer" => "Structured Query Language"
    ],

    [
        "question" => "Which HTML tag is used to create a hyperlink?",
        "options" => ["<a>", "<p>", "<h1>", "<img>"],
        "answer" => "<a>"
    ],

    [
        "question" => "Which language is used to add interactivity to web pages?",
        "options" => ["JavaScript", "HTML", "CSS", "SQL"],
        "answer" => "JavaScript"
    ],

    [
        "question" => "Which symbol is used to start a PHP variable?",
        "options" => ["$", "#", "@", "%"],
        "answer" => "$"
    ],

    [
        "question" => "Which software is commonly used to run PHP and MySQL locally?",
        "options" => ["XAMPP", "Photoshop", "PowerPoint", "Excel"],
        "answer" => "XAMPP"
    ],

    [
        "question" => "Which SQL command is used to retrieve data?",
        "options" => ["SELECT", "DELETE", "REMOVE", "CLEAR"],
        "answer" => "SELECT"
    ],

    [
        "question" => "Which HTML tag is used to display an image?",
        "options" => ["<img>", "<image>", "<pic>", "<src>"],
        "answer" => "<img>"
    ],

    [
        "question" => "Which CSS property is used to change text color?",
        "options" => ["color", "font", "text-style", "background"],
        "answer" => "color"
    ],

    [
        "question" => "Which HTML tag is used for the largest heading?",
        "options" => ["<h1>", "<h6>", "<head>", "<heading>"],
        "answer" => "<h1>"
    ],

    [
        "question" => "Which SQL command is used to add new records?",
        "options" => ["INSERT", "ADD", "CREATE", "PUT"],
        "answer" => "INSERT"
    ],

    [
        "question" => "Which SQL command is used to modify existing data?",
        "options" => ["UPDATE", "CHANGE", "MODIFY", "ALTER"],
        "answer" => "UPDATE"
    ],

    [
        "question" => "Which SQL command is used to remove records?",
        "options" => ["DELETE", "REMOVE", "DROP", "CLEAR"],
        "answer" => "DELETE"
    ],

    [
        "question" => "Which PHP statement is used to include another PHP file?",
        "options" => ["include", "insert", "connect", "requirefile"],
        "answer" => "include"
    ],

    [
        "question" => "Which HTML tag is used to create a paragraph?",
        "options" => ["<p>", "<para>", "<text>", "<paragraph>"],
        "answer" => "<p>"
    ],

    [
        "question" => "Which CSS property is used to change the background color?",
        "options" => [
            "background-color",
            "color-background",
            "bg-color",
            "background-style"
        ],
        "answer" => "background-color"
    ],

    [
        "question" => "Which JavaScript keyword is used to declare a variable?",
        "options" => ["let", "variable", "declare", "define"],
        "answer" => "let"
    ]

];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Online Mock Test</title>

    <link rel="stylesheet" href="style.css">

    <style>

        /* TIMER */

        .timer-box {

            background: #222;

            color: white;

            padding: 12px 20px;

            border-radius: 10px;

            font-size: 20px;

            font-weight: bold;

            min-width: 130px;

            text-align: center;

            transition: 0.3s;

        }

        .timer-label {

            display: block;

            font-size: 12px;

            font-weight: normal;

            margin-bottom: 3px;

        }


        /*
         * WARNING MODE
         * Starts when 30 seconds remain.
         */

        body.warning-mode {

            background: linear-gradient(
                135deg,
                #ff7676,
                #d63031
            );

        }


        body.warning-mode .timer-box {

            background: #b00000;

            transform: scale(1.08);

            animation: timerBlink 0.6s infinite alternate;

        }


        body.warning-mode .quiz-container {

            border: 4px solid #ff0000;

            box-shadow:
                0 0 25px
                rgba(255, 0, 0, 0.7);

        }


        @keyframes timerBlink {

            from {
                opacity: 1;
            }

            to {
                opacity: 0.5;
            }

        }


        /*
         * Small warning message
         */

        #warningMessage {

            display: none;

            background: #ff0000;

            color: white;

            padding: 10px;

            margin-bottom: 15px;

            border-radius: 8px;

            text-align: center;

            font-weight: bold;

        }


        body.warning-mode #warningMessage {

            display: block;

        }

    </style>

</head>


<body>


<div class="quiz-container">


    <div class="quiz-header">


        <div>

            <h1>
                Online Mock Test
            </h1>

            <p>

                Welcome,

                <strong>

                    <?php

                    echo htmlspecialchars(
                        $_SESSION["name"]
                    );

                    ?>

                </strong>

            </p>

        </div>


        <!-- TIMER -->

        <div
            class="timer-box"
            id="timerBox"
        >

            <span class="timer-label">
                Time Remaining
            </span>

            <span id="timer">
                02:00
            </span>

        </div>


    </div>


    <!-- WARNING MESSAGE -->

    <div id="warningMessage">

        ⚠️ Hurry! Only 30 seconds remaining!

    </div>


    <form
        action="result.php"
        method="POST"
        id="quizForm"
    >


        <?php foreach (
            $questions as $index => $question
        ): ?>


            <div class="question">


                <h3>

                    <?php

                    echo ($index + 1)
                        . ". "
                        . htmlspecialchars(
                            $question["question"]
                        );

                    ?>

                </h3>


                <?php foreach (
                    $question["options"]
                    as $option
                ): ?>


                    <label class="option">


                        <input
                            type="radio"
                            name="q<?php echo $index; ?>"
                            value="<?php
                                echo htmlspecialchars(
                                    $option
                                );
                            ?>"
                            required
                        >


                        <span>

                            <?php

                            echo htmlspecialchars(
                                $option
                            );

                            ?>

                        </span>


                    </label>


                <?php endforeach; ?>


            </div>


        <?php endforeach; ?>


        <button
            type="submit"
            class="submit-btn"
            id="submitButton"
        >

            Submit Mock Test

        </button>


    </form>


</div>


<script>

/*
 * 2 MINUTE TIMER
 *
 * 2 minutes = 120 seconds
 */

let timeLeft = 120;

let warningShown = false;

const timer =
    document.getElementById("timer");

const quizForm =
    document.getElementById("quizForm");

const submitButton =
    document.getElementById("submitButton");


function updateTimer() {


    /*
     * Calculate minutes
     */

    const minutes =
        Math.floor(timeLeft / 60);


    /*
     * Calculate seconds
     */

    const seconds =
        timeLeft % 60;


    /*
     * Add zero before single digit seconds
     */

    const displaySeconds =
        seconds < 10
        ? "0" + seconds
        : seconds;


    /*
     * Display timer
     */

    timer.textContent =
        "0" + minutes + ":" + displaySeconds;


    /*
     * CHANGE PAGE COLOR AT 30 SECONDS
     */

    if (timeLeft <= 30 && !warningShown) {

        document.body.classList.add(
            "warning-mode"
        );

        warningShown = true;

    }


    /*
     * TIME FINISHED
     */

    if (timeLeft <= 0) {


        clearInterval(countdown);


        timer.textContent = "00:00";


        submitButton.disabled = true;


        alert(
            "Time is over! Your test will be submitted automatically."
        );


        /*
         * Submit the form automatically.
         */

        quizForm.submit();


        return;

    }


    /*
     * Reduce time by one second
     */

    timeLeft--;

}


/*
 * Start immediately
 */

updateTimer();


/*
 * Run every second
 */

const countdown =
    setInterval(
        updateTimer,
        1000
    );

</script>


</body>

</html>