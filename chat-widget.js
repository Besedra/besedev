async function sendMessage() {
  const input = document.getElementById("userInput");
  const message = input.value.trim();
  if (!message) return;

  addMessage(message, "user");
  input.value = "";

  showTyping();

  const response = await fetch("https://n8n-besedev.onrender.com/webhook/0cd00d20-988c-4dfd-a635-4de078694d46/chat", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ message })
  });

  const data = await response.json();
  removeTyping();
  addMessage(data.reply, "bot");
}

function sendFAQ(button) {
  const text = button.innerText;
  sendMessageFromText(text);
}

function sendMessageFromText(text) {
  addMessage(text, "user");
  showTyping();

  fetch("TON_WEBHOOK_URL", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ message: text })
  })
  .then(res => res.json())
  .then(data => {
    removeTyping();
    addMessage(data.reply, "bot");
  });
}

function addMessage(text, sender) {
  const msgContainer = document.createElement("div");
  msgContainer.className = "message " + sender;

  const avatar = document.createElement("img");
  avatar.src = sender === "bot"
    ? "assets/bot.png"
    : "assets/user.png";
  avatar.className = "msg-avatar";

  const bubble = document.createElement("div");
  bubble.className = "bubble";
  bubble.innerText = text;

  msgContainer.appendChild(avatar);
  msgContainer.appendChild(bubble);

  document.getElementById("messages").appendChild(msgContainer);
  scrollToBottom();
}

function showTyping() {
  const typing = document.createElement("div");
  typing.className = "message bot";
  typing.id = "typing";
  typing.innerHTML = `
    <img src="assets/bot.png" class="msg-avatar">
    <div class="bubble">...</div>
  `;
  document.getElementById("messages").appendChild(typing);
  scrollToBottom();
}

function removeTyping() {
  const typing = document.getElementById("typing");
  if (typing) typing.remove();
}

function scrollToBottom() {
  const container = document.getElementById("messages");
  container.scrollTop = container.scrollHeight;
}
