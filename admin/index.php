<?php include "includes/admin_header.php"?>;


 <?php if($connection) echo "bjhbsadkjsab"; ?>


    <div id="wrapper">

  

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>;

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin 

                            <small><?php echo $_SESSION['username']?></small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <div class="huge"><?php echo $post_count = recordCount('posts')?></div>  

                
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <div class="huge"><?php echo $comment_count = recordCount('comments')?></div> 
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <div class="huge"><?php echo $user_count = recordCount('users')?></div> 
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <div class="huge"><?php echo $category_count = recordCount('categories')?></div> 
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->

             <!-- Check different status -->
            <?php

                $published_post_count = checkStatus('posts','post_status','published');
              
                $draft_post_count = checkStatus('posts','post_status','draft');
      
                $unapproved_comments_count = checkStatus('comments','comment_status','unapproved');

                $subscriber_count = checkStatus('users','user_role','Subscriber');
            
            
            ?>


<!--  Creating bar Chart in the admin page to show different data from the databse to users
the bar chart is got from the google chart-->
            <div class="row">

            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['bar']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Date', 'Count'],
                        
                        /* The code below goes throught 2 arrays and get out all the required info
                        to show the bar charts on the Dashbord*/
                        <?php
                        
                            $element_text = ['All Posts','Draft Posts', 'Published Posts','Unapproved Comments', 'Subscribers', 'Comments', 'Users','Categories'];
                            $element_count = [$post_count, $draft_post_count, $published_post_count, $unapproved_comments_count, $subscriber_count, $comment_count, $user_count, $category_count];
                            
                            for($i=0; $i<8; $i++){

                                echo "['{$element_text[$i]}'" . "," . "$element_count[$i]],";

                            }
                        
                        ?>

                        // ['Posts', 1000],
                    ]);

                    var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>
            <div id="columnchart_material" style="width:'auto'; height: 500px;"></div>

            </div>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include "includes/admin_footer.php"?>;