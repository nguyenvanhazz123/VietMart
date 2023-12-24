$(document).ready(function() {   
    var baseUrl = '/DoAn/vietmart'; 
    $('#sizeSelect').change(function () {
        var colorSelect = document.getElementById('colorSelect');
        var addToCartLink = $('.add-to-cart');
        addToCartLink.data('color-id', "");
        var selectedSize = this.value;

        if(selectedSize.value == 0){
            colorSelect.innerHTML = "";
            return;
        }
        var product_id_detail = this.getAttribute("data-product-id");
        //Hiện mảng màu sắc
         // Tạo một yêu cầu AJAX để lấy danh sách màu sắc
         $.ajax({
            url: baseUrl + '/getColorsBySize/' + product_id_detail + "/" + selectedSize,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Cập nhật danh sách màu sắc trong phần tử select (colorSelect)
                colorSelect.innerHTML = ""; // Xóa tất cả tùy chọn hiện tại
                var option = document.createElement("option");
                option.value = "";
                option.textContent = "Chọn màu";
                colorSelect.appendChild(option);
                data.forEach(function (color) {
                    option = document.createElement("option");
                    option.value = color.id;
                    option.textContent = color.name;
                    colorSelect.appendChild(option);
                });
            },
            error: function (xhr, status, error) {
                console.log('Lỗi trong quá trình lấy dữ liệu màu sắc.');
            }
        });

        var product = $('.add-to-cart');
        product.data('size-id', selectedSize);
        
    });

    $('#colorSelect').on('change', function() {
        var colorId = $(this).val(); // Lấy giá trị color id
        var product = $('.add-to-cart');
        // Cập nhật giá trị color-id trong thuộc tính data
        product.data('color-id', colorId);

        var selectSizeId = document.getElementById('sizeSelect')
        var newPrice = null;
        var inventoryData = inventories;
        for (var key in inventoryData) {
            if (inventoryData.hasOwnProperty(key)) {
                var inventoryItem = inventoryData[key];               
                if (inventoryItem.color_id == colorId && inventoryItem.size_id == selectSizeId.value) {
                    newPrice = inventoryItem.price;
                    break;
                }
            }
        }
        if (newPrice != null) {
            var formattedPrice = newPrice.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });   
            document.getElementById('productPrice').textContent = formattedPrice;
        }

         //=========================Xử lí hình ảnh================================
         var sizeLinks = document.querySelectorAll('.thumb-menu a');
         sizeLinks.forEach(function(link) {
             link.classList.remove('active');
         }); 
 
         var tabPanes = document.querySelectorAll('.thumbnail-tab-content .tab-pane');
         tabPanes.forEach(function(tabPane) {
             tabPane.classList.remove('show');
             tabPane.classList.remove('active');
         });
         
 
         //Ảnh nhỏ       
         var id_size = document.getElementById('size_id_' + colorId);
         id_size.classList.add('active')
 
         //Ảnh lớn
         var size_large = document.querySelectorAll('.size_lager_id_' + colorId + '_' + selectSizeId.value);    
         size_large.forEach(function(element) {
             element.classList.add('show');
             element.classList.add('active');
         });
    });

    // Kiểm tra URL để xác định trạng thái trang
    if (window.location.href.indexOf('/vietmart/search') !== -1) {
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
        // Tạo URL mới với các tham số tìm kiếm và các tham số khác
        var searchURL = baseUrl + "/search" + '?keyword=' + encodeURIComponent(keyword);
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
        var query = $(this).val().trim();
    
        $.ajax({
            type: 'GET',
            url: baseUrl + '/search-sug',
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
                            window.location.href = baseUrl + '/search?keyword=' + keyword;
                          
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
        event.preventDefault(); 
        $('html, body').animate({
            scrollTop: $('.review-title').offset().top
        }, 700);
        
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


    //Thêm sản phẩm vào giỏ hàng
    $('.add-to-cart').on('click', function(e) {
        e.preventDefault(); 
        var priceValue = parseInt(document.querySelector('.priceName').innerHTML.replace('đ', '').replace(/\./g, ''));
        var numericValue = parseFloat(priceValue);
        var productId = $(this).data('product-id');
        var size_id = $(this).data('size-id');
        var color_id = $(this).data('color-id');     
        if(color_id == "" || size_id == ""){
            alert("Vui lòng chọn phân loại và màu sắc sản phẩm");
            return;
        }
        var data = {price: numericValue, id: productId, sizeId: size_id, colorId: color_id};
        $.ajax({
            type: 'GET', 
            url: baseUrl + '/cart/add/' + productId,
            data: data,
            dataType: 'json',
            success: function(response) {
                $('.total-pro').text(response.cartCount);
                $('#add_cart_success .modal-body').text(response.message);
                $('#add_cart_success').modal('show');
            },
            error: function(error) {
                // Xử lý lỗi nếu có
            }
        });
    });
    //UPDATE giỏ hàng
    $('.quantity-input').on('input', function() {
        var quantityInput = $(this);
        var productId = quantityInput.data('product-id');
        var newQuantity = parseInt(quantityInput.val());
        var price = quantityInput.data('price')
        if (!isNaN(newQuantity) && newQuantity >= 0) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: baseUrl + '/cart/update',
                data: {
                    _token: csrfToken,
                    quantity: {
                        [productId]: newQuantity
                    }
                },
                success: function(response) {
                    if (response.success) {      
                        console.log(response.discountPrice)
                        console.log(response.discountValue)
                        // Cập nhật giá tiền trên trang
                        var productPriceCell = $('.product-price[data-product-id="' + productId + '"]');                        
                        var newPrice = newQuantity * price;                        
                        var formattedPrice = newPrice.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
                        productPriceCell.text(formattedPrice);  
                        if(response.discountValue){
                            var formattedDiscount = response.discountPrice.toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            });
                            $('.cart-subtotal .amount').text(formattedDiscount);
                            updateTotalAmount(response.discountPrice);                            
                        }else{
                            updateTotalAmount(0)
                        }               
                    }
                },
                error: function(xhr) {
                    console.log("loi")
                    // Xử lý lỗi khi gửi yêu cầu AJAX
                }
            });
        }
    });
    function updateTotalAmount(discountValue) {
        var totalAmount = 0;              
        $('.product-price').each(function() {
            var productPriceText  = parseFloat($(this).text().replace(/\D/g, ''));            
            var productPrice = parseFloat(productPriceText);
            totalAmount += productPrice;
        });
        totalAmount = totalAmount - discountValue;

        var formattedTotalAmount = totalAmount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        $('.total-amount').text(formattedTotalAmount);
    }
    //UPDATE sau khi dùng voucher
    $('.btn-voucher').click(function (e) {
        e.preventDefault();
        // Lấy giá trị mã giảm giá từ input
        var voucherText = $('input[name="voucher_text"]').val();
        console.log(voucherText);
        // Gửi Ajax request
        $.ajax({
            type: 'POST',
            url: baseUrl + '/cart/voucher',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'voucher_text': voucherText
            },
            success: function (data) {
                console.log(data.discount);
                console.log(data.newTotal);
                if (data.success) {    
                    alert(data.message);                
                    var formattedDiscount = data.discount.toLocaleString('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    });
                    $('.cart-subtotal .amount').text(formattedDiscount);

                    // Cập nhật tổng tiền
                    var formattedTotal = data.newTotal.toLocaleString('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    });
                    $('.total-amount').text(formattedTotal);
                    $('#voucherInput').val('');
                } else {
                    // Hiển thị thông báo khi mã giảm giá không đúng
                    alert(data.message);
                    $('#voucherInput').val('');
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
   

    //Thêm sản phẩm vào mục yêu thích
    $('.add-to-wishlist').on('click', function(e) {
        e.preventDefault(); 
        var productId = $(this).data('product-id'); 
        $.ajax({
            type: 'GET', 
            url: baseUrl + '/wishlist/add/' + productId, 
            dataType: 'json',
            success: function(response) {
                if(response.messageTrue) {
                    $('.count-wishlist').text('list ' + '(' + response.list_wish_list + ')');
                    $('#add_wishlist_success .modal-body').text(response.messageTrue);
                    $('#add_wishlist_success').modal('show')
                }
                else{
                    $('#add_wishlist_fail .modal-body').text(response.messageFalse);
                    $('#add_wishlist_fail').modal('show');
                }                        
            },
            error: function(error) {
                // Xử lý lỗi nếu có
            }
        });
    });

    
    //Nhận xét sản phẩm
    $(document).ready(function() {
        $('.ajax-form').submit(function(event) {
            event.preventDefault();
    
            var formData = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: 'POST', 
                url: url, 
                data: formData,
                dataType: 'json',
                success: function(response) {                   
                    if(response.success_review) {
                        $('#success_review .modal-body').text(response.success_review);
                        $('#success_review').modal('show')
                        $('.btn-close').click(function() {
                            window.location.reload();
                        })
                    }
                    else{
                        $('#check_review .modal-body').text(response.check_review);
                        $('#check_review').modal('show');
                        $('.btn-close').click(function() {
                            window.location.reload();
                        })
                    }     
                },
                error: function(error) {
                    alert('Đã xảy ra lỗi khi gửi đánh giá.');
                    // Xử lý lỗi nếu cần thiết
                }
            });
        });
    });
    
   
});

function removeFromCart(id) {
    var baseUrl = '/DoAn/vietmart'; 
    $.ajax({
        url: baseUrl + '/cart/remove/' + id,
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
    var baseUrl = '/DoAn/vietmart'; 
    $.ajax({
        url: baseUrl + '/wishlist/remove/' + id,
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



