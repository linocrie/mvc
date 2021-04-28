<div class="container">
    <div class="container d-flex justify-content-center">
        <div class="card chat-card" style="min-width: 350px; background-color: black">
            <div class="d-flex bg-dark text-light flex-row justify-content-between  p-3"> <h4 class="pb-3"><?=$this->toUserInfo['name']?></h4><span>Active now</span></div>
            <div id="chatList" class="chat-list d-flex flex-column">
                <?php $last_id = 0;?>
                <?php  foreach ($this->chat as $msg) { ?>
                    <?php if ($msg['from_id'] === $_SESSION['user_id']) { ?>
                        <div class="mr-3">
                            <span class="text-secondary float-right " style="font-size: 15px"><?= $this->userInfo['name'] ?></span>
                        </div>
                        <div class="msg-part mr-3">
                            <p class="mb-0 float-right bg-light" style="font-size: 20px; padding: 0 15px 5px 15px;border-radius: 25px;"><?= $msg['body'] ?></p>
                        </div>
                        <div class="mr-3">
                            <span class="mb-1 text-secondary float-right" style="font-size: 10px"><?= substr($msg["date"], 11, -3) ?></span>
                        </div>
                    <?php } else { ?>
                        <span class="text-secondary text ml-3 mt-3 "
                              style="font-size: 15px"><?= $this->toUserInfo['name'] ?></span>
                        <div class="msg-part ml-3">
                            <p class="mb-0 float-left bg-light" style="font-size: 20px; padding: 0 15px 5px 15px;border-radius: 25px;"><?= $msg['body'] ?></p>
                        </div>
                        <span class=" ml-3 mb-1 text-secondary" style="font-size: 10px"><?= substr($msg["date"], 11, -3) ?></span>
                    <?php } ?>
                    <?php  $last_id = $msg['id'] ?>
                <?php } ?>
            </div>
            <form id="chatForm" method="POST" class="form-group chat-form align-items-center pt-3 px-3 d-flex">
                <textarea class="form-control " name="chat" id="text" placeholder="Type your message"></textarea>
                <button type="submit" id="send" class="ml-2 btn-dark" style="width: 60px; height: 30px">Send</button>
            </form>

        </div>
    </div>
</div>
<script>
    let userId = <?=$this->userInfo['id']?>;
    let userName = '<?=$this->userInfo['name']?>';
    let toUserId = <?=$this->toUserInfo['id']?>;
    let toUserName = '<?=$this->toUserInfo['name']?>';
    let lastId = <?=$last_id?>;
</script>

<style>
    .chat-card {
        height: 80vh;
    }
    .chat-list {
        height: calc(100vh - 118px);
        overflow-y: auto;
    }
    .my-msg {
        flex-direction: row-reverse !important;
    }
</style>