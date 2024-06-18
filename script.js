// JavaScript for filtering restaurants based on cuisine and rating
document.getElementById('filter-form').addEventListener('submit', function(event) {
    event.preventDefault();

    var cuisineFilter = document.getElementById('cuisine').value;
    var ratingFilter = parseInt(document.getElementById('rating').value);

    var restaurants = document.querySelectorAll('.restaurant');

    restaurants.forEach(function(restaurant) {
        var cuisine = restaurant.getAttribute('data-cuisine');
        var rating = parseInt(restaurant.getAttribute('data-rating'));

        var showRestaurant = (cuisineFilter === 'all' || cuisine === cuisineFilter) &&
                             (ratingFilter === 0 || rating >= ratingFilter);

        if (showRestaurant) {
            restaurant.style.display = 'block';
        } else {
            restaurant.style.display = 'none';
        }
    });
});


/* MENU PAGE */




