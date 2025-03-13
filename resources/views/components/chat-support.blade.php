  <link rel="stylesheet" href="{{ asset('css/chat-support.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dark-mode-styles/chat-support-dark-mode.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

  <foot>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const chatContainer = document.getElementById('chat-container');
        const chatDisplay = document.getElementById('chat-display');
        const userInput = document.getElementById('user-input');
        const sendButton = document.getElementById('send-button');
        const minimizeBtn = document.getElementById('minimize-chat');
        const closeBtn = document.getElementById('close-chat');
        const toggleBtn = document.getElementById('toggle-chat');
        const chatContent = document.querySelector('.chat-content');
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
          // Ensure chat isn't minimized when reopened
          chatContainer.classList.remove('minimized');
        });

        // User input handling
        sendButton.addEventListener('click', handleUserInput);
        userInput.addEventListener('keypress', function(e) {
          if (e.key === 'Enter') {
            handleUserInput();
          }
        });

        function handleUserInput() {
          const userMessage = userInput.value.trim();
          if (userMessage === '') return;

          // Display user message
          addMessage(userMessage, true);
          userInput.value = '';

          // Show typing indicator
          showTypingIndicator();

          // Get bot response (simulated delay for realistic effect)
          setTimeout(() => {
            hideTypingIndicator();

            // Get response from chatbot.js
            const botResponse = getResponse(userMessage);
            addMessage(botResponse, false);
          }, 1500);
        }

        function showTypingIndicator() {
          const typingDiv = document.createElement('div');
          typingDiv.className = 'typing-indicator';
          typingDiv.id = 'typing-indicator';
          typingDiv.innerHTML = '<span></span><span></span><span></span>';
          chatDisplay.appendChild(typingDiv);
          chatDisplay.scrollTop = chatDisplay.scrollHeight;
        }

        function hideTypingIndicator() {
          const typingDiv = document.getElementById('typing-indicator');
          if (typingDiv) {
            typingDiv.remove();
          }
        }

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

          if (e.target === chatHeader || e.target.parentElement === chatHeader) {
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

        // Initialize with a welcome message
        setTimeout(function() {
          addMessage("Hello! How can I help you today?", false);
        }, 500);

        // Import responses from chatbot.js
        function getResponse(userSays) {
          const lowerCaseMessage = userSays.toLowerCase();

          const Responses = {
            "hello": "Hi, My name is Coby! I would like to assist you today. What can I do for you?",
            "how are you": "I'm doing great! How can I help you today?",
            "bye": "Goodbye! Have a nice day!",
            "when is new stock arriving": "Our stock is always dynamically changing as we like to keep with the trends. If there's something specific you want that's out of stock, please send a message to the Stock Management team and they'll update it as soon as possible.",
            "i am unhappy with your services": "I'm sorry to hear you're experiencing issues. Please provide specific details about your concern so we can address it properly, or contact our customer service team directly.",
            "default": "I'm not sure how to respond to that. Can you try asking something else or please send a message on the contact page?"
          };

          if (lowerCaseMessage.includes("product")) {
            return "If you're looking for information about a product we sell, please refer to the description on the product page. If you still have further questions, please send a message to our admin team.";
          } else if (lowerCaseMessage.includes("your name")) {
            return "My name is Coby! I'm here to assist you with any questions you might have about our products or services.";
          }

          return Responses[lowerCaseMessage] || Responses["default"];
        }
      });

      function adjustChatHeight() {
        const chatDisplay = document.getElementById('chat-display');
        if (!chatDisplay) return;

        const maxHeight = 300;
        const minHeight = 100;
        const naturalHeight = chatDisplay.scrollHeight;

        let newHeight = Math.max(minHeight, naturalHeight);
        newHeight = Math.min(newHeight, maxHeight);

        chatDisplay.style.height = newHeight + 'px';
        chatDisplay.style.overflowY = naturalHeight > maxHeight ? 'auto' : 'hidden';
        chatDisplay.scrollTop = chatDisplay.scrollHeight;
      }

      function addMessage(message, isUser = false) {
        const chatDisplay = document.getElementById('chat-display');
        const messageDiv = document.createElement('div');
        messageDiv.className = `chat-message ${isUser ? 'user-message' : 'bot-message'}`;
        messageDiv.textContent = message;
        chatDisplay.appendChild(messageDiv);
        adjustChatHeight();
        chatDisplay.scrollTop = chatDisplay.scrollHeight;
      }
    </script>
  </foot>