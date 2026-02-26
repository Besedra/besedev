document.addEventListener("DOMContentLoaded", function () {
  const chatToggle = document.getElementById("chat-toggle");
  const chatWindow = document.getElementById("chat-window");
  const chatClose = document.getElementById("chat-close");
  const sendBtn = document.getElementById("sendBtn");
  const input = document.getElementById("userInput");

  // Ouvrir/fermer le chat
  chatToggle.addEventListener("click", () => {
    chatWindow.style.display = chatWindow.style.display === "flex" ? "none" : "flex";
  });

  chatClose.addEventListener("click", () => {
    chatWindow.style.display = "none";
  });

  // Envoi via bouton
  sendBtn.addEventListener("click", () => sendMessage());

  // Envoi via Enter
  input.addEventListener("keypress", function(e) {
    if (e.key === "Enter") {
      e.preventDefault(); // empêche le comportement par défaut
      sendMessage();
    }
  });

  // Boutons FAQ
  document.querySelectorAll(".faq-container button").forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.preventDefault(); // empêche l'event par défaut
      sendMessage(btn.dataset.faq);
    });
  });

  // Fonction principale d'envoi
  async function sendMessage(text) {
    // Ignore si text est un Event (problème mobile)
    if (text instanceof Event) text = null;

    const message = (text || input.value.trim());
    if (!message) return;

    addMessage(message, "user");
    input.value = "";
    showTyping();

    try {
      const response = await fetch("https://n8n-besedev.onrender.com/webhook/chat", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ message })
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

  // Ajouter un message à l'écran
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

  // Afficher “en train d'écrire...”
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

  // Supprimer le “typing”
  function removeTyping() {
    const typing = document.getElementById("typing");
    if (typing) typing.remove();
  }
});
