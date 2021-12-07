
<!--Секція коментарів-->
<?php
echo "<br><br><br><br><br>";
//echo $access;
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
                            <input type="hidden" name="userID" value="<?=$_SESSION['user']['userID'];?>">
                            <input type="hidden" name="pageID" value="<?=$user['userID'];?>">
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
                <?php
//                print_r($comments);
                foreach ($users as $u) {
                    if ($u['userID'] == $comment['authorID'])
                        {
//                            echo "yes";
                            break;
                        }
                }
//                print_r($comment);
//                print_r($u);
                ?>
                    <div class="card p-3 mt-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="user d-flex flex-row align-items-center">
                                <?php $path = ($u['avatarName'] == "")? "../public/default/default.png" : "../public/uploads/" . $u['avatarName']?>

                                <img src="<?=$path?>" width="30" height="30" class="user-img rounded-circle mr-2">
                                <span><small class="font-weight-bold text-primary mx-1"><?=$u['surname']." ".$u['name']?></small>
                                    <small class="font-weight-bold"><?=$comment['commentText']?></small></span>
                            </div>
                            <small>
                                <?=$comment['dateTime']?>
                            </small>
                        </div>
                        <div class="action d-flex justify-content-between mt-2 align-items-center">
                            <div class="reply px-4">
                                <?php if ($access >= 1): ?>
                                <form method="post" action="?controller=users&action=deleteComment&commentID=<?=$comment['commentID']?>&userID=<?=$user['userID']?>" class="inline">
<!--                                    <a href="?controller=users&action=deleteComment"><small style="text-decoration-line: inherit;text-decoration-color: white;"></small></a>-->
                                    <input type="hidden" name="commentID2" value="<?=$comment['commentID']?>">
                                    <input type="hidden" name="pageID" value="<?=$user['userID'];?>">
                                    <button class="link-button" type="submit" name="commentID" value="<?=$comment['commentID']?>" ><small>Remove</small>
                                    </button>
                                </form>
                                <?php endif; ?>

                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['userID']==$user['userID']): ?>
                                    <span class="dots"></span>
                                    <form method="post" action="?controller=users&action=editComment&commentID=<?=$comment['commentID']?>&commentText=<?=$user['userID']?>" class="inline">
                                        <!--                                    <a href="?controller=users&action=deleteComment"><small style="text-decoration-line: inherit;text-decoration-color: white;"></small></a>-->
                                        <input type="hidden" name="commentID2" value="<?=$comment['commentID']?>">
                                        <input type="hidden" name="pageID" value="<?=$user['userID'];?>">
                                        </button>
                                        <button class="link-button" data-bs-toggle="modal" data-bs-target="#myForm" name="commentID" value="<?=$comment['commentID']?>"><small>Edit</small>
                                    </form>
                                <?php endif; ?></div>
                            <div class="icons align-items-center"> <i class="fa fa-check-circle-o check-icon text-primary"></i> </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!--                кінець коментарів-->
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="myForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bootstrap 5 Modal Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="?controller=users&action=editComment&commentID=<?=$comment['commentID']?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Text</label>
                        <input type="text" class="form-control" id="username" name="email" placeholder="Your text..." />
                    </div>
                    <div class="modal-footer d-block">
                        <p class="float-start">Don't have an account? <a href="#">Sign Up</a></p>
                        <button type="submit" class="btn btn-success float-end">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>