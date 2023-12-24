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
    $('.product-rating-overview__filter').on('click', function () {
        // Ẩn tất cả các nút lọc
        $('.product-rating-overview__filter').removeClass('product-rating-overview__filter--active');

        // Thêm lớp active-filter cho nút lọc được click
        $(this).addClass('product-rating-overview__filter--active');       
    });
    // Xử lý khi click vào tất cả
    $('#allFilter').on('click', function() {
        $('.review-list').show();
    });

    // Xử lý khi click vào 5 sao
    $('#fiveStarFilter').on('click', function() {
        $('.review-list').hide();
        $('.star-rating-5').show();
    });   
   

    // Xử lý khi click vào 4 sao
    $('#fourStarFilter').on('click', function() {
        $('.review-list').hide();
        $('.star-rating-4').show();
    });

    // Xử lý khi click vào 3 sao
    $('#threeStarFilter').on('click', function() {
        $('.review-list').hide();
        $('.star-rating-3').show();
    });

    // Xử lý khi click vào 2 sao
    $('#twoStarFilter').on('click', function() {
        $('.review-list').hide();
        $('.star-rating-2').show();
    });

    // Xử lý khi click vào 1 sao
    $('#oneStarFilter').on('click', function() {
        $('.review-list').hide();
        $('.star-rating-1').show();
    });

});
