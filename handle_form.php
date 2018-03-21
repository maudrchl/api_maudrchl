<?php
    session_start();

    // create tabs
    $errorMessages = [];
    $successMessages = [];

    // Form sent
    if(!empty($_POST))
    {
        // Retrieve form data
        $_SESSION['first-name'] = trim($_POST['first-name']);
        $_SESSION['age'] = (int)$_POST['age'];
        $_SESSION['climate'] = $_POST['climate'];
        $_SESSION['environment'] = $_POST['environment'];

        $first_name = $_SESSION['first-name'];
        $age = $_SESSION['age'];
        $climate = $_SESSION['climate'];
        $environment = $_SESSION['environment'];
        

        // Test errors
        // si le champ du mot de passe est vide : afficher le message d'erreur
        if(empty($first_name))
        {
            $errorMessages[] = 'Missing first name';
        }

        if(empty($age))
        {
            $errorMessages[] = 'Missing age';
        }
        else if($age < 0 || $age > 120)
        {
            $errorMessages[] = 'Wrong age';
        }

        if(empty($climate))
        {
            $errorMessages[] = 'Missing climate';
        }

        if(empty($environment))
        {
            $errorMessages[] = 'Missing environment';
        }

        // Success
        if(empty($errorMessages))
        {
            $successMessages[] = 'Well done! See the results <a href="results.php">here</a> 👀';
        }

    }
    else
    // truc par défaut
    {
        $_POST['first-name'] = '';
        $_POST['age'] = '';
        $_POST['climate'] = '';
        $_POST['environment'] = '';
    }
    ?>
