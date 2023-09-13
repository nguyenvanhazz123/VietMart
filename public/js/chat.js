
$(document).ready(function() {
    
    var receiverId; // Khai báo biến receiverId ở đây để sử dụng sau này

    $('#user-list li').on('click', function(event) {
        receiverId = $(this).attr('data-user-id'); // Gán receiverId từ user đã chọn
        var chatHeader = $('.user_info span');
        var chatMessages = $('#chat-messages');
        var chatForm = $('#chat-form');
        chatHeader.text('Chat with ' + $(this).text());
        chatMessages.empty();
        chatForm.attr('data-receiver-id', receiverId);
        getMessages(receiverId);
        
    });
    
    // Event handler when submitting the chat form
    $('#chat-form').on('submit', function(event) {
        event.preventDefault();
        var messageInput = $('#messageInput');
        var message = messageInput.val();
        if (message.trim() !== '') {
            sendMessage(receiverId, message); // Sử dụng receiverId đã lưu trước đó
            messageInput.val('');
        }

    });

    function appendMessage(message, isSender) {
        var imgContainer = isSender ? "<div class='img_cont_msg'><img src='https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg' class='rounded-circle user_img_msg'></div>" : "";
        var messageElement = $("<div class='d-flex justify-content-end mb-4'>" +
            "<div class='msg_cotainer_send'>" +
            message +
            "<span class='msg_time'>8:40 AM, Today</span>" +
            "</div>" + imgContainer +
            "</div>");
        $('#chat-messages').append(messageElement);
    }
    
    function getMessages(receiverId) {
        // Gán giá trị receiverId cho data-receiver-id của form
        $('#chat-form').data('receiver-id', receiverId);

        $.ajax({
            url: 'http://localhost/DoAn/vietmart/messages/' + receiverId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var messages = response;
                var chatMessages = $('#chat-messages');
                chatMessages.empty();
                messages.forEach(function(message) {
                    var messageText = message.message;
                    var time = message.created_at;
                    var createdAtDate = new Date(time);

                    // Định dạng lại chuỗi ngày tháng với giờ và phút
                    var formattedDate = createdAtDate.toLocaleString('en-US', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    });
                    var messageSender = 
                        $("<div class='d-flex justify-content-start mb-4'>" +
                            "<div class='img_cont_msg'>" +
                            "<img src='https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg' class='rounded-circle user_img_msg'>" +
                            "</div>" +
                            "<ul>" +                           
                            "<li> <div class='msg_cotainer'>" + messageText + "</div></li>" +
                            "<li><span class='msg_time_send'>"+ formattedDate +"</span></li>" +
                            "</ul>" +                 
                            "</div>");

                    var messageReceiver = $("<div class='d-flex justify-content-end mb-4'>" +
                            // "<div class='msg_cotainer_send'>" +
                            // messageText +
                            // "<span class='msg_time_send'>8:55 AM, Today</span>" +
                            // "</div>" +
                            "<ul>" +                           
                            "<li> <div class='msg_cotainer_send'>" + messageText + "</div></li>" +
                            "<li><span class='msg_time_send'>"+ formattedDate +"</span></li>" +
                            "</ul>" +   
                            "<div class='img_cont_msg'>" +
                            "<img src='https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg' class='rounded-circle user_img_msg'>" +
                            "</div>" +
                            "</div>");
                    
                    if (receiverId == message.sender_id) {
                        chatMessages.append(messageSender);
                        chatMessages.scrollTop(chatMessages.prop("scrollHeight"));
                    } else {
                        chatMessages.append(messageReceiver);
                        chatMessages.scrollTop(chatMessages.prop("scrollHeight"));
                    }
                });
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    const pusher = new Pusher('ea5cd2be020efb8bd1d5', {
        cluster: 'ap1',
        useTLS: true
    });


    const channel = pusher.subscribe('chat-channel');
    channel.bind('chat-event', function(data) {
        // Xử lý tin nhắn nhận được và hiển thị nó trong giao diện
        getMessages(receiverId);
    });
    // Hàm gửi tin nhắn
    function sendMessage(receiverId, message) {
        // Lấy giá trị CSRF token
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Gửi yêu cầu POST với CSRF token đính kèm
        $.ajax({
            url: 'http://localhost/DoAn/vietmart/send',
            method: 'POST',
            data: {
                receiver_id: receiverId,
                message: message
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            dataType: 'json',
            success: function(response) {
                // Thêm tin nhắn mới vào khung chat              
                appendMessage(message, true);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
    
    
   
    
});