$(document).ready(function() {
    var baseUrl = '/DoAn/vietmart';
    //Xử lý select voucher type
    $('#discount_type').change(function() {
        var selectedOption = $(this).val();

        // Ẩn tất cả các input
        $('#fixedDiscountInput').hide();
        $('#percentageDiscountInput').hide();
        $('#maxDiscountInputGroup').hide();

        // Hiển thị input tương ứng với lựa chọn
        if (selectedOption === 'fixed') {
            $('#fixedDiscountInput').show();
        } else if (selectedOption === 'percentage') {
            $('#percentageDiscountInput').show();
            $('#maxDiscountInputGroup').show();
        }
    });


    //=======================================================================
    $('.nav-link.active .sub-menu').slideDown();
    $('#general_info.active .sub-menu-child').slideDown();
    $('#private_info.active .sub-menu-child').slideDown();
    $('#sidebar-menu .arrow').click(function() {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');

    });
    $('#sidebar-menu .arrow-child').click(function() {
        var submenu = $(this).parents('li').children('.sub-menu-child');
        submenu.slideToggle();
        $(this).toggleClass('fa-angle-down fa-angle-right');
    });
    

    $("input[name='checkall']").click(function() {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });

     //Load phân khúc, loại sản phẩm
     $('#industry-select').change(function() {
        var fieldset = document.getElementById('fieldset-private-info');
        var fieldset_sale = document.getElementById('fieldset-sale-info');
        fieldset.style.display = 'none';
        fieldset_sale.style.display = 'none';
        var industryId = $(this).val();
        if (industryId) {
            $.ajax({
                url: baseUrl + '/get-segments/' + industryId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#segment-select').empty();
                    $('#product-cat-select').empty();
                    $('#segment-select').append('<option value="">Chọn phân khúc</option>');
                    $.each(data, function(key, value) {
                        $('#segment-select').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        } else {
            $('#segment-select').empty();
            $('#product-cat-select').empty();
        }
    });
    
    $('#segment-select').change(function() {
        var segmentId = $(this).val();
        if (segmentId) {
            $.ajax({
                url: baseUrl + '/get-product-cats/' + segmentId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#product-cat-select').empty();
                    $('#product-cat-select').append('<option value="">Chọn loại</option>');
                    $.each(data, function(key, value) {
                        $('#product-cat-select').append('<option value="' + value.id + '">' + value.cat_name + '</option>');
                    });
                }
            });
        } else {
            $('#product-type-select').empty();
        }
    });
  
    //Load thông tin khác
    $('#product-cat-select').change(function() {
        var product_cat_id = $(this).val();
        var fieldset = document.getElementById('fieldset-private-info');
        var fieldset_sale = document.getElementById('fieldset-sale-info');
        const box = document.getElementById("child");
        if (this.value !== '') {
            fieldset.style.display = 'block'; // Hiển thị fieldset khi có loại sản phẩm được chọn
            fieldset_sale.style.display = 'block'; 
            box.innerHTML = '';
        }else {
            fieldset.style.display = 'none'; // Ẩn fieldset khi không có loại sản phẩm được chọn
            fieldset_sale.style.display = 'none';
        }
        loadAttributes(product_cat_id);
    });
    
    document.getElementById("addDetails").addEventListener("click", function() {
        const fieldset = document.getElementById("fieldset-sale-info");
        const box = document.getElementById("child");
        // const sale_info = document.getElementById("sale-info");
        // box.appendChild(sale_info.cloneNode(true));
        const saleInfo = document.getElementById("sale-info");
        const clonedSaleInfo = saleInfo.cloneNode(true);

        // Đặt tất cả các giá trị input trong bản sao về rỗng
        const inputFields = clonedSaleInfo.getElementsByTagName("input");
        for (let i = 0; i < inputFields.length; i++) {
            inputFields[i].value = "";
        }

        box.appendChild(clonedSaleInfo);

        fieldset.style.display = "block";
    });
   
   
    
});

function loadAttributes(product_cat_id) {
    var baseUrl = '/DoAn/vietmart';
    var list_id_fashion = ['8', '9'];
    var list_electronic_device = ['10'];
    var industryId = $('#industry-select').val();
    if(list_id_fashion.includes(industryId)){
        industryId = 8;
    }
    if(list_electronic_device.includes(industryId)){
        industryId = 10;
    }

    $.ajax({
        url: baseUrl + '/attributes/' + product_cat_id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            //Load brand
           
            var list_brand = response.list_brand;
            var brand_box = '';
            brand_box += '<label for="brand">Thương hiệu</label>' +
                                '<select class="form-control" name="brand_id">' +
                                '<option value="">Chọn thương hiệu</option>';
            list_brand.forEach(function(brand) {
                if(brand.industry_id == industryId) {
                    brand_box += '<option value="' + brand.id + '">' + brand.name + '</option>'; 
                }
            });
            brand_box += '</select>';
            $('#brand-box').html(brand_box);

            //Load material
            if(industryId != 10){
                var list_material = response.list_material;
                var material_box = '';
                material_box += '<label for="brand">Chất liệu</label>' +
                                    '<select class="form-control" name="material_id">' +
                                    '<option value="">Chọn chất liệu</option>';
                list_material.forEach(function(material) {  
                    if(material.industry_id == industryId) {   
                        material_box += '<option value="' + material.id + '">' + material.name + '</option>';  
                    }  
                });
                material_box += '</select>';
                $('#material-box').html(material_box);
            }else {
                // Clear the material_box content when industryId is not equal to 8
                $('#material-box').empty();
            }
            

             //Load pattern
             if(industryId != 10){
             var list_pattern = response.list_pattern;
             var pattern_box = '';
             pattern_box += '<label for="brand">Mẫu</label>' +
                                 '<select class="form-control" name="pattern_id">' +
                                 '<option value="">Chọn mẫu</option>';
             list_pattern.forEach(function(pattern) { 
                if(pattern.industry_id == industryId) {   
                    pattern_box += '<option value="' + pattern.id + '">' + pattern.name + '</option>';  
                }      
             });
             pattern_box += '</select>';
             $('#pattern-box').html(pattern_box);
            }else {
                $('#pattern-box').empty();
            }

            // Load attribute
            var attributes = response.attributes;
            var attributeValues = response.attributeValues;

            var attribute_box = '';
            attributes.forEach(function(attribute) {
                attribute_box += '<label for="attribute_' + attribute.id + '">' + attribute.name + '</label>' +
                                '<select class="form-control" name="attribute_values[' + attribute.id + ']">' +
                                '<option value="">Select Value</option>';
                attributeValues.filter(function(value) {
                    return value.attribute_id === attribute.id;
                }).forEach(function(value) {
                    attribute_box += '<option value="' + value.id + '">' + value.value + '</option>';
                });
                attribute_box += '</select><br>';
            });

            $('#attribute-box').html(attribute_box);
        },
        error: function(response) {
            console.log(response);
        }
    });
    
}

