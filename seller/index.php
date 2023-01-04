<?php require 'session_check.php' ?>
<?php require '_header.php' ?>
<?php require '_navbar.php' ?>


<?php 

require 'custom_function.php';   
$postso = fetch_all_data_usingPDO($pdo,"select * from post where status = 1 or status = 0 and seller_id = '".$_SESSION['user_id']."'"); 
$posts = fetch_all_data_usingPDO($pdo,"SELECT * FROM `post` INNER JOIN `user` ON user.id=post.seller_id WHERE post.status=1 AND user.id=".$_SESSION['user_id']." ORDER BY `post_id` DESC");

?>
<h3 style="text-align: center;padding:12px;">Welcome Chef <?php $name = fetch_all_data_usingDB($db,"select * from user where id= '".$_SESSION['user_id']."'"); echo $name['name'];  ?></h3>
<span></span>

<section>
    <div class="container mt-5 mb-5">
        <div class="row headstart">
            <div class="col-md-6">
                <h1>Food Posts</h1>
            </div>
           
            <div class="col-md-6">
                <div style="margin-left:60%;">
                    <a  href="food_add.php" class="btn btn-success addfood" style="min-width: 150px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Add Food Post</a>

                </div>
            </div>
        </div>

        <div class="row">
            <?php 

                foreach($postso as $key =>$data)
                {
            ?>
                     <?php  
                        $seller = fetch_all_data_usingDB($db,"select * from user where id = '".$data['seller_id']."'");                                        
                     ?>
                    <div class="col-md-4 mt-5 posts">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="../<?= $data['image'] ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-center"><?= $data['title'] ?></h5>
                                <p class="card-text"><?php echo substr($data['details'],0,200); ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Price: ৳<?= $data['price'] ?></li>
                                <li class="list-group-item">Seller: <?= $seller['name'] ?></li>
                                <li class="list-group-item">Location: <?= $seller['location'] ?></li>
                                
                            </ul>
                            <div class="card-body">
                                <a href="food_post_view.php?post_id=<?= $data['post_id'] ?>" class="card-link btn btn-primary btn-block">View</a>
                               
                            </div>
                        </div>
                    </div>


            <?php 
                }

            ?>
        </div>
    </div>
</section>

 <?php require '_footer.php' ?>
