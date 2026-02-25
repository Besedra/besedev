document.addEventListener("DOMContentLoaded", function () {

  const sendBtn = document.getElementById("sendBtn");
  sendBtn.addEventListener("click", sendMessage);

  document.querySelectorAll(".faq-container button").forEach(btn => {
    btn.addEventListener("click", () => sendFAQ(btn.dataset.faq));
  });

  async function sendMessage() {
    const input = document.getElementById("userInput");
    const message = input.value.trim();
    if (!message) return;

    addMessage(message, "user");
    input.value = "";
    showTyping();

    await sendToWebhook(message);
  }

  async function sendFAQ(text) {
    addMessage(text, "user");
    showTyping();

    await sendToWebhook(text);
  }

  async function sendToWebhook(message) {
    try {
      const response = await fetch("https://n8n-besedev.onrender.com/webhook/0cd00d20-988c-4dfd-a635-4de078694d46/chat", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ message })
      });

      const data = await response.json();
      removeTyping();
      if (data.reply) {
        addMessage(data.reply, "bot");
      } else {
        addMessage("Désolé, je n'ai pas pu obtenir de réponse. 😅", "bot");
      }
    } catch (error) {
      removeTyping();
      addMessage("Erreur serveur, veuillez réessayer plus tard.", "bot");
      console.error(error);
    }
  }

  function addMessage(text, sender) {
    const msgContainer = document.createElement("div");
    msgContainer.className = "message " + sender;

    const avatar = document.createElement("img");
    avatar.src = sender === "bot" ? "assets/bot.png" : "assets/user.png";
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

});
