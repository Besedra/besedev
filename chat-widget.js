import { Chat } from '@n8n/chat';

const chat = new Chat({
  container: document.getElementById('chat-container'),
  apiKey: 'https://n8n-besedev.onrender.com', // ⚠️ pour test seulement. En prod, sécuriser avec un backend.
  title: '💬 Chat avec Besedev',
  placeholder: 'Posez votre question...',
  botName: 'Besedev',
  systemPrompt: `
    Tu es un assistant virtuel du développeur web Besedev.
    Réponds en FR ou EN selon la langue de l'utilisateur.
    Redirige vers WhatsApp ou email si question sur prix ou projet spécifique.
    Toujours rester professionnel et concis.
  `,
});