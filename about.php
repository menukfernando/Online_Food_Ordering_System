
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Fresh Wheels</title>
    <link rel="stylesheet" href="styles.css">
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        header nav ul li {
            margin-left: 20px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        main {
            padding: 20px 0;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        .about-us {
            background: #fff;
            padding: 20px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .about-us h2 {
            margin-top: 0;
        }

        .about-us p {
            margin: 10px 0;
            line-height: 1.6;
        }

        .team {
            display: flex;
            flex-wrap: wrap;
        }

        .team-member {
            flex: 1 1 calc(33.333% - 20px);
            margin: 10px;
            background: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .team-member img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .team-member h3 {
            margin: 0 0 10px 0;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <?php include ('header.php'); ?>

    <main>
        <div class="container">
            <div class="about-us">
                <h2>About Us</h2>
                <p>Welcome to our restaurant! We are passionate about delivering the best dining experience to our customers. Our team of dedicated chefs and staff work tirelessly to create delicious meals using the freshest ingredients.</p>
                <p>Our mission is to provide a welcoming atmosphere where you can enjoy great food with family and friends. We take pride in our diverse menu, offering a wide range of appetizers, main courses, desserts, and beverages to suit every taste.</p>
                <p>Thank you for choosing our restaurant. We look forward to serving you!</p>
            </div>
            <div class="team">
                <div class="team-member">
                    <img src="./images/chef1.jpg" alt="John Doe">
                    <h3>John Doe</h3>
                    <p>Head Chef</p>
                </div>
                <div class="team-member">
                    <img src="./images/chef2.jpg" alt="Jane Smith">
                    <h3>Jane Smith</h3>
                    <p>Restaurant Manager</p>
                </div>
                <div class="team-member">
                    <img src="./images/chef3.jpg" alt="Michael Brown">
                    <h3>Michael Brown</h3>
                    <p>Sous Chef</p>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Fresh Wheels. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
