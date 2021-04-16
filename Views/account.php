<div class="container">
    <div class="border rounded mt-5">
        <div class = "d-flex justify-content-start align-items-start">
            <div class="avatar">
                <img src="/public/uploads/<?= $this->user_avatar ?>" alt="avatar" class="img-fluid mt-3 ml-3 mr-3 mb-3" style="width:200px" id="userAvatar">
            </div>
            <h3 class="mt-5 ml-5"><?= $this->name ?> </h3>
        </div>
        <form action="/account/upload_avatar/?user_id=<?= $this->id ?> " method="POST" enctype="multipart/form-data">
            <div class="custom-file w-25">
                <input type="file" name="avatar" class="custom-file-input" id="myAvatar">
                <label class="custom-file-label" for="myAvatar">Choose file</label>
            </div>
        </form
    </div>
</div>
