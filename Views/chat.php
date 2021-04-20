<div class="container">
    <div class="container d-flex justify-content-center">
        <div class="card mt-5" style="min-width: 500px">
            <div class="d-flex flex-row justify-content-between  p-3"> <h4 class="pb-3"><?=$this->toUserInfo['name']?></h4></div>
            <div class="chat-list">
                <?php foreach ($this->chat as $msg) { ?>
                <div class="d-flex flex-row p-3 <?php if($msg['from_id'] === $this->userInfo['id']) echo 'my-msg ' ?>">
                    <div class="avatar overflow-hidden rounded-circle" style="width: 40px;height: 40px;">
                        <?php if($msg['from_id'] === $this->userInfo['id']) { ?>
                            <img src="/Public/Images/<?= $this->userInfo['user_avatar'] ?>" class="img-fluid h-100" style="object-fit: cover;">
                        <?php } else { ?>
                            <img src="/Public/Images/<?= $this->toUserInfo['user_avatar'] ?>" class="img-fluid">
                        <?php } ?>
                    </div>
                    <div class="chat ml-2 flex-grow-1" style="margin-right: 8px;">
                        <p class="mb-0"><?= $msg['body'] ?></p>
                        <p class="date text-secondary mb-0" style="font-size: 12px;"><?= $msg['date'] ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="d-flex flex-row p-3"> <img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">
                <div class="chat  ml-2 p-3"><span class="text-muted dot">. . .</span></div>
            </div>
            <div class="form-group px-3 d-flex">
                <textarea class="form-control" rows="5" placeholder="Type your message"></textarea>
            </div>
        </div>
    </div>
</div>

<style>
    .my-msg {
        flex-direction: row-reverse !important;
    }
    .my-msg .chat {
        text-align: right;

    }
</style>