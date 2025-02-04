<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #chatbot {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 400px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: none;
            z-index: 9999;
            overflow: hidden;
        }

        #chatbox {
            height: 400px;
            overflow-y: auto;
            padding: 15px;
        }

        .chat-message {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .chat-message .message {
            font-size: 14px;
            line-height: 1.5;
            border-radius: 10px;
            padding: 10px;
            max-width: 80%;
            word-wrap: break-word;
        }

        .chat-message.user .message {
            background-color: #e0f7fa;
            /* Màu dành cho người dùng */
            align-self: flex-end;
        }

        .chat-message.model .message {
            background-color: #f1f1f1;
            /* Màu dành cho chatbot */
            align-self: flex-start;
        }

        .chat-message .time {
            font-size: 12px;
            color: #888;
            margin-top: 5px;
            text-align: right;
        }

        .chat-message.model .time {
            text-align: left;
        }

        .chat-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            font-size: 18px;
            border-radius: 10px 10px 0 0;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-header .close-btn {
            font-size: 24px;
            cursor: pointer;
        }

        .chat-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #007bff;
            color: white;
            font-size: 30px;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
            visibility: visible;
            opacity: 1;
            transition: visibility 0s, opacity 0.5s linear;
        }

        .chat-button.hidden {
            visibility: hidden;
            opacity: 0;
        }
    </style>
</head>

<body>
    <div id="chatbot">
        <div class="chat-header">
            <span>Chatbot</span>
            <span class="close-btn fs-3" onclick="toggleChatbot()">×</span>
        </div>
        <div id="chatbox"></div>
        <div class="input-group p-3">
            <input type="text" id="userMessage" class="form-control" placeholder="Nhập tin nhắn..."
                onkeypress="handleKeyPress(event)">
            <button class="btn btn-primary" onclick="sendMessage()">Gửi</button>
        </div>
    </div>

    <div id="chatButton" class="chat-button" onclick="toggleChatbot()">💬</div>
    

    <script>
        var history = [];

        function convertMarkdownToHtml(text) {
            text = text.replace(/\*\*(.*?)\*\*/g, '<br><strong>$1</strong>');
            text = text.replace(/\*/g, '<br>');
            text = text.replace(/\[([^\[]+)\]\((https?:\/\/[^\s]+)\)/g, '<a href="$2" target="_blank">$1</a>');
            return text;
        }

        function appendMessage(role, message) {
            const chatbox = document.getElementById('chatbox');
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('chat-message', role);

            // Tạo phần tin nhắn
            const messageContent = document.createElement('div');
            messageContent.classList.add('message');
            messageContent.innerHTML = `<strong>${role === 'user' ? 'Bạn' : 'Chatbot'}:</strong> ${convertMarkdownToHtml(message)}`;

            // Tạo thời gian
            const time = new Date();
            const timeString = time.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const timeDiv = document.createElement('div');
            timeDiv.classList.add('time');
            timeDiv.innerHTML = timeString;

            // Thêm tin nhắn và thời gian vào messageDiv
            messageDiv.appendChild(messageContent);
            messageDiv.appendChild(timeDiv);

            // Căn chỉnh thời gian cho chatbot
            if (role === 'model') {
                timeDiv.style.textAlign = 'left';  // Căn trái cho chatbot
            } else {
                timeDiv.style.textAlign = 'right';  // Căn phải cho người dùng
            }

            // Thêm messageDiv vào chatbox và cuộn đến cuối
            chatbox.appendChild(messageDiv);
            chatbox.scrollTop = chatbox.scrollHeight;
        }

        function sendMessage() {
            const userMessage = document.getElementById('userMessage').value;
            if (!userMessage.trim()) return;

            appendMessage('user', userMessage);
            document.getElementById('userMessage').value = '';

            $.ajax({
                url: 'http://127.0.0.1:5000/chat',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ message: userMessage }),
                success: function (response) {
                    appendMessage('model', response.response);
                    history = response.history;
                },
                error: function () {
                    alert('Lỗi khi gửi tin nhắn.');
                }
            });
        }

        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        }

        function toggleChatbot() {
            const chatbot = document.getElementById('chatbot');
            const chatButton = document.getElementById('chatButton');

            if (chatbot.style.display === 'none' || chatbot.style.display === '') {
                chatbot.style.display = 'block';
                chatButton.classList.add('hidden');
            } else {
                chatbot.style.display = 'none';
                chatButton.classList.remove('hidden');
            }
        }
    </script>
</body>

</html>