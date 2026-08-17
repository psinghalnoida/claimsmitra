<?php $this->load->view('adminpanel/layout/sidebar');?>
<!-- Main Container Start -->
<main class="main--container">
<!-- Tab Content Start -->
<div class="tab-content" style="padding:0px;">
    <!-- Wrapper Start -->
    <div class="tab-pane fade show active" id="tab10">
        <?php $this->load->view('adminpanel/chat/heading');?>
         <section class="main--content">
                <div class="panel" id="chatting">
                    <!-- App Start -->
                    <div class="app_wrapper row">

                        <!-- App Sidebar Start -->
                        <div class="app_sidebar col-lg-3 col-md-6">
                            <!-- Toolbar Start -->
                            <div class="toolbar">
                                <!-- App Search Bar Start -->
                                <form action="#" method="get" class="app_searchBar w-100">
                                    <input type="search" name="emails" placeholder="Search Contact..." class="form-control" required>

                                    <button type="submit" class="btn btn-rounded">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                                <!-- App Search Bar End -->
                            </div>
                            <!-- Toolbar End -->
                            <!-- User List Start -->
                            <div class="user--list-w" data-trigger="scrollbar" id="contactslist">
                                <ul class="user--list" id="contacts">
                                <?php foreach ($users as $contact): ?>
                                    <?php if ($contact['id'] != $currentUserId): ?>
                                        <li>
                                            <a href="#" class="list-link">
                                                <div class="avatar" data-receiver-id="<?= $contact['id'] ?>">
                                                    <?php if ($contact['profilephoto'] != null || $contact['profilephoto'] != ""): ?>
                                                        <img src="<?= base_url('assets/profile/'.$contact['profilephoto']); ?>" alt="" class="rounded-circle">
                                                    <?php else: ?>
                                                        <img src="<?= base_url('assets/profile/user.png'); ?>" alt="" class="rounded-circle">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="info">
                                                    <h4 class="title">
                                                        <span class="title-text"><?= $contact['salutation'] .' '. $contact['firstname'] .' '. $contact['lastname']; ?></span>
                                                        <span class="time"><?= date('h:i A'); ?></span>
                                                    </h4>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                            <!-- User List End -->
                        </div>
                        <!-- App Sidebar End -->
                        <!-- App Content Start -->
                        <div class="app_content col-lg-9">
                            <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Chat</h3>
                            </div>

                            <div class="panel-content">
                                <!-- Chat Start -->
                                <div class="chat">
                                    <div class="chat--items" data-trigger="scrollbar">

                                    </div>

                                    <!-- Chat Form Start -->
                                    <form action="#" class="chat--form">
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm" id="message-input" placeholder="Type a message..." required>

                                            <!-- <div class="input-group-append"> -->
                                                <button type="submit" class="btn btn-sm btn-rounded btn-info px-4" id = "send-btn">
                                                    <i class="fa fa-paper-plane"></i>
                                                </button>
                                            <!-- </div> -->
                                        </div>
                                    </form>
                                    <!-- Chat Form End -->
                                </div>
                                <!-- Chat End -->
                            </div>
                        </div>
                        </div>
                        <!-- App Content End -->
                    </div>
                    <!-- App Sidebar End -->
                </div>
            </section>
    </div>
</div>
<!-- Tab Content End -->

<!-- Load job based modal -->

<!-- End of the job based modal -->
<?php $this->load->view('adminpanel/layout/footer');?>    
<script type="text/javascript">
/* ------------------------------------------------------------------------- *
* GET INCOMING CASE LIST
* ------------------------------------------------------------------------- */
var $recordsListView = $('#completedcase');

if ( $recordsListView.length ) {
    $recordsListView.DataTable({
        "serverSide":true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        
        language: {
            "lengthMenu": "View _MENU_ records"
        },
        order: [],
        // Load data from an Ajax source
        "ajax": {
            url: "<?php echo base_url('job/incomingcase'); ?>",
            type: "POST",
            dataType:"JSON",
        },
        
    });
}

$(document).ready(function () {
    var fetchingMessages = false;
    var messageInterval; // Declare a variable to store the interval ID

    // Attach click event to user list items
    $('.user--list li').on('click', function () {
        // Get the clicked user's name and ID
        var ReceiverName = $(this).find('.title-text').text();
        var ReceiverId = $(this).find('.avatar').data('receiver-id');
        var SenderId = '<?= $currentUserId ?>';
        var SenderName = '<?= $currentUserName ?>';

        // Update the chat names
        updateChatNames(ReceiverName, ReceiverId, SenderName);

        // Store ReceiverId and SenderName in data attributes of send-btn
        $('#send-btn').data('receiver-id', ReceiverId);
        $('#send-btn').data('sender-name', SenderName);

        // Clear previous interval before setting up a new one
        clearInterval(messageInterval);

        // Set up a new interval to fetch messages periodically
        messageInterval = setInterval(function () {
            if (!fetchingMessages) {
                fetchingMessages = true;
                receiveMessages(ReceiverId,ReceiverName );
            }
        }, 100);
    });

    // Function to update chat names
    function updateChatNames(ReceiverName, ReceiverId, SenderName) {
        // Select chat items
        var chatItems = $('.chat--item');

        // Update chat names based on the clicked user
        chatItems.each(function () {
            var chatUser = $(this).find('.chat--user a');
            if ($(this).data('receiverid') == $('#currentUserId').val()) {
                // Update left chat name to the current logged-in user
                chatUser.text(SenderName);
            } else {
                // Update right chat name to the clicked user
                chatUser.text(ReceiverName);
            }
            console.log("sename:", SenderName);
            console.log('Clicked UserName:', ReceiverName);
            console.log('Clicked UserId:', ReceiverId);
        });
    }

    // Event listener for button click
    $('#send-btn').on('click', function () {
        var receiverId = $(this).data('receiver-id');
        var senderName = $(this).data('sender-name');
        var senderId = '<?= $currentUserId ?>';
        sendMessage(receiverId, senderName, senderId);
    });

    // Event listener for Enter key press in the message input field
    $('#message-input').on('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            var receiverId = $('#send-btn').data('receiver-id');
            var senderName = $('#send-btn').data('sender-name');
            var senderId = '<?= $currentUserId ?>';
            sendMessage(receiverId, senderName, senderId);
        }
    });
});
  function sendMessage(receiverId, SenderName, SenderId) {
    const messageInput = document.getElementById('message-input');
    const message = messageInput.value.trim();
    console.log('send message id :', receiverId);
    console.log('send: -=', SenderName);

    if (message !== '') {
        const chatMessages = document.querySelector('.chat--items');
        const messageElement = document.createElement('div');
        messageElement.classList.add('chat--item', 'chat--right');
        const senderAvatar = $('#sender-avatar').attr('src');
        const currentTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        console.log('sendername: -=', SenderName);
        messageElement.innerHTML = `
            <div class="chat--avatar">
                <img src="${senderAvatar}" alt="" class="rounded-circle">
            </div>
            <div class="chat--content">
                <div class="chat--info">
                    <h6 class="chat--user h6">
                        <a href="#">${SenderName}</a>
                    </h6>
                    <span class="chat--time">${currentTime}</span>
                </div>
                <div class="chat--text">
                    <p>${message}</p>
                </div>
            </div>
        `;

        chatMessages.appendChild(messageElement);
        messageInput.value = '';
        chatMessages.scrollTop = chatMessages.scrollHeight;
        data = {
            receiverId: receiverId,
            senderName: SenderName,
            message: message,
        };

        fetch('Chat/sendMessage', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the server if needed
                console.log('Message sent successfully:', data);
            })
            .catch(error => {
                console.error('Error sending message:', error);
            });
        }
    }
    function receiveMessages(senderId,senderName) {
    console.log("re", senderId);
    console.log("name",senderName);
    // AJAX request to get messages
    $.ajax({
        type: 'POST',
        url: 'Chat/receiveMessages',
        contentType: 'application/json',
        data: JSON.stringify({ 'senderId': senderId }),
        success: function (messages) {
            console.log("Received messages:", messages);
            const chatMessages = $('.chat--items');

            if (messages && Array.isArray(messages)) {
                // Append received messages to the chat area
                // Inside the success callback of receiveMessages
                    messages.forEach(message => {
                        if (message && message.message) {
                            const messageElement = createMessageElement(message, senderName);
                            chatMessages.append(messageElement);
                        }
                    });

            } else {
                console.error('Invalid or empty response from the server.');
            }
             fetchingMessages = false;
        },
        error: function (xhr, status, error) {
            fetchingMessages = false;
        }
    });
}


function createMessageElement(message,senderName) {
    const senderAvatar = $('#sender-avatar').attr('src');
    const currentTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

    const messageElement = $('<div>').addClass('chat--item chat--left');
    messageElement.html(`
        <div class="chat--avatar">
            <img src="${senderAvatar}" alt="" class="rounded-circle">
        </div>
        <div class="chat--content">
            <div class="chat--info">
                <h6 class="chat--user h6">
                    <a href="#">${senderName}</a>
                </h6>
                <span class="chat--time">${currentTime}</span>
            </div>
            <div class="chat--text">
                <p>${message.message}</p>
            </div>
        </div>
    `);

    return messageElement;
}
</script>