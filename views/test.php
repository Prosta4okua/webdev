
<!--Секція коментарів-->
<?php
echo "<br><br><br><br><br>";
echo $access;
//print_r($user);
//die();
//$sesUSER = $_SESSION['user'];
function addComment ($comment) {

    echo "<div class='card p-3 mt-2'>
    <div class='d-flex justify-content-between align-items-center'>
        <div class='user d-flex flex-row align-items-center'> <img src='https://i.imgur.com/C4egmYM.jpg' width='30' class='user-img rounded-circle mr-2'> <span><small class='font-weight-bold text-primary mx-1'>olan_sams</small> <small class='font-weight-bold'>Loving your work and profile! </small></span> </div> <small>3 days ago</small>
    </div>
    <div class='action d-flex justify-content-between mt-2 align-items-center'>
        <div class='reply px-4'> <small>Remove</small> <span class='dots'></span> <small>Edit</small> <span class='dots'></span> <small>Like</small> </div>
        <div class='icons align-items-center'> <i class='fa fa-check-circle-o check-icon text-primary'></i> </div>
    </div>
</div>";
}
?>
<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9">
                <h1 class="mb-4">Comments</h1>
                <!--                початок коментарів-->
                <?php if ($access >= 0): ?>
                    <div class="form-outline mt-0 mb-4">
                        <form action="?controller=users&action=addComment" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="pageID" value="<?=$_SESSION['user']['userID'];?>">
                            <input type="hidden" name="userID" value="<?=$user['userID'];?>">
                            <input
                                    type="text"
                                    id="addANote"
                                    class="form-control"
                                    name="comment"
                                    placeholder="Type comment..."
                            />
                            <button class="btn btn-outline-success right" type="submit">Add comment</button><br>
                        </form>
                    </div>
                <?php endif;?>
                <?php foreach ($comments as $comment): ?>
                    <div class="card p-3 mt-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="user d-flex flex-row align-items-center">
                                <img src="https://i.imgur.com/C4egmYM.jpg" width="30" class="user-img rounded-circle mr-2">
                                <span><small class="font-weight-bold text-primary mx-1">olan_sams</small>
                                    <small class="font-weight-bold"><?=$comment->commentText?></small></span>
                            </div>
                            <small>3 days ago</small>
                        </div>
                        <div class="action d-flex justify-content-between mt-2 align-items-center">
                            <div class="reply px-4"> <small>Remove</small> <span class="dots"></span> <small>Edit</small> <span class="dots"></span> <small>Like</small> </div>
                            <div class="icons align-items-center"> <i class="fa fa-check-circle-o check-icon text-primary"></i> </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="card p-3 mt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user d-flex flex-row align-items-center"> <img src="https://i.imgur.com/C4egmYM.jpg" width="30" class="user-img rounded-circle mr-2"> <span><small class="font-weight-bold text-primary mx-1">olan_sams</small> <small class="font-weight-bold">Loving your work and profile! </small></span> </div> <small>3 days ago</small>
                    </div>
                    <div class="action d-flex justify-content-between mt-2 align-items-center">
                        <div class="reply px-4"> <small>Remove</small> <span class="dots"></span> <small>Edit</small> <span class="dots"></span> <small>Like</small> </div>
                        <div class="icons align-items-center"> <i class="fa fa-check-circle-o check-icon text-primary"></i> </div>
                    </div>
                </div>
                <div class="card p-3 mt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user d-flex flex-row align-items-center"> <img src="https://i.imgur.com/C4egmYM.jpg" width="30" class="user-img rounded-circle mr-2"> <span><small class="font-weight-bold text-primary mx-1">olan_sams</small> <small class="font-weight-bold">Loving your work and profile! </small></span> </div> <small>3 days ago</small>
                    </div>
                    <div class="action d-flex justify-content-between mt-2 align-items-center">
                        <div class="reply px-4"> <small>Remove</small> <span class="dots"></span> <small>Reply</small> <span class="dots"></span> <small>Translate</small> </div>
                        <div class="icons align-items-center"> <i class="fa fa-check-circle-o check-icon text-primary"></i> </div>
                    </div>
                </div>
                <!--                кінець коментарів-->
            </div>
        </div>
    </div>
</section>