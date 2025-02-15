<link href="https://cdn.jsdelivr.net/npm/@n8n/chat/dist/style.css" rel="stylesheet" />
<script type="module">
    import {
        createChat
    } from 'https://cdn.jsdelivr.net/npm/@n8n/chat/dist/chat.bundle.es.js';

    createChat({
        webhookUrl: 'https://server1.nodev.web.id/webhook/f406671e-c954-4691-b39a-66c90aa2f103/chat',
        defaultLanguage: 'id',
        initialMessages: [
            'Halooo! 👋',
            'Saya Sakamoto, ada yang bisa saya bantu😊?'
        ],
        i18n: {
            id: {
                title: 'Halooo! 👋',
                subtitle: "Mulailah percakapan dengan saya, saya akan membantu Anda sebaik mungkin 😊",
                footer: '',
                getStarted: 'New Conversation',
                inputPlaceholder: 'Ketik pesan anda',
            },
        },
    });
</script>
