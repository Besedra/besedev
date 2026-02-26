document.addEventListener("DOMContentLoaded", function () {
  const chatToggle = document.getElementById("chat-toggle");
  const chatWindow = document.getElementById("chat-window");
  const chatClose = document.getElementById("chat-close");
  const sendBtn = document.getElementById("sendBtn");

  chatToggle.addEventListener("click", () => {
    chatWindow.style.display = chatWindow.style.display === "flex" ? "none" : "flex";
  });

  chatClose.addEventListener("click", () => {
    chatWindow.style.display = "none";
  });

  sendBtn.addEventListener("click", sendMessage);
  document.getElementById("userInput").addEventListener("keypress", function(e) {
    if (e.key === "Enter") sendMessage();
  });

  document.querySelectorAll(".faq-container button").forEach(btn => {
    btn.addEventListener("click", () => sendMessage(btn.dataset.faq));
  });

  async function sendMessage(text) {
    const input = document.getElementById("userInput");
    const message = text || input.value.trim();
    if (!message) return;

    addMessage(message, "user");
    input.value = "";
    showTyping();

    try {
      const response = await fetch("https://n8n-besedev.onrender.com/webhook/chat", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ message})
      });
      const data = await response.json();
      removeTyping();
      addMessage(data.reply || "Désolé, je n'ai pas pu obtenir de réponse 😅", "bot");
    } catch (err) {
      removeTyping();
      addMessage("Erreur serveur, veuillez réessayer plus tard.", "bot");
      console.error(err);
    }
  }

  function addMessage(text, sender) {
    const container = document.getElementById("messages");
    const msg = document.createElement("div");
    msg.className = `message ${sender}`;
    msg.innerHTML = `
      <img src="assets/${sender}.png" class="msg-avatar" alt="${sender}">
      <div class="bubble">${text}</div>
    `;
    container.appendChild(msg);
    container.scrollTop = container.scrollHeight;
  }

  function showTyping() {
    const container = document.getElementById("messages");
    const typing = document.createElement("div");
    typing.className = "message bot";
    typing.id = "typing";
    typing.innerHTML = `
      <img src="assets/bot.png" class="msg-avatar" alt="Bot">
      <div class="bubble">...</div>
    `;
    container.appendChild(typing);
    container.scrollTop = container.scrollHeight;
  }

  function removeTyping() {
    const typing = document.getElementById("typing");
    if (typing) typing.remove();
  }
});
