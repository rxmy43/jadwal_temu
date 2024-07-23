<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Web Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: white;
            color: #fff;
            overflow: hidden;
        }

        .navbar {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #3ABEF9;
            padding: 10px 0;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.7);
        }

        .navbar img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            background: black;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.7);
            transition: transform 0.3s;

        }

        .navbar p {
            color: #ffff;
            font-size: 24px;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 100px;
            /* Adjusted for fixed navbar */
            gap: 40px;
        }

        .circle-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 20px;
        background: rgba(0, 0, 0, 0.4); /* Warna latar belakang gelap */
         }


        .circle {
            position: relative;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: #fff;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .circle:hover {
            transform: translateY(-10px) scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .description {
            margin-top: 15px;
            font-size: 20px;
            font-weight: bold;
            color: black;
            text-align: center;
            transition: color 0.3s;
        }

        .circle-container:hover .description {
            color: #fff;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .circle {
            animation: pulse 2s infinite;
        }

        .circle:hover {
            animation-play-state: paused;
        }

        @media (max-width: 768px) {
            .circle {
                width: 140px;
                height: 140px;
            }

            .description {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="navbar">
        <img src="images/logo.png" alt="">
        <p>PT. PLN UP2B (Persero) Kaltimara</p>
    </div>

    <div class="container">
        <div class="circle-container">
            <div class="circle">
                <a href="form_jadwal_janji_temu.php">

                    <img src="images/tangan.jpg" alt="Jadwal Janji Temu">
                </a>
            </div>
            <div class="description">Jadwal Janji Temu</div>
        </div>
        <div class="circle-container">
            <div class="circle">
                <a href="form_jadwal_buku_tamu.php">
                    <img src="images/book.jpg" alt="Buku Tamu">
                </a>
            </div>
            <div class="description">Buku Tamu</div>
        </div>
    </div>
</body>

</html>