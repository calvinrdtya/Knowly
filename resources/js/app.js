import { createApp } from 'vue';

const app = createApp({
    data() {
        return {
            messages: [],
            localStream: null,
            peers: {},
        };
    },
    mounted() {
        this.initializePusher();
        this.getUserMedia();
    },
    methods: {
        initializePusher() {
            const pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
                cluster: process.env.MIX_PUSHER_APP_CLUSTER,
                encrypted: true,
            });

            const channel = pusher.subscribe('meeting.' + meetingId);

            channel.bind('UserJoinedMeeting', (data) => {
                this.messages.push(data.message);
                console.log(`${data.user.name} has joined the meeting.`);
            });

            channel.bind('UserLeftMeeting', (data) => {
                this.messages.push(data.message);
                console.log(`${data.user.name} has left the meeting.`);
            });

            channel.bind('MeetingEnded', (data) => {
                alert(data.message);
                window.location.href = '/dashboard';
            });
        },
        getUserMedia() {
            navigator.mediaDevices.getUserMedia({ video: true, audio: true })
                .then((stream) => {
                    this.localStream = stream;
                    const video = document.getElementById('localVideo');
                    video.srcObject = stream;
                });
        },
    },
});

app.mount('#app');
