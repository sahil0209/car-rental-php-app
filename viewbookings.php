<?php
include "components/header.php";
include "src/Booking.php";
$bookObj = new Booking($connection);
$response = $bookObj->get($_SESSION['curr_user_id']);
$curr_date = date("Y-m-d");


?>

<section class="main-container">
    <div class="main-container-child">
        <?php
        while ($row = mysqli_fetch_assoc($response)) {
            ?>
            <div class="car">
                <a class="car-img">
                    <img src="<?=$row['image']?>"
                        alt="car">
                </a>
                <div class="car-details">
                    <h1><?=$row['brand']?> <?=$row['name']?></h1>
                    <h2 class="my-1"><i class="fa-solid fa-indian-rupee-sign"></i><?=$row['amount']?></h2>
                    <h2><?=$row['number']?></h2>
                    <span><?=$row['start_date']?> - <?=$row['end_date']?></span>
                    <?php 
                        $sd = strtotime($row['start_date']);
                        $start_date = date('Y-m-d',$sd);

                        $ed = strtotime($row['end_date']);
                        $end_date = date('Y-m-d',$ed);

                        $class = "muted";
                        $toDispay = "Booked";
                        if($curr_date<$start_date){
                            $toDispay = "Upcoming";
                            $class = "primary";
                        } else if($curr_date>=$start_date && $curr_date<=$end_date){
                            $toDispay = "Ongoing";
                            $class = "success";
                        } else if($curr_date>$end_date){
                            $toDispay = "Finished";
                            $class = "danger";
                        }

                        ?>
                        <h2 class="text-<?=$class?>"><?=$toDispay?></h2>
                        <?php
                    ?>
                    
                </div>
            </div>
        <?php
        }
        ?>


    </div>
</section>

<?php
include 'components/footer.php';
?>