<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants | Fresh Wheels</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include('header.php'); ?>

    <section id="restaurant-filters">
        <div class="container">
            <h2>Find Restaurants</h2>
            <form action="" method="GET" id="filter-form">
                <label for="cuisine">Cuisine Type:</label>
                <select name="cuisine" id="cuisine">
                    <option value="all">All Cuisines</option>
                    <option value="italian">Italian</option>
                    <option value="chinese">Chinese</option>
                    <option value="indian">Indian</option>
                    <option value="mexican">Mexican</option>
                </select>

                <label for="rating">Minimum Rating:</label>
                <select name="rating" id="rating">
                    <option value="0">Any</option>
                    <option value="1">1 star</option>
                    <option value="2">2 stars</option>
                    <option value="3">3 stars</option>
                    <option value="4">4 stars</option>
                    <option value="5">5 stars</option>
                </select>

                <button type="submit" class="btn">Apply Filters</button>
            </form>
        </div>
    </section>

    <section id="restaurant-listings">
        <div class="container">
            <h2>Restaurants</h2>
            <div class="restaurant-list">
                <?php
                // Example restaurant data
                $restaurants = [
                    ['name' => 'Kingsbury', 'cuisine' => 'italian', 'rating' => 4, 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'],
                    ['name' => 'Restaurant B', 'cuisine' => 'chinese', 'rating' => 3, 'description' => 'Nulla facilisi. Sed feugiat tellus ut metus aliquet.'],
                    ['name' => 'Restaurant C', 'cuisine' => 'indian', 'rating' => 5, 'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.'],
                    ['name' => 'Restaurant D', 'cuisine' => 'mexican', 'rating' => 4, 'description' => 'Aenean fermentum augue eget finibus rutrum.'],
                    ['name' => 'Restaurant E', 'cuisine' => 'italian', 'rating' => 3, 'description' => 'Fusce ut magna ac justo pharetra convallis.'],
                    ['name' => 'Restaurant F', 'cuisine' => 'chinese', 'rating' => 2, 'description' => 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam vehicula cursus turpis.'],
                    ['name' => 'Restaurant G', 'cuisine' => 'mexican', 'rating' => 4, 'description' => 'Sed non felis quis orci dapibus tincidunt.'],
                ];

                // Get the list of images in the restaurants folder
                $image_directory = './images/restaurants/';
                $images = array_diff(scandir($image_directory), array('.', '..'));

                // Function to get a random image
                function getRandomImage($images) {
                    return $images[array_rand($images)];
                }

                // Display restaurants
                foreach ($restaurants as $restaurant) {
                    $image = getRandomImage($images);
                    echo '<div class="restaurant" data-cuisine="' . $restaurant['cuisine'] . '" data-rating="' . $restaurant['rating'] . '">';
                    echo '<img src="' . $image_directory . $image . '" alt="' . $restaurant['name'] . '">';
                    echo '<h3>' . $restaurant['name'] . '</h3>';
                    echo '<p><strong>Cuisine:</strong> ' . ucfirst($restaurant['cuisine']) . '</p>';
                    echo '<p><strong>Rating:</strong> ' . $restaurant['rating'] . ' stars</p>';
                    echo '<p>' . $restaurant['description'] . '</p>';
                    echo '<a href="menu.php" class="btn">View Menu</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Fresh Wheels. All rights reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>
