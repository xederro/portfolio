<div class="container-sm">
    <div class="card bg-dark text-light">
        <div class="card-header">
            Chatbox
        </div>
        <div class="card-body" style="height: 40vh; overflow-y: scroll" id="msgBox">

        </div>

        <div class="card-footer">
            <form action="javascript:void(0);">
                <input type="hidden" name="id" value="<?php echo $params['session']['user']['id'] ?? 'noID';?>">
                <div class="mb-3">
                    <label for="nick" class="form-label">Nick:</label>
                    <input type="text" maxlength="50" class="form-control" id="nick" required value="<?php echo $params['session']['user']['name'] ?? '';?>">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message:</label>
                    <textarea class="form-control" id="message" rows="3" maxlength="500" required></textarea>
                </div>
                <button type="button" class="btn btn-primary" onclick="sendMsg()">Send</button>
            </form>
        </div>
    </div>
</div>


<script>
    let idOfUser = <?php echo $params['session']['user']['id'] ?? '""';?>;
</script>
<script src="/config/firestore.js"></script>
<script src="/public/js/firebase-app.js"></script>
<script src="/public/js/firebase-auth.js"></script>
<script src="/public/js/firebase-firestore.js"></script>
<script src="/public/js/chat.min.js"></script>
