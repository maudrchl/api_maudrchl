<?
    include 'handle_form.php'
?>
<?
    include 'header.php'
?>

<body>
    <div class="container">
        <div class="messages">
            <?php foreach ($errorMessages as $message): ?>
            <p style="color : red">
                <?= $message ?>
            </p>
            <?php endforeach; ?>
            <?php foreach ($successMessages as $message): ?>
            <p style="color : green">
                <?= $message ?>
            </p>
            <?php endforeach; ?>
        </div>
        <div class="item">
                <img src="img/landscape.jpg" class="img">
        </div>
        <div class="item form">
        <form action="#" method="post">
            <h1 class="title">Travelidea</h1>
                <div class="content">
                    <div class="items">
                        <label for="name">Name</label>
                        <input id="name" type="text" placeholder="Maud" name="first-name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" />
                    </div>
                    <div class="items">
                        <label for="age">Age</label>
                        <input id="age" type="number" placeholder="20" name="age">
                    </div>
                    <div class="items">
                        <label for="environment" class="label_environment">Which environment is the best for you?
                    <input type="radio" name="environment" value="city" class="environment">
                    City
                    </input>
                    <input type="radio" name="environment" value="sea" class="environment">
                    Sea
                    </input>
                    <input type="radio" name="environment" value="land" class="environment">
                    Land
                    </input>
                </label>
                    </div>
                    <div class="items">
                        <label for="climate" class="climate">Which kind of climate is the best for you?
                            <input type="radio" name="climate" value="hot" class="climate climate_button">
                            Hot
                            </input>
                            <input type="radio" name="climate" value="cold" class="climate climate_button">
                            Warm / Cold
                            </input>
                        </label>
                        <button type="submit" class="submit">
                            <span class="send_txt">SUBMIT</span>
                            <img class="send" width=20 src="img/send.svg">
                        </button>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="img/landscape3.jpg" class="img">
            </div>
    </form>
    <!-- <img src="img/landscape3.jpg" alt="flight" class="img_flight item">
        <img src="img/img_city.jpg" class="img_flight item">
        <img src="img/img_land.jpeg" class="img_flight item">
        <img src="img/img_cold.jpeg" class="img_flight item">  -->
    </div>
</body>

</html>