<div class="container-sm">
    <div class="card">
        <div class="card-header">
            Chatbox
        </div>
        <div class="card-body" style="height: 40vh; overflow-y: scroll" id="msgBox">

        </div>

        <div class="card-footer">
            <form action="javascript:sendMsg();">
                <div class="mb-3">
                    <label for="nick" class="form-label">Nick:</label>
                    <input type="text" class="form-control" id="nick" required value="<?php echo $params['session']['user']['name'] ?? '';?>">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message:</label>
                    <textarea class="form-control" id="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>

<script src="/config/firestore.js"></script>
<script src="/public/js/firebase-app.js"></script>
<script src="/public/js/firebase-analytics.js"></script>
<script src="/public/js/firebase-auth.js"></script>
<script src="/public/js/firebase-firestore.js"></script>
<script src="/public/js/chat.min.js"></script>
