document.addEventListener('DOMContentLoaded', function() {
    const chatWidget = document.getElementById('jb-chat-widget');
    const toggleBtn = document.getElementById('jb-chat-toggle');
    const closeBtn = document.getElementById('jb-chat-close');
    const messagesArea = document.getElementById('jb-chat-messages');
    let isChatInit = false;

    // Abrir / Cerrar Chat
    toggleBtn.addEventListener('click', toggleChat);
    closeBtn.addEventListener('click', toggleChat);

    function toggleChat() {
        chatWidget.classList.toggle('jb-chat-collapsed');
        if (!chatWidget.classList.contains('jb-chat-collapsed') && !isChatInit) {
            initBotConversation();
        }
    }

    // Iniciar conversación con retardo
    function initBotConversation() {
        isChatInit = true;
        appendMessage('bot', '...', true); // Indicador de tipeo

        setTimeout(() => {
            document.querySelector('.jb-typing').remove();
            appendMessage('bot', '¡Hola! Bienvenido a Soporte JB Tech. ¿En qué puedo ayudarte hoy?');
            showOptions([
                { text: 'Estado de mi pedido', id: 'opt_pedido' },
                { text: 'Garantías', id: 'opt_garantia' },
                { text: 'Hablar con un asesor humano', id: 'opt_humano' }
            ]);
        }, 1200);
    }

    function appendMessage(sender, text, isTyping = false) {
        const msgDiv = document.createElement('div');
        msgDiv.className = sender === 'bot' ? 'jb-msg-bot' : 'jb-msg-user';
        if (isTyping) msgDiv.classList.add('jb-typing');
        msgDiv.innerHTML = text;
        messagesArea.appendChild(msgDiv);
        messagesArea.scrollTop = messagesArea.scrollHeight;
    }

    function showOptions(options) {
        options.forEach(opt => {
            const btn = document.createElement('button');
            btn.className = 'jb-chat-option';
            btn.innerText = opt.text;
            btn.onclick = () => handleOptionClick(opt.text, opt.id, btn);
            messagesArea.appendChild(btn);
        });
        messagesArea.scrollTop = messagesArea.scrollHeight;
    }

    function handleOptionClick(userText, actionId, clickedBtn) {
        // Remover los botones de opciones para limpiar la UI
        document.querySelectorAll('.jb-chat-option').forEach(b => b.remove());
        
        // Imprimir lo que el usuario seleccionó
        appendMessage('user', userText);

        // Lógica de respuesta del bot
        appendMessage('bot', '...', true);
        setTimeout(() => {
            document.querySelector('.jb-typing').remove();
            
            if (actionId === 'opt_pedido') {
                appendMessage('bot', 'Puedes ver el estado de tus compras en la sección "Mis Pedidos" de tu perfil.');
            } else if (actionId === 'opt_garantia') {
                appendMessage('bot', 'Nuestros productos tienen 1 año de garantía oficial de la marca.');
            } else if (actionId === 'opt_humano') {
                appendMessage('bot', 'Conectando con un especialista... Por favor espera un momento.');
                // AQUÍ SE CONECTARÁ EL WEBSOCKET
                document.getElementById('jb-chat-input').disabled = false;
                document.getElementById('jb-chat-send').disabled = false;
            }
        }, 1000);
    }
});