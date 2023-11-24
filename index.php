<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservations</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f4f4f4;
        text-align: center;
        margin-bottom: 60px; /* Tambahkan margin-bottom sesuai tinggi footer */
    }
    h1 {
        color: #333;
    }
    .rooms-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 20px; /* Tambahkan margin-bottom agar tidak bersentuhan dengan footer */
    }
    .room {
        border: 1px solid #ddd;
        padding: 10px;
        margin: 10px;
        width: 300px;
        background-color: #fff;
        transition: transform 0.3s ease-in-out;
    }
    .room:hover {
        transform: scale(1.05);
    }
    .room img {
        width: 100%;
        height: auto;
        border-bottom: 1px solid #ddd;
    }
    .room h2 {
        color: #333;
        margin-top: 0;
    }
    .room p {
        color: #666;
    }
    .room .price {
        color: #333;
        font-weight: bold;
        margin-top: 5px;
    }
    .room a {
        display: block;
        margin-top: 10px;
        padding: 8px 12px;
        background-color: #3498db;
        color: #fff;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
    }
    .room a:hover {
        background-color: #2980b9;
    }
    .video-container {
        margin-top: 20px;
        margin-bottom: 20px; /* Tambahkan margin-bottom agar tidak bersentuhan dengan footer */
    }
    footer {
        background-color: #333;
        color: #fff;
        padding: 10px;
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: left;
    }
    .reservations-link a {
        display: block;
        padding: 8px 12px;
        background-color: #3498db;
        color: #fff;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
    }
    .reservations-link a:hover {
        background-color: #2980b9;
    }
</style>

</head>
<body>
    <h1>Welcome to Lombok Hotel</h1>

    <div class="rooms-container">
        <?php
        $rooms = array(
            array('Standard Room', 'standart.jpg', 'Comfortable standard room with basic amenities.', 100 * 1000),
            array('Deluxe Room', 'deluxe.jpg', 'Spacious deluxe room with additional amenities.', 150 * 1000),
            array('Suite Room', 'suite.jpg', 'Luxurious suite with a separate living area and premium amenities.', 200 * 1000)
        );

        foreach ($rooms as $room) {
            echo '<div class="room">';
            echo '<img src="' . $room[1] . '" alt="' . $room[0] . '">';
            echo '<h2>' . $room[0] . '</h2>';
            echo '<p>' . $room[2] . '</p>';
            echo '<div class="price">Price: Rp ' . number_format($room[3], 0, ',', '.') . '</div>';
            echo '<a href="reservation.php?room=' . urlencode($room[0]) . '">Reserve Now</a>';
            echo '</div>';
        }
        ?>
    </div>

    <!-- Video container -->
    <div class="video-container">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/hNN9Q3GuWEM?si=alXtTNUJi4tktm3X" frameborder="0" allowfullscreen></iframe>
    </div>

    <!-- Footer -->
    <footer>
        <div class="reservations-link">
            <a href="reservation.php">View Reservations</a>
        </div>
        <p>Lombok Hotel - Contact us: info@Lombokhotel.com | +123 456 789 | JL. majapahit no 2, Mataram</p>
    </footer>
</body>
</html>
