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