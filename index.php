<?php
include("./components/header.php");
include("./src/Car.php");
?>



<!-- Cars -->

<section class="main-container">
    <div class="main-container-child">
        <?php
        $car = new Car($connection);
        $result = $car->index();
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {

        ?>
                <div class="car">
                    <a href="http://localhost:8888/php-basics/sqlphp/car.php?id=<?= $row['id']?>" class="car-img">
                        <img src="<?= $row['image_url'] ?>" alt="">
                    </a>
                    <div class="car-details">
                        <h1><?= $row['brand'] ?> <?= $row['name'] ?></h1>
                        <h2 class="my-1"><i class="fa-solid fa-indian-rupee-sign"></i><?= $row['rentprice'] ?></h2>

                        <h2><?= $row['discount_percentage'] ?>% OFF</h2>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</section>

<?php
include("./components/footer.php")
?>