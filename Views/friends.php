<div class = "container-fluid">
    <div class="row mt-2">
        <?php
        foreach ($this->friends as $friend): ?>
            <?php if($friend['user_avatar'] == NULL): ?>
                <?php $friend['user_avatar'] = "avatar.png"; ?>
            <?php endif; ?>
            <a class='col-sm-4 mb-3' style = 'text-decoration: none;' href = '/account/user/<?=$friend['id']?>'>
                <div class="comment card ml-2 mr-2 mb-4">
                    <blockquote class="blockquote mb-0 card-body">
                        <p class="mb-0"><?= $friend['name'] ?></p>
                        <footer class="blockquote-footer">
                            <?php if ($friend['user_avatar']) { ?>
                                <img src="/public/images/<?= $friend['user_avatar'] ?>" alt="avatar" class="img-fluid mt-3 ml-3 mr-3 mb-3" id="userAvatar">
                            <?php } else { ?>
                                <h3 class="text-white display-1 font-weight-bold"> <?= $friend['name'][0] ?> </h3>
                            <?php } ?>
                        </footer>
                    </blockquote>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>