// $(document).ready(function() {
//     // Lấy giá trị của tham số "industry" trong URL
//     var currentIndustry = getParameterByName('industry');

//     // Xóa lớp "active" khỏi tất cả các phần tử danh sách sau khi trang được tải lại
//     $(".vertical-menu-list li").removeClass("active");

//     // Thêm lớp "active" vào phần tử đang active (nếu có)
//     if (currentIndustry !== null) {
//         $(".vertical-menu-list li").each(function() {
//             if ($(this).find("a").attr("href").indexOf("industry=" + currentIndustry) !== -1) {
//                 $(this).addClass("active");
//             }
//         });
//     }
// });

// // Hàm hỗ trợ lấy giá trị của tham số trong URL
// function getParameterByName(name, url) {
//     if (!url) {
//         url = window.location.href;
//     }
//     name = name.replace(/[\[\]]/g, '\\$&');
//     var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
//         results = regex.exec(url);
//     if (!results) return null;
//     if (!results[2]) return '';
//     return decodeURIComponent(results[2].replace(/\+/g, ' '));
// }