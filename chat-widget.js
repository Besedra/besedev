document.addEventListener("DOMContentLoaded", function () {
  async function sendMessage() {
  const input = document.getElementById("userInput");
  const message = input.value.trim();
  if (!message) return;

  addMessage(message, "user");
  input.value = "";

  showTyping();

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
}
