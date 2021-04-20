<div class="container-fluid">
    <div class="row mt-2">
        <?php
        foreach ($this->friends as $friend): ?>

            <div class="comment card ml-2 mr-2 mb-4">
                <a class='col-sm-4 mb-3' style='text-decoration: none;' href='/account/user/<?= $friend['id'] ?>'>
                    <blockquote class="blockquote mb-0 card-body">
                        <p class="mb-0"><?= $friend['name'] ?></p>
                        <footer>
                            <?php if ($friend['user_avatar']) { ?>
                                <img src="/public/images/<?= $friend['user_avatar'] ?>" style="width: 160px"
                                     alt="avatar" class="img-fluid mt-3 ml-3 mr-3 mb-3" id="userAvatar">
                            <?php } else { ?>
                                <h3 class="text-white display-1 font-weight-bold"> <?= $friend['name'] ?> </h3>
                            <?php } ?>
                        </footer>
                        <a href="/account/chat/?user_id=<?= $friend['id'] ?>" class="btn btn-dark">Chat</a>
                    </blockquote>
                </a>
            </div>

        <?php endforeach; ?>

    </div>
</div>