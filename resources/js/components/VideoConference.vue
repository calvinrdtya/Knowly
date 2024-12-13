<template>
    <div>
        <h1>WebRTC Video Conference</h1>
        <video id="localVideo" autoplay muted playsinline></video>
        <video id="remoteVideo" autoplay playsinline></video>
    </div>
</template>

<script>
import Echo from "laravel-echo";
import Pusher from "pusher-js";

export default {
    data() {
        return {
            localStream: null,
            peerConnection: null,
            signalingChannel: null,
        };
    },
    methods: {
        async startCall() {
            // Mendapatkan stream video/audio lokal
            this.localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
            const localVideo = document.getElementById("localVideo");
            localVideo.srcObject = this.localStream;

            // Konfigurasi PeerConnection
            this.peerConnection = new RTCPeerConnection({
                iceServers: [{ urls: "stun:stun.l.google.com:19302" }],
            });

            // Menambahkan track lokal ke PeerConnection
            this.localStream.getTracks().forEach((track) => {
                this.peerConnection.addTrack(track, this.localStream);
            });

            // Handling ICE Candidate
            this.peerConnection.onicecandidate = (event) => {
                if (event.candidate) {
                    this.signal("candidate", event.candidate);
                }
            };

            // Handling remote stream
            this.peerConnection.ontrack = (event) => {
                const remoteVideo = document.getElementById("remoteVideo");
                remoteVideo.srcObject = event.streams[0];
            };

            // Membuat offer
            const offer = await this.peerConnection.createOffer();
            await this.peerConnection.setLocalDescription(offer);
            this.signal("offer", offer);
        },
        async signal(type, data) {
            await fetch("/api/signal", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ type, data }),
            });
        },
    },
    mounted() {
        // Setup Laravel Echo
        window.Pusher = Pusher;
        this.signalingChannel = new Echo({
            broadcaster: "pusher",
            key: "your_pusher_key",
            cluster: "your_pusher_cluster",
            forceTLS: true,
        });

        // Listen to signaling events
        this.signalingChannel.channel("webrtc-signaling").listen(".WebRTCSignaling", async (event) => {
            const { type, data } = event;
            if (type === "offer") {
                await this.peerConnection.setRemoteDescription(new RTCSessionDescription(data));
                const answer = await this.peerConnection.createAnswer();
                await this.peerConnection.setLocalDescription(answer);
                this.signal("answer", answer);
            } else if (type === "answer") {
                await this.peerConnection.setRemoteDescription(new RTCSessionDescription(data));
            } else if (type === "candidate") {
                await this.peerConnection.addIceCandidate(new RTCIceCandidate(data));
            }
        });
    },
};
</script>