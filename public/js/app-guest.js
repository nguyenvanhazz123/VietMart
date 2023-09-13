$(document).ready(function() {
    // Kiểm tra URL để xác định trạng thái trang
    if (window.location.href.indexOf('/vietmart/search') !== -1) {
        // Trang hiện tại là trang search
        // Thêm sự kiện change cho dropdown sắp xếp trên trang search
        $('.order_by').change(function() {
            var selectedValue = $(this).val();

            // Lấy keyword từ URL
            var keyword = getUrlParameter('keyword');
            var min_price = getUrlParameter('min_price');
            var max_price = getUrlParameter('max_price');
            var newURL = updateQueryStringParameter(industryListURL, 'keyword', keyword);
            
            if (selectedValue) {
                newURL = updateQueryStringParameter(newURL, 'order_by', selectedValue);
            }
            if (min_price) {
                newURL = updateQueryStringParameter(newURL, 'min_price', min_price);
            }

            if (max_price) {
                newURL = updateQueryStringParameter(newURL, 'max_price', max_price);
            }
            history.pushState(null, '', newURL);
            // Chuyển đến trang search mới với các tham số mới
            loadProductsBySearchAndSort(newURL);
        });
    } else {
        // Trang hiện tại là trang list
        // Thêm sự kiện change cho dropdown sắp xếp trên trang list
        $('.order_by').change(function() {
            var selectedValue = $(this).val();

            // Lấy danh mục đã chọn từ URL
            var segmentId = getUrlParameter('segment');
            var min_price = getUrlParameter('min_price');
            var max_price = getUrlParameter('max_price');

            // Cập nhật URL với giá trị order_by mới và danh mục đã chọn (nếu có)
            var newURL = updateQueryStringParameter(industryListURL, 'order_by', selectedValue);
            if (segmentId) {
                newURL = updateQueryStringParameter(newURL, 'segment', segmentId);
            }

            if (min_price) {
                newURL = updateQueryStringParameter(newURL, 'min_price', min_price);
            }

            if (max_price) {
                newURL = updateQueryStringParameter(newURL, 'max_price', max_price);
            }

            // Sử dụng API History để thay đổi URL trên thanh địa chỉ mà không làm mới trang
            history.pushState(null, '', newURL);

            // Gửi yêu cầu Ajax để tải sản phẩm theo danh mục và sắp xếp
            loadProductsByCategoryAndSort(segmentId, selectedValue, newURL);
        });
    }


    $('.category-link').click(function (event) {
        event.preventDefault();

        var segmentId = $(this).data('segment-id');
        // Loại bỏ class "active" khỏi tất cả các link danh mục
        $('.category-link').removeClass('active');
        // Thêm class "active" vào link danh mục được click
        $(this).addClass('active');

        var orderby = getUrlParameter('order_by');
        var min_price = getUrlParameter('min_price');
        var max_price = getUrlParameter('max_price');
        // Gửi yêu cầu Ajax để tải sản phẩm của danh mục đã chọn
        loadProductsByCategoryAndSort(segmentId, getUrlParameter('order_by'));

        // Cập nhật URL với danh mục đã chọn (nếu có)
        var newURL = updateQueryStringParameter(industryListURL, 'segment', segmentId);
        if (orderby) {
            newURL = updateQueryStringParameter(newURL, 'order_by', orderby);
        }

        if (min_price) {
            newURL = updateQueryStringParameter(newURL, 'min_price', min_price);
        }

        if (max_price) {
            newURL = updateQueryStringParameter(newURL, 'max_price', max_price);
        }

        // Sử dụng API History để thay đổi URL trên thanh địa chỉ mà không làm mới trang
        history.pushState(null, '', newURL);
    });

    // Hàm gửi yêu cầu Ajax để tải sản phẩm theo danh mục và sắp xếp
    function loadProductsByCategoryAndSort(segmentId, sortOption, newURL) {
        var url = newURL;
        var filters = {};
        if (segmentId) {
            filters.segment = segmentId;
        }
        if (sortOption) {
            filters.orderby = sortOption;
        }

        $.ajax({
            url: url,
            type: "GET",
            data: filters,
            dataType: 'json',
            success: function (data) {
                
                $('#product-list-container').html(data);
            },
            error: function (xhr, status, error) {
                // Xử lý lỗi nếu cần thiết
            }
        });
    }
    function loadProductsBySearchAndSort(url) {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {

                // Cập nhật container danh sách sản phẩm với nội dung mới từ server
                $('#product-list-container').html(data);
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi nếu cần thiết
            }
        });
    }

    //=============================SEARCH================================================================
    var form = document.getElementById('search-form');
    // Lắng nghe sự kiện submit của form
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        // Lấy giá trị từ input tìm kiếm
        var keyword = $(this).find('input[name="keyword"]').val();

        // Lấy các tham số khác từ URL hiện tại (nếu có)
        // var orderby = getUrlParameter('orderby');
        // var min_price = getUrlParameter('min_price');
        // var max_price = getUrlParameter('max_price');

        // Tạo URL mới với các tham số tìm kiếm và các tham số khác
        var searchURL = "http://localhost/DoAn/vietmart/search" + '?keyword=' + encodeURIComponent(keyword);
        // if (orderby) {
        //     searchURL += '&order_by=' + encodeURIComponent(orderby);
        // }
        // if (min_price) {
        //     searchURL += '&min_price=' + encodeURIComponent(min_price);
        // }
        // if (max_price) {
        //     searchURL += '&max_price=' + encodeURIComponent(max_price);
        // }
        // Gửi yêu cầu Ajax để tải sản phẩm theo các tham số tìm kiếm và sắp xếp
        loadProductsBySearch(searchURL);
      
    });

    function loadProductsBySearch(url) {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Cập nhật container danh sách sản phẩm với nội dung mới từ server
                $('#product-list-container').html(data);
            
                // Chuyển đến trang danh sách tìm kiếm
                window.location.href = url;
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi nếu cần thiết
            }
        });
    }

    var searchInput = $('#searchInput');
    var searchResults = $('#searchResults');
    // Ẩn searchResults khi mất focus (click ra khỏi ô input)
    searchInput.on('blur', function() {
        searchResults.css('display', 'none');
    });

    // Hiện searchResults khi ô input được focus (click vào ô input)
    searchInput.on('focus', function() {
        searchResults.css('display', 'block');
    });

    searchInput.on('input', function() {
        var query = $(this).val().trim(); // Lấy giá trị của ô input và loại bỏ khoảng trắng ở đầu và cuối
    
        $.ajax({
            type: 'GET',
            url: 'http://localhost/DoAn/vietmart/search-sug',
            data: { query: query },
            success: function(data) {
                var resultsDiv = $('#searchResults');
    
                // Xóa kết quả cũ
                resultsDiv.empty();
    
                if (data != null && data != undefined) {
                    resultsDiv.css('display', 'block');
    
                    // Hiển thị kết quả gợi ý dưới đây
                    data.forEach(function(result) {
                        resultsDiv.append('<p>' + result.name + '</p>');
                    });
    
                    // Thêm sự kiện click vào kết quả gợi ý
                    var resultItems = $('#searchResults p');
                    resultItems.each(function(index, element) {                        
                        $(element).mousedown(function() {
                            var keyword = $(this).text(); // Lấy nội dung của kết quả được click

                            // Thực hiện route search với giá trị keyword
                            window.location.href = 'http://localhost/DoAn/vietmart/search?keyword=' + keyword;
                          
                        })
                    });
                } else {
                    resultsDiv.css('display', 'none'); // Ẩn kết quả gợi ý nếu không có dữ liệu
                }
            }
        });
    });
   
   


    // Hàm cập nhật tham số trong URL
    function updateQueryStringParameter(url, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = url.indexOf('?') !== -1 ? "&" : "?";
        if (url.match(re)) {
            return url.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            return url + separator + key + "=" + value;
        }
    }

    // Hàm lấy giá trị tham số từ URL
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }


    $('#comment-user').click(function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
        // Bật lớp "active" cho liên kết "Nhận xét"

        // Chuyển đến phần đánh giá sản phẩm
        $('html, body').animate({
            scrollTop: $('.review-title').offset().top
        }, 700);

        // Tập trung vào textarea sau khi chuyển đến phần đánh giá sản phẩm
        $('#comments').focus();
    });

    $('#review-link').click(function(event) {
        event.preventDefault();
    
        // Lấy href của liên kết
        var href = $(this).find('a').attr('href');
    
        // Chuyển đến trang chi tiết sản phẩm
        window.location.href = href;
    
    });

    const replyLinks = document.querySelectorAll('.reply-link');
    
});

function removeFromCart(id) {
    $.ajax({
        url: 'http://localhost/DoAn/vietmart/cart/remove/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            window.location.reload();
        },
        error: function(xhr, status, error) {
            // Xử lý lỗi
            console.log(error);
        }
    });
}

function removeFromWishlist(id) {

    $.ajax({
        url: 'http://localhost/DoAn/vietmart/wishlist/remove/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            window.location.reload();
        },
        error: function(xhr, status, error) {
            // Xử lý lỗi
            console.log(error);
        }
    });
}



