<?php
	session_start();
	if (!isset($_SESSION)) {
    session_start();
	}	
	if(@$_SESSION['user_id']==''){		
		echo "<script>alert('Please login!');window.location.href='login.html';</script>;";
	}
		
 
?>	


<!DOCTYPE html>
<html lang="en" class="app">
<head> 
  <meta charset="utf-8" />
  <title>Media Vault</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="js/jPlayer/jplayer.flat.css" type="text/css" />
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" /> 
  <link rel="icon" href="http://joeyrabbitt.com/favicon.ico" type="image/x-icon">
<link rel="icon" href="http://joeyrabbitt.com/favicon.ico" type="image/x-icon">  
    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
  
</head>
<body class="">
  <section class="vbox">
     <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
      <div class="navbar-header aside bg-info dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="icon-list"></i>
        </a>
        <a href="home.php" class="navbar-brand text-lt">
          <i class="icon-bag"></i>
          <img src="images/logo.png" alt="." class="hide">
          <span class="hidden-nav-xs m-l-sm">Media Vault</span>
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="icon-settings"></i>
        </a>
      </div>      <ul class="nav navbar-nav hidden-xs">
        <li>
          <a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">
            <i class="fa fa-indent text"></i>
            <i class="fa fa-dedent text-active"></i>
          </a>
        </li>
      </ul>
      <form class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs" role="search" method="post" action="search.php">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-search"></i></button>
            </span>
            <input type="text" name="search" class="form-control input-sm no-border rounded" placeholder="Search songs, video...">
          </div>
        </div>
      </form>
      <div class="navbar-right ">
        <ul class="nav navbar-nav m-n hidden-xs nav-user user">
			          
					  
			<li >
     			<table width="150" height="60"border="0">
					<tr>					
						<td width="40">Used </td>
						
						<td>
							<?php
								include "conn.php";
								$id = $_SESSION['user_id'];
								$sql = "select * from upload where user_id = '$id'";
								$result = mysql_query($sql);
								
								while($row= mysql_fetch_array($result)){
									@$size2+=$row['size'];
									
								}
								@$total_used = $size2/100000000*100;
								
								echo number_format($total_used,2)."%";
							
							?>
						
						
						</td> <!--写代码？-->
					</tr>
                </table>		     
			</li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                  
              <?php
							include "conn.php";
							$userid=$_SESSION['user_id'];
							
							$query ="select * from user_details where session_id='$userid' and name=''";
							$rquery = mysql_query($query);
					
				          if($rowresult=mysql_num_rows($rquery)==0){
							  $pathimage='';
						  }
						  else{
							while($rowresult2=mysql_fetch_array($rquery)){
								$pathimage=$rowresult2['icon'];
							}
						
						  }
						?>
						
                        <img src="<?php echo $pathimage; ?>" class="dker" alt="...">
              
              </span>
              <?php echo $_SESSION['username']?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">            
              <li>
                <span class="arrow top"></span>
                <a href="setting.php">Settings</a>
              </li>
              <li>
                <a href="profile.php">Profile</a><!--我他妈醉了，把profile改成personaldetail了-->
              </li>
              <li class="divider"></li>
              <li>
                <a href="instruction.php">Instruction</a>
              </li>
			  <li>
                <a href="FAQ.php">FAQ</a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="login.html" data-toggle="ajaxModal">Logout</a>  <!--要加一个推出成功的提示框-->
              </li>
			  <li>
				<a href="index.html">Exit</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>      
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-black dk aside hidden-print" id="nav">          
          <section class="vbox">
            <section class="w-f-md scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                


                <!-- nav -->                 
                <nav class="nav-primary hidden-xs">
                  <ul class="nav bg clearfix">
                    <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                      Discover
                    </li>
                    <li>
                      <a href="show_pdf.php">
                        <i class="icon-book-open icon text-success"></i>
                        <span class="font-bold">PDF</span>
                      </a>
                    </li>
					<li>
                      <a href="show_picture.php">
                        <i class="icon-camera icon text-primary-lter"></i>
                        <span class="font-bold">Photo</span>
                      </a>
                    </li>
                    <li>
                      <a href="show_music.php">
                        <i class="icon-music-tone-alt icon text-info"></i>
                        <span class="font-bold">Music</span>
                      </a>
                    </li>
              
       
                    <li>
                      <a href="show_video.php">
                        <i class="icon-social-youtube icon  text-primary"></i>
                        <span class="font-bold">Video</span>
                      </a>
                    </li>
					   <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                      Functions
                    </li>
				  <li>
                      <a href="upload.php" >
                        <i class="fa fa-upload  text-primary"></i>
                        <span class="font-bold">Upload</span>
                      </a>
                    </li>
					
					<li>
                      <a href="show_bin.php" >
                        <i class="fa fa-trash-o text-primary"></i>
                        <span class="font-bold">Recycle Bin</span>
                      </a>
                    </li>
				</ul>
				
				  <ul class="nav bg clearfix">
                    <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                      Sort
                    </li>
					<li>
                      <a href="sort_time.php"><!--具体什么格式还要改。。是form？还是table？-->
                        <i class="fa fa-bars  text-primary"></i>
                        <span class="font-bold">Time</span>
                      </a>
                    </li>
					<li>
                      <a href="sort_name.php" >
                        <i class="fa fa-sort-alpha-asc text-primary"></i>
                        <span class="font-bold">Name</span>
                      </a>
                    </li>
					<li>
                      <a href="sort_size.php">
                        <i class="fa fa-sort-amount-desc  text-primary"></i>
                        <span class="font-bold">Size</span>
                      </a>
                    </li>
				</ul>
                 </nav>
                <!-- / nav -->
              </div>
            </section>
			
             <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <div class="bg hidden-xs ">
                  <div class="dropdown dropup wrapper-sm clearfix">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb-sm avatar pull-left m-l-xs">                        
                           
              <?php
							include "conn.php";
							$userid=$_SESSION['user_id'];
							
							$query ="select * from user_details where session_id='$userid' and name=''";
							$rquery = mysql_query($query);
					
				          if($rowresult=mysql_num_rows($rquery)==0){
							  $pathimage='';
						  }
						  else{
							while($rowresult2=mysql_fetch_array($rquery)){
								$pathimage=$rowresult2['icon'];
							}
						
						  }
						?>
						
                        <img src="<?php echo $pathimage; ?>" class="dker" alt="...">
             
                        <i class="on b-black"></i>
                      </span>
                      <span class="hidden-nav-xs clear">
                        <span class="block m-l">								
                          <strong class="font-bold text-lt"><?php echo $_SESSION['username']?></strong>
                          <b class="caret"></b>
                
                    </a>
                    <ul class="dropdown-menu animated fadeInRight aside text-left">                      
                      <li>
                        <span class="arrow bottom hidden-nav-xs"></span>
                        <a href="setting.php">Settings</a>
                      </li>
                      <li>
                        <a href="profile.php">Profile</a>
                      </li> 
					  <li class="divider"></li>
                      <li>
                        <a href="instruction.php">Instruction</a>
                      </li>
			          <li>
                        <a href="FAQ.php">FAQ</a>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="login.html" data-toggle="ajaxModal" >Logout</a>
                      </li>
					  <li>
						<a href="index.html">Exit</a>
                      </li>
                    </ul>
                  </div>
                </div>            
			</footer>

          </section>
        </aside>
        <!-- /.aside -->
        <section id="content">
          <section class="vbox">          
            <section class="scrollable wrapper">
			
			
			
              <section class="panel panel-default portlet-item">
                <header class="panel-heading">
                  <ul class="nav nav-pills pull-right">
                    <li>
                      <a href="#" class="panel-toggle text-muted"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a>
                    </li>
                  </ul>
                  Account management                    
                </header>
                <section class="panel-body">
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-angle-right fa-stack-1x text-white"></i>
                      </span>
                    </div>
                    <div class="media-body">                        
                      <a href="#" class="h4">Upload head photo</a>
                      <small class="block m-t-xs">When click on the dropdown box on the left-bottom or top-right of the page, click the setting button, then you can add/modify personal file and head photo.</small>
                
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x text-info"></i>
                        <i class="fa fa-angle-right fa-stack-1x text-white"></i>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4">Modify password</a>
                      <small class="block m-t-xs">When login sign in page, click the modify password button to modify password.</small>
              
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x icon-muted"></i>
                        <i class="fa fa-angle-right fa-stack-1x text-white"></i>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4 ">Find lost password</a>
                      <small class="block m-t-xs">When login sign in page, click the forgot password button to reset the password.</small>
                    
                    </div>
                  </article>
                </section>
              </section>
			  
			
			
              <section class="panel panel-default portlet-item">
                <header class="panel-heading">
                  <ul class="nav nav-pills pull-right">
                    <li>
                      <a href="#" class="panel-toggle text-muted"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a>
                    </li>
                  </ul>
                  Media file management                   
                </header>
                <section class="panel-body">
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-angle-right fa-stack-1x text-white"></i>
                      </span>
                    </div>
                    <div class="media-body">                        
                      <a href="#" class="h4">Upload media file</a>
                      <small class="block m-t-xs">Click the upload button on the left of the homepage, the upload page will be shown, then click upload to upload media files.</small>
                
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x text-info"></i>
                        <i class="fa fa-angle-right fa-stack-1x text-white"></i>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4">Download media file</a>
                      <small class="block m-t-xs">
				         <ul> 	
						     <li>PDF: click the file, the detail will be shown in a new page, then you can see the download button at the bottom right corner.</li>
						     <li>Photo: click the file, the detail will be shown in a new page, then right click the photo to download</li>
						     <li>Music: right click the “play” button to download</li>
						     <li>Video: right click the “play” button to download</li>
					     </ul>					  
					   </small>
              
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x icon-muted"></i>
                        <i class="fa fa-angle-right fa-stack-1x text-white"></i>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4 ">Delele media file</a>
                      <small class="block m-t-xs">Click delete button under each specific media item to delete</small>
                    
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-angle-right fa-stack-1x text-white"></i>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4 ">Search media</a>
                      <small class="block m-t-xs">On the top of the page, you will find the search bar, which can search everything by type, name, keyword, etc.</small>
                    
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x text-info"></i>
                        <i class="fa fa-angle-right fa-stack-1x text-white"></i>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4 ">Rename media</a>
                      <small class="block m-t-xs">Click rename button under each specific media item to rename media.</small>
                    
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x icon-muted"></i>
                        <i class="fa fa-angle-right fa-stack-1x text-white"></i>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4 ">Play media in media vault</a>
                      <small class="block m-t-xs">Click the specific media item to play media online.</small>
                    
                    </div>
                  </article>
                </section>
              </section>
			  
			
			
              <section class="panel panel-default portlet-item">
                <header class="panel-heading">
                  <ul class="nav nav-pills pull-right">
                    <li>
                      <a href="#" class="panel-toggle text-muted"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a>
                    </li>
                  </ul>
                  User experience                    
                </header>
                <section class="panel-body">
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-angle-right fa-stack-1x text-white"></i>
                      </span>
                    </div>
                    <div class="media-body">                        
                      <a href="#" class="h4">FAQ</a>
                      <small class="block m-t-xs">When users meet some problems when they are using media vault, they can high-possibly find the answers through FAQ. The most frequent Q & A are collected and integrated from user feedbacks.</small>
                
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x text-info"></i>
                        <i class="fa fa-angle-right fa-stack-1x text-white"></i>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4">Check storage capability</a>
                      <small class="block m-t-xs">Users can check the capability, which is shown on the top-right of user interface.</small>
              
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x icon-muted"></i>
                        <i class="fa fa-angle-right fa-stack-1x text-white"></i>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4 ">Any other problems</a>
                      <small class="block m-t-xs">Any other problems you meet in media vault, you can contact our manager with the contact information in ‘About us’ page. Our manager will reply you as soon as possible.</small>
                    
                    </div>
                  </article>
                </section>
              </section>
			  
	
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>
      </section>
    </section>    
  </section>
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>  
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/app.plugin.js"></script>
  <script type="text/javascript" src="js/jPlayer/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="js/jPlayer/add-on/jplayer.playlist.min.js"></script>
  <script type="text/javascript" src="js/jPlayer/demo.js"></script>

</body>
</html>
