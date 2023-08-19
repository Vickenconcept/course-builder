/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

// window.Echo.private('job-completed')
//     .listen('JobCompleted', (event) => {
//         console.log(event.subtopic, event.detailedExplanation);
//         console.log('Job completed for:', event.subtopic);
//         console.log('Detailed explanation:', event.detailedExplanation);
//         console.log('Success:', event.success);
//         console.log('Error message:', event.errorMessage);
//         console.log('Received event:', event);
//         document.getElementById('content-placeholder').innerText = event.content;
//     });








// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';

// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

// Echo.channel('job-completed')
//     .listen('JobCompleted', (event) => {

//         console.log(e.job-completed);
//     });

// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';

// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

// window.Echo.private('job-completed')
//     .listen('JobCompleted', (event) => {
//         console.log(event.subtopic, event.detailedExplanation);
//         console.log('Job completed for:', event.subtopic);
//         console.log('Detailed explanation:', event.detailedExplanation);
//         console.log('Success:', event.success);
//         console.log('Error message:', event.errorMessage);
//         console.log('Received event:', event);
//     });
