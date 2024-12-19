<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoom-like Meeting</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js"></script>
</head>
<body>
    <div id="app" class="container-fluid p-3">
        <div class="row">
            <!-- Main Video Section -->
            <div class="col-lg-9 mb-3">
                <div class="d-flex flex-wrap justify-content-center gap-3" id="video-grid">
                    <!-- Local Video -->
                    <div class="video-container border rounded">
                        <video id="localVideo" autoplay muted></video>
                        <p class="video-label">You</p>
                    </div>
                    <!-- Remote Videos -->
                    <div v-for="participant in participants" :key="participant.id" class="video-container border rounded">
                        <video :id="'remoteVideo-' + participant.id" autoplay></video>
                        <p class="video-label">@{{ participant.name }}</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar for Controls and Chat -->
            <div class="col-lg-3">
                <!-- Controls -->
                <div class="mb-3 text-center">
                    <button v-if="!meetingStarted" @click="startMeeting" class="btn btn-success mb-2">Start Meeting</button>
                    <button v-if="meetingStarted" @click="stopMeeting" class="btn btn-danger mb-2">Stop Meeting</button>
                    <div>
                        <button @click="toggleMute" class="btn btn-secondary me-2">@{{ isMuted ? 'Unmute' : 'Mute' }}</button>
                        <button @click="toggleVideo" class="btn btn-secondary">@{{ isVideoOff ? 'Start Video' : 'Stop Video' }}</button>
                    </div>
                </div>

                <!-- Chat Section -->
                <div class="chat-section border rounded p-2">
                    <h5 class="text-center">Chat</h5>
                    <div class="chat-messages" v-for="msg in messages" :key="msg.id">
                        <strong>@{{ msg.user }}:</strong> @{{ msg.text }}
                    </div>
                    <div class="input-group mt-2">
                        <input type="text" v-model="chatMessage" class="form-control" placeholder="Type a message...">
                        <button @click="sendMessage" class="btn btn-primary">Send</button>
                    </div>
                </div>

                <!-- Participants -->
                <div class="participants-section border rounded p-2 mt-3">
                    <h5 class="text-center">Participants</h5>
                    <ul class="list-group">
                        <li v-for="participant in participants" :key="participant.id" class="list-group-item">
                            @{{ participant.name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="summary-section border rounded p-2 mt-3">
        <h5 class="text-center">Meeting Summary</h5>
        <textarea 
            v-model="summaryNotes" 
            class="form-control mb-2" 
            placeholder="Enter meeting notes..."
            rows="4"
        ></textarea>
        <button 
            @click="generateSummary" 
            class="btn btn-primary w-100"
        >
            Generate Summary
        </button>
        
        <div v-if="generatedSummary" class="mt-2">
            <strong>Generated Summary:</strong>
            <p>@{{ generatedSummary }}</p>
        </div>
    </div>
    <script>
        const app = Vue.createApp({
            data() {
                return {
                    host: "{{ $host }}",
                    meetingId: null,
                    meetingStarted: false,
                    isMuted: false,
                    isVideoOff: false,
                    participants: [],
                    messages: [],
                    chatMessage: '',
                    localStream: null,
                    peerConnections: {},
                    summaryNotes: '',
                    generatedSummary: '',
                };
            },
            created() {
                this.setupPusher();
            },
            methods: {
                setupPusher() {
                    // WebRTC Signaling via Pusher
                    const pusher = new Pusher('7772a4eda5202353109d', {
                        cluster: 'ap1',
                    });
        
                    const channel = pusher.subscribe('meeting.' + this.meetingId);
                    channel.bind('WebRTCSignaling', this.handleSignal);
                },
                async startMeeting() {
                    try {
                        const response = await axios.post('/meeting/start/{{ $code }}', {
                            host: this.host,
                            subject: 'Video Conference'
                        });
        
                        this.meetingId = response.data.meeting_id;
                        this.meetingStarted = true;
        
                        // Access local media
                        this.localStream = await navigator.mediaDevices.getUserMedia({
                            video: true,
                            audio: true
                        });
                        document.getElementById('localVideo').srcObject = this.localStream;
        
                        this.setupWebRTC();
                    } catch (error) {
                        console.error('Meeting start error:', error);
                    }
                },
                setupWebRTC() {
                    // Implement WebRTC peer connection logic
                    // This would involve creating peer connections, 
                    // handling ICE candidates, and streaming
                },
                handleSignal(data) {
                    // Handle WebRTC signaling messages
                    switch(data.type) {
                        case 'offer':
                            // Handle offer from another peer
                            break;
                        case 'answer':
                            // Handle answer from another peer
                            break;
                        case 'ice-candidate':
                            // Handle ICE candidates
                            break;
                    }
                },
                generateSummary() {
                    if (!this.summaryNotes.trim()) {
                        alert('Please enter meeting notes');
                        return;
                    }
        
                    axios.post('/meeting/generate-summary', {
                        meeting_id: this.meetingId,
                        notes: this.summaryNotes
                    }).then(response => {
                        this.generatedSummary = response.data.summary;
                    }).catch(error => {
                        console.error('Summary generation error:', error);
                    });
                },
                endMeeting() {
                    axios.post(`/meeting/end/${this.meetingId}`).then(() => {
                        this.meetingStarted = false;
                        if (this.localStream) {
                            this.localStream.getTracks().forEach(track => track.stop());
                        }
                        this.participants = [];
                    });
                }
            }
        });
        
        app.mount('#app');
        </script>
        

    <style>
        .video-container {
            position: relative;
            width: 300px;
            height: 200px;
        }
        video {
            width: 100%;
            height: 100%;
            background: #000;
        }
        .video-label {
            position: absolute;
            bottom: 5px;
            left: 5px;
            color: white;
            background: rgba(0, 0, 0, 0.5);
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 12px;
        }
        .chat-section, .participants-section {
            height: 250px;
            overflow-y: auto;
        }
        .chat-messages {
            margin-bottom: 5px;
        }
    </style>
</body>
</html>
