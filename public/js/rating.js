$(document).ready(function() {
    var stars = document.querySelectorAll('.rating-stars i');
    var ratingValue = document.getElementById('rating-value');
    console.log(stars);
    stars.forEach(function(star) {
        star.addEventListener('mouseover', function() {
            console.log('ok');
            var rating = this.getAttribute('data-rating');

            for (var i = 0; i < stars.length; i++) {
                if (i < rating) {
                    stars[i].classList.replace('fa-star-o', 'fa-star');
                  } else {
                    stars[i].classList.replace('fa-star', 'fa-star-o');
                  }
            }
        });

        star.addEventListener('click', function() {
            var rating = this.getAttribute('data-rating');

            ratingValue.value = rating;
        });

        star.addEventListener('mouseout', function() {
            var rating = ratingValue.value;

            for (var i = 0; i < stars.length; i++) {
                if (i < rating) {
                    stars[i].classList.replace('fa-star-o', 'fa-star');
                  } else {
                    stars[i].classList.replace('fa-star', 'fa-star-o');
                  }
            }
        });
    });
});
