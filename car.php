<?php
include('components/header.php');
include('./src/Car.php');
$name = null;
$brand = null;
$price = null;
$sampleImage = null;
$discount = null;
$images = array();
$colors = array();
$numbers = array();

$carObj = new Car($connection);
$cdids = array();

$id = $_GET['id'];
$midRes = $carObj->get($id);
$count = 0;
while ($carDetails = mysqli_fetch_assoc($midRes)){
    // print_r($carDetails);
    if($count===0){
        $sampleImage = $carDetails['image_url'];
        $name = $carDetails['name'];
        $brand = $carDetails['brand'];
        $price = $carDetails['rentprice'];
        $discount = $carDetails['discount_percentage'];
        $count = 1;
    }
    $images[] = $carDetails['image'];
    $colors[] = $carDetails['color'];
    $numbers[] = $carDetails['number'];
    $cdids[] = $carDetails['id'];
}

// print_r($cdids);
?>

    <section class="main-container">

        <div class="main-container-child">
            <div class="container-section">
                <div class="big-car-img">
                    <img id="big-img" src="<?=$sampleImage?>" alt="car">
                </div>

                <div class="img-options">
                    <?php 
                        foreach ($images as $key=>$img_url) {
                           ?> 
                            <div class="img-option">
                                <img onclick="changeImage(this.src,'<?=$numbers[$key]?>','<?=$colors[$key]?>', '<?=$cdids[$key]?>')" src="<?= $img_url ?>" alt="car">
                            </div> <?php
                        }
                    ?>

                       
                    
                   

                </div>

                <div class="color-options">
                <?php 
                        foreach ($colors as $key=>$color) {
                           ?> 

                    <div style="cursor: pointer;" onclick="changeImage('<?=$images[$key]?>','<?=$numbers[$key]?>','<?=$colors[$key]?>', '<?=$cdids[$key]?>')" class="color-option">
                        <p style="background-color: <?=$color?>;"></p>
                    </div> <?php

                }
                    ?>
                   
                </div>

            </div>
            <div class="container-section">
                <h1><?= $brand ?> <?= $name ?></h1>
                <h2><i class="fa-solid fa-indian-rupee-sign"></i><?= $price ?></h2>
                <p>Available</p>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>

                <h2 id='number'><?=$numbers[0]?></h2>

                <a id='sendData' href="http://localhost:8888/php-basics/sqlphp/booking.php?cdid=<?=$cdids[0]?>" class="btn btn-primary">Book Now</a>

            </div>
        </div>

    </section>



<?php
    include('components/footer.php');
?>

