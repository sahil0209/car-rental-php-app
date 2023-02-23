<?php
include('components/header.php');
include('src/Car.php');
include('src/Booking.php');

if (!isset($_SESSION['curr_user'])) {
    header('location: login.php');
}

$car = new Car($connection);
$booking = new Booking($connection);
$reqcdid = $_GET['cdid'];
$res = $car->getSingleCarDetail($reqcdid);
$cardetails = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cdid = $_GET['cdid'];
    $uid = $_SESSION['curr_user_id'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $endD = date_create($startDate);
    $startD = date_create($endDate);
    $days = date_diff($endD, $startD)->days === 0 ? 1 : date_diff($endD, $startD)->days;
    
    $amt = $days * $cardetails['rentprice'];
    
    $discountAmount = ($cardetails['discount_percentage'] / 100) * $amt;
    $amt -= $discountAmount;
    $response = $booking->create($cdid, $uid, $startDate, $endDate, $amt);
    if ($response) {
        
        ?>
        <script>
            alert("Your booking has been done");
            window.location="http://localhost:8888/php-basics/sqlphp/viewbookings.php";
        </script>
    <?php
    }
}

?>

<section class="main-container">

    <div class="main-container-child">
        <div class="booking-section">
            <div class="booking-section-img">
                <img src="<?= $cardetails['image'] ?>" alt="car">
            </div>
            <div class="booking-details">
                <h1>
                    <?= $cardetails['brand'] ?>
                    <?= $cardetails['name'] ?>
                </h1>

                <h2>Rs
                    <?= $cardetails['rentprice'] ?>
                </h2>

                <h4>
                    <?= $cardetails['number'] ?>
                </h4>

                <p>
                    <?= $cardetails['is_available'] ? "Available" : "Unavailable" ?>
                </p>
            </div>
        </div>
        <div class="booking-section">

            <form action="http://localhost:8888/php-basics/sqlphp/booking.php?cdid=<?=$_GET['cdid']?>" method="post">

                <h1>Fill Booking Details</h1>

                <div class="mb-2">
                    <p class="form-label">Start Date</p>
                    <input class="form-control" id='start_date' min="<?= date('Y-m-d') ?>" type="date"
                        name="start_date" />
                </div>

                <div class="mb-2">
                    <p class="form-label">End Date</p>
                    <input class="form-control"
                        onchange="calculatePrice(<?= $cardetails['rentprice'] ?>,<?= $cardetails['discount_percentage'] ?>)"
                        id='end_date' min=<?= date('Y-m-d') ?> type="date" name="end_date" />
                </div>


                <h2>

                    To Be Paid : Rs.
                    <span id="final_amount">
                    </span>

                </h2>

                <button class="btn btn-primary">Confirm Booking</button>

            </form>
        </div>
    </div>

</section>


<?php
include('components/footer.php');

?>