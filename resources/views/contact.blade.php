<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/contact_page.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dark-mode-styles/contact-dark-mode.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <title>Contact Page</title>
</head>

<body>
  @include('components.navbar')

  <div class="contact-page">
    <div class="container">
      <div class="mail-icon-container">
        <img src="{{asset('images/mail.gif')}}" alt="email icon">
      </div>

      <div class="container-text">
        @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST">
          @csrf
          <h2>Contact Form:</h2>

          <label for="name">Your Name:</label><br>
          <input type="text" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}"><br>
          @error('name')<span class="error">{{ $message }}</span><br>@enderror

          <label for="email">Your Email Address:</label><br>
          <input type="email" id="email" name="email" placeholder="Enter your email address" value="{{ old('email') }}"><br>
          @error('email')<span class="error">{{ $message }}</span><br>@enderror

          <label for="subject">Subject:</label><br>
          <input type="text" id="subject" name="subject" placeholder="Enter subject" value="{{ old('subject') }}"><br>
          @error('subject')<span class="error">{{ $message }}</span><br>@enderror

          <label for="pwho">Who should receive your message?</label><br>
          <select id="pwho" name="pwho" title="Select the department or person you want to contact">
            <option value="" disabled selected>-- Select a Department --</option>
            <option value="hr" {{ old('pwho') == 'hr' ? 'selected' : '' }}>HR</option>
            <option value="admin" {{ old('pwho') == 'admin' ? 'selected' : '' }}>Admin Team</option>
            <option value="services" {{ old('pwho') == 'services' ? 'selected' : '' }}>Customer Services</option>
            <option value="management" {{ old('pwho') == 'management' ? 'selected' : '' }}>Stock Management</option>
            <option value="ceo" {{ old('pwho') == 'ceo' ? 'selected' : '' }}>CEO</option>
            <option value="nsure" {{ old('pwho') == 'nsure' ? 'selected' : '' }}>Not Sure</option>
          </select><br>
          @error('pwho')<span class="error">{{ $message }}</span><br>@enderror

          <label for="ymessage">Type Your Message:</label><br>
          <textarea id="ymessage" name="message" placeholder="Write your message here...">{{ old('message') }}</textarea><br>
          @error('message')<span class="error">{{ $message }}</span><br>@enderror

          <input type="submit" value="Submit">
        </form>
      </div>
    </div>

    <div class="chat-container" id="chat-container">
      <div class="chat-header">
        <span class="chat-title">Chat Support</span>
        <div class="chat-controls">
          <button id="minimize-chat" title="Minimize"><i class="fas fa-minus"></i></button>
          <button id="close-chat" title="Close"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="chat-content">
        <div class="chat-display" id="chat-display"></div>
        <div class="chat-input">
          <input type="text" id="user-input" placeholder="Say hello...">
          <button id="send-button">Send</button>
        </div>
      </div>
    </div>
    <button id="toggle-chat" class="chat-toggle hidden">Chat Support</button>
  </div>

  <script src="{{ asset('js/chatbot.js') }}"></script>
</body>
<foot>
  <script src="{{ asset('js/chatbot.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const chatContainer = document.getElementById('chat-container');
      const minimizeBtn = document.getElementById('minimize-chat');
      const closeBtn = document.getElementById('close-chat');
      const toggleBtn = document.getElementById('toggle-chat');
      const chatHeader = document.querySelector('.chat-header');

      // Minimize functionality
      minimizeBtn.addEventListener('click', () => {
        chatContainer.classList.toggle('minimized');
      });

      // Close/Open functionality
      closeBtn.addEventListener('click', () => {
        chatContainer.classList.add('hidden');
        toggleBtn.classList.add('visible');
      });

      toggleBtn.addEventListener('click', () => {
        chatContainer.classList.remove('hidden');
        toggleBtn.classList.remove('visible');
      });

      // Drag functionality
      let isDragging = false;
      let currentX;
      let currentY;
      let initialX;
      let initialY;
      let xOffset = 0;
      let yOffset = 0;

      chatHeader.addEventListener('mousedown', dragStart);
      document.addEventListener('mousemove', drag);
      document.addEventListener('mouseup', dragEnd);

      function dragStart(e) {
        initialX = e.clientX - xOffset;
        initialY = e.clientY - yOffset;

        if (e.target === chatHeader) {
          isDragging = true;
        }
      }

      function drag(e) {
        if (isDragging) {
          e.preventDefault();
          currentX = e.clientX - initialX;
          currentY = e.clientY - initialY;
          xOffset = currentX;
          yOffset = currentY;

          setTranslate(currentX, currentY, chatContainer);
        }
      }

      function dragEnd() {
        isDragging = false;
      }

      function setTranslate(xPos, yPos, el) {
        el.style.transform = `translate3d(${xPos}px, ${yPos}px, 0)`;
      }
    });

    const chatDisplay = document.getElementById('chat-display');

    function adjustChatHeight() {
      const currentHeight = chatDisplay.scrollHeight;
      if (currentHeight <= 300) {
        chatDisplay.style.height = `${currentHeight}px`;
      } else {
        chatDisplay.style.height = '300px';
      }
    }

    // Call this function whenever a new message is added
    function addMessage(message, isUser = false) {
      const messageDiv = document.createElement('div');
      messageDiv.className = `chat-message ${isUser ? 'user-message' : 'bot-message'}`;
      messageDiv.textContent = message;
      chatDisplay.appendChild(messageDiv);
      adjustChatHeight();
      chatDisplay.scrollTop = chatDisplay.scrollHeight;
    }
  </script>
</foot>

</html>