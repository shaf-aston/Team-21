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
          let userMessage = userInput.value.trim();
          if (userMessage === '') return;

          // Save original message for display
          const displayMessage = userMessage;

          // Display user message
          addMessage(displayMessage, true);
          userInput.value = '';

          // Show typing indicator
          showTypingIndicator();

          // Get bot response (simulated delay for realistic effect)
          setTimeout(() => {
            hideTypingIndicator();

            // Get response from the enhanced getResponse function
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

        // Fuzzy matching implementation
        function findBestMatch(input, possibleMatches) {
          let bestMatch = {
            target: "",
            rating: 0
          };

          possibleMatches.forEach(possibleMatch => {
            const rating = similarity(input, possibleMatch);
            if (rating > bestMatch.rating) {
              bestMatch = {
                target: possibleMatch,
                rating: rating
              };
            }
          });

          return bestMatch;
        }

        function similarity(s1, s2) {
          // Implementation of string similarity using Dice's coefficient
          if (s1.length < 2 || s2.length < 2) return 0;

          // Get bigrams for each string
          const getBigrams = string => {
            const bigrams = new Set();
            for (let i = 0; i < string.length - 1; i++) {
              bigrams.add(string.substring(i, i + 2));
            }
            return bigrams;
          };

          const bigrams1 = getBigrams(s1);
          const bigrams2 = getBigrams(s2);

          // Count intersections
          let intersection = 0;
          for (const bigram of bigrams1) {
            if (bigrams2.has(bigram)) {
              intersection++;
            }
          }

          // Calculate Dice's coefficient
          return (2.0 * intersection) / (bigrams1.size + bigrams2.size);
        }

        // Enhanced response function
        function getResponse(userSays) {
          // Clean the user input by removing special characters and extra spaces
          const cleanedInput = userSays.toLowerCase().replace(/[^\w\s]/gi, ' ').replace(/\s+/g, ' ').trim();

          // Check for specific keywords first
          if (cleanedInput.includes("product")) {
            return "If you're looking for information about a product we sell, please refer to the description on the product page. If you still have further questions, please send a message to our admin team.";
          } else if (cleanedInput.includes("your name") || cleanedInput.includes("who are you")) {
            return "My name is Coby! I'm here to assist you with any questions you might have about our products or services.";
          }

          const Responses = {
            "hello": "Hi, My name is Coby! I would like to assist you today. What can I do for you?",
            "how are you": "I'm doing great! How can I help you today?",
            "bye": "Goodbye! Have a nice day!",
            "when is new stock arriving": "Our stock is always dynamically changing as we like to keep with the trends. If there's something specific you want that's out of stock, please send a message to the Stock Management team and they'll update it as soon as possible.",
            "i am unhappy with your services": "I'm sorry to hear you're experiencing issues. Please provide specific details about your concern so we can address it properly, or contact our customer service team directly.",
            "what is your return policy": "We have a 30-day return policy. However, there are certain exceptions depending on the product type. You can check the detailed policy under the 'Return Policy' section on our website.",
            "how do i track my order": "You can track your order by logging into your account and visiting the 'Order History' section. Click on the order number and you should see the tracking details.",
            "how can i get discount": "We occasionally offer promotional deals and discounts. To stay updated, make sure to subscribe to our newsletter and follow us on social media.",
            "what are the payment methods": "We accept several payment methods including Visa, Mastercard, PayPal, and American Express. If there are any issues with your payment, please contact our customer service team.",
            "what are the delivery charges": "Delivery charges vary depending on the size, weight, and destination of your package. The delivery charges will be provided at checkout.",
            "is it safe to purchase here": "Absolutely! We take security very seriously. Our site uses end-to-end encryption and all payments are processed through a secure gateway.",
            "do you ship worldwide": "Yes, we do. However, please note that delivery charges and times may vary depending on the destination.",
            "why is my order delayed": "We apologize for the delay! Can you please provide me with your order number so I can check the status for you?",
            "how do i create an account": "To create an account, simply click on the sign-up option in the top right corner of our website and fill out the necessary information. You will receive a confirmation email once your account has been created.",
            "tell me more about your anti-fraud policy": "We have a stringent anti-fraud policy in place to protect our customers. Every transaction is closely monitored to ensure it's legitimate and in case of any suspicious activity, our team takes prompt action.",
            "how can i change my personal info": "You can edit your personal information from your dashboard after logging into your account. If you have any trouble, feel free to contact our help center.",
            "how does the wish list work": "You can add any item you wish to purchase later to your wish list. It's a simple way to keep track of items you like or might want to buy at a later date.",
            "what if i forget my password": "In case you forget your password, click on 'Forgot password' and you'll be prompted to enter your registered email. We'll then send a link to reset your password.",
            "whats the warranty on your products": "Warranty durations vary depending on the product and the manufacturer. You can find the warranty details on every product page under 'warranty and support'.",
            "are all products original": "Yes, we take authenticity very seriously and guarantee that all our products are genuine.",
            "what is your privacy policy": "We respect our customers' privacy and ensure that all personal data is kept confidential. For more detailed information, please check the 'Privacy Policy' section on our website.",
            "can i get a refund": "Yes, if the product falls under our return policy and it's within the return period, you can get a refund. Please check our 'Return Policy' section for more details.",
            "what do i do if my product is defective": "In case you've received a defective product, please initiate a return or contact us within the return period and our team will assist you.",
            "how can i cancel my order": "For order cancellation, go to your order history and click the 'Cancel' button. If the button isn't visible or is disabled, it might mean that the order is being processed or has already been shipped.",
            "what are your hours of operation": "Our online store is open 24/7. If you're asking about customer service, you can reach us Mon-Fri, 9 am - 5 pm, and we'll be happy to assist you.",
            "default": "I'm not sure how to respond to that. Can you try asking something else or please send a message on the contact page?"
          };

          const bestMatch = findBestMatch(cleanedInput, Object.keys(Responses));

          // If similarity is above threshold, return that response
          if (bestMatch.rating > 0.6) {
            return Responses[bestMatch.target];
          }

          // Additional keyword-based matching for common topics
          if (cleanedInput.includes("refund") || cleanedInput.includes("money back")) {
            return Responses["can i get a refund"];
          } else if (cleanedInput.includes("track") || cleanedInput.includes("where is my order")) {
            return Responses["how do i track my order"];
          } else if (cleanedInput.includes("delivery") || cleanedInput.includes("shipping")) {
            return Responses["what are the delivery charges"];
          } else if (cleanedInput.includes("warranty")) {
            return Responses["whats the warranty on your products"];
          } else if (cleanedInput.includes("account") || cleanedInput.includes("sign up")) {
            return Responses["how do i create an account"];
          } else if (cleanedInput.includes("password")) {
            return Responses["what if i forget my password"];
          } else if (cleanedInput.includes("cancel")) {
            return Responses["how can i cancel my order"];
          } else if (cleanedInput.includes("payment") || cleanedInput.includes("pay")) {
            return Responses["what are the payment methods"];
          } else if (cleanedInput.includes("hi") || cleanedInput.includes("hey") || cleanedInput.includes("hello")) {
            return Responses["hello"];
          }

          return Responses["default"];
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