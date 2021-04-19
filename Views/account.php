<div class="container">
    <div class="border rounded mt-5">
        <div class = "d-flex justify-content-start align-items-start">
            <div class="avatar d-flex justify-content-center align-items-center overflow-hidden rounded-circle mb-3" style="width: 200px;height: 200px;background-color: rgba(0, 0, 0, 0.8);">
                <?php if ($this->userInfo['user_avatar']) { ?>
                    <img src="/public/images/<?= $this->userInfo['user_avatar'] ?>" alt="avatar" class="img-fluid h-100 mt-3 ml-3 mr-3 mb-3" id="userAvatar" style="object-fit: cover;">
                <?php } else { ?>
                    <h3 class="text-white display-1 font-weight-bold"> <?= $this->userInfo['name'][0] ?> </h3>
                <?php } ?>
            </div>
            <h3 class="mt-5 ml-5"><?= $this->userInfo['name']?> </h3>
        </div>
        <?php
        if(!$this->friends_account): ?>
            <form action="/account/upload_avatar/?user_id=<?= $this->id ?> " method="POST" enctype="multipart/form-data">
                <div class="custom-file w-25">
                    <input type="file" name="avatar" class="custom-file-input" id="myAvatar">
                    <label class="custom-file-label" for="myAvatar">Choose file</label>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>