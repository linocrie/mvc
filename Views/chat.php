<div class="container">
    <div class="container d-flex justify-content-center">
        <div class="card mt-5 chat-card" style="min-width: 500px; background-color: black">
            <div class="d-flex bg-dark text-light flex-row justify-content-between  p-3"> <h4 class="pb-3"><?=$this->toUserInfo['name']?></h4><span>Active now</span></div>
            <div id="chatList" class="chat-list">
                <?php foreach ($this->chat as $msg) { ?>
                    <div class="d-flex m-3 bg-dark text-light flex-row p-2 <?php if($msg['from_id'] === $this->userInfo['id']) echo 'my-msg ' ?>">
                        <div class="avatar overflow-hidden rounded-circle" style="width: 40px;height: 40px;">
                            <?php if($msg['from_id'] === $this->userInfo['id']) { ?>
                                <img src="/Public/Images/<?= $this->userInfo['user_avatar'] ?>" class="img-fluid h-100" style="object-fit: cover;">
                            <?php } else { ?>
                                <img src="/Public/Images/<?= $this->toUserInfo['user_avatar'] ?>" class="img-fluid">
                            <?php } ?>
                        </div>
                        <div class="chat ml-2 flex-grow-1" style="margin-right: 8px;">
                            <p class="mb-0">
                                <?php if($msg['from_id'] === $this->userInfo['id']) { ?>
                                    <span class="text-secondary" style="font-size: 15px"><?= $this->userInfo['name'] ?></span>

                                <?php } else { ?>
                                    <span class="text-secondary" style="font-size: 15px"><?= $this->toUserInfo['name'] ?></span>
                                <?php } ?>
                            </p>
                            <p class="mb-0" style="font-size: 20px"><?= $msg['body'] ?></p>
                            <p class="date text-secondary mb-0" style="font-size: 12px;"><?= $msg['date'] ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="d-flex flex-row p-2"> <img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">
                <div class="chat p-2 bg-dark"><span class="text-muted dot">. . .</span></div>
            </div>
            <form action="/account/get_msg/?id=<?=$this->toUserInfo['id']?>" method="POST" class="form-group chat-form align-items-center px-3 d-flex">
                <textarea class="form-control" name="chat" id="text" placeholder="Type your message"></textarea>
                <input type="submit" id="send" value="Send" class="ml-2 btn-dark"  style="width: 50px; height: 30px">
            </form>
        </div>
    </div>
</div>

<style>
    .chat-card {
        height: 100vh;
    }
    .chat-list {
        height: calc(100vh - 118px);
        overflow-y: auto;
    }
    .my-msg {
        flex-direction: row-reverse !important;
    }
    .my-msg .chat {
        text-align: right;
    }
</style>