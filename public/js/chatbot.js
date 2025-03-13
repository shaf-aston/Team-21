document.addEventListener("DOMContentLoaded", function () {
    const chatDisplay = document.getElementById("chat-display");
    const userInput = document.getElementById("user-input");
    const sendButton = document.getElementById("send-button");

    const Responses = {
        hello: "Hi, My name is Coby! I would like to assist you today, What can I do for you?",
        "how are you":
            "I  am only what I am, I have no feelings but a for a bot with no bearing of emotions I am doing great",
        bye: "Goodbye! Have a nice day!",
        "When is new stock arriving":
            "Our Stock is always dynamically changing as we like to keep with the trends, if there is something you want that is currently out of stock, Please send a message to the Stock Management team and they will update it as soon as possible",
        "I am unhappy with your services":
            "Sorry to have disappointed you,I sympathise with your frustration ",
        default:
            "I'm not sure how to respond to that. Can you try asking something else or please send a message on the contact page?",
    };

    function showMessage(message, sender) {
        const theMessage = document.createElement("div");
        theMessage.className = `message ${sender}`;
        theMessage.textContent = message;
        chatDisplay.appendChild(theMessage);
        chatDisplay.scrollTop = chatDisplay.scrollHeight;
    }

    function getResponse(userSays) {
        const lowerCaseMessage = userSays.toLowerCase();
        if (lowerCaseMessage.includes("product")) {
            return "If you are looking for information about a product we sell please refer to the description on the product page, if you still have a furter query please send a message to our admin team";
        } else if (lowerCaseMessage.includes("your name")) {
            return "I’m Coby! Your Gadget Grad Chatbot?";
        } else if (lowerCaseMessage.includes("stock")) {
            return "Thank you for your message. If you have a question about our stock please message our stock management team and they will be able to sort it out for you.";
        }
        return Responses[lowerCaseMessage] || Responses["default"];
    }

    function SendMessage() {
        const userSays = userInput.value.trim();
        if (userSays === "") return;

        showMessage(userSays, "user");

        const typing = document.createElement("div");
        typing.className = "message typing";
        typing.textContent = "Coby is thinking...";
        chatDisplay.appendChild(typing);

        setTimeout(() => {
            typing.remove();

            const theMessage = getResponse(userSays);
            showMessage(theMessage, "Coby");
        }, 1000);

        userInput.value = "";
    }

    sendButton.addEventListener("click", SendMessage);

    userInput.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            SendMessage();
        }
    });
});
