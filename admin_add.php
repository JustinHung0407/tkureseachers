<?php
require_once('connect.php');
session_start();
if(!isset($_SESSION["u_login"]) || ($_SESSION["u_login"]=="") || ($_SESSION["Level"] != "99")){
header("Location:index.php");
}
if(isset($_GET["logout"]) && ($_GET["logout"] == "true")){
unset($_SESSION["u_login"]);
unset($_SESSION["Level"]);
header("Location:index.php");
}
//pull user name
$query_pullMember = "SELECT * FROM member WHERE username ='".$_SESSION["u_login"]."';";
$datapool = mysqli_query($connect,$query_pullMember);
#pull data to vars
$pull_all = @mysqli_fetch_assoc($datapool);
$identity = $pull_all["name"];
// Pull admin
$query_Admin = "SELECT * FROM member WHERE gid = '99'";
$datapool_Admin = mysqli_query($connect,$query_Admin);
// $pull_Admin = @mysqli_fetch_assoc($query_Admin);
// Pull professor
$query_Professor = "SELECT * FROM member WHERE gid = '1'";
$datapool_Professor = mysqli_query($connect,$query_Professor);
// Pull user
$query_User = "SELECT * FROM member WHERE gid = '0'";
$datapool_User = mysqli_query($connect,$query_User);
//delete member
if(isset($_GET["action"]) && ($_GET["action"] == "delete")){
$query_DelMember = "DELETE FROM member WHERE username='".$_GET["id"]."'";
mysqli_query($connect,$query_DelMember);
header("Location:admin_member.php");
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Admin</title>
      <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom CSS -->
      <link href="css/sb-admin.css" rel="stylesheet">
      <!-- Custom Fonts -->
      <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <script type="text/javascript">
      function sure(){
      if(confirm("This CAN'T UNDO, are you sure to DELETE MEMBER ?")) return ttrue;
      else false ;
      }
      </script>>
   </head>
   <body>
      <div id="wrapper">
         <!-- Navigation -->
         <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="index.html">Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                  <ul class="dropdown-menu message-dropdown">
                     
                  </ul>
               </li>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                  <ul class="dropdown-menu alert-dropdown">
                     <li>
                     </li>
                  </ul>
               </li>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $identity; ?><b class="caret"></b></a>
                  <ul class="dropdown-menu">
                     <li>
                        <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                     </li>
                     <li>
                        <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                     </li>
                     <li>
                        <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                     </li>
                     <li class="divider"></li>
                     <li>
                        <a href="?logout=true"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                     </li>
                  </ul>
               </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
               <ul class="nav navbar-nav side-nav">
                  <li class="active">
                     <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-users"></i> Member Manager <i class="fa fa-fw fa-caret-down"></i></a>
                     <ul id="demo" class="collapse">
                        <li>
                           <a href="admin_member.php"><i class="fa fa-list-alt" aria-hidden="true"></i> Member List</a>
                        </li>
                        <li>
                           <a href="admin_edit.php"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Member</a>
                        </li>
                        <li>
                           <a href="admin_add.php"><i class="fa fa-plus" aria-hidden="true"></i> Add Member</a>
                        </li>
                     </ul>
                  </li>
                  <li>
                     <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
                  </li>
                  <li>
                     <a href="#"><i class="fa fa-fw fa-table"></i> Tables</a>
                  </li>
               </ul>
            </div>
            <!-- /.navbar-collapse -->
         </nav>
         <div id="page-wrapper">
            <div class="container-fluid">
               <!-- Page Heading -->
               <div class="row">
                  <div class="col-lg-12">
                     <h1 class="page-header">
                     Member Manage
                     <small>All Members</small>
                     </h1>
                     <ol class="breadcrumb">
                        <li>
                           <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                           <i class="fa fa-file"></i> Blank Page
                        </li>
                     </ol>
                  </div>
               </div>
               <!-- /.row -->
               <div class="row">
                  <div class="col-lg-6">
                     <h2>Admin Account</h2>
                     <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>ID</th>
                                 <th>Name</th>
                                 <th>Group</th>
                                 <th>EMail</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              //進入第一層迴圈
                              while($pull_Admin = @mysqli_fetch_assoc($datapool_Admin)){?>
                              <tr>
                                 <!--建立HTML表格的列-->
                                 <td>1</td>
                                 <td><?php echo $pull_Admin['username'];?></td>
                                 <td><?php echo $pull_Admin['name'];?></td>
                                 <td><?php echo $pull_Admin['name'];?></td>
                                 <td><?php echo $pull_Admin['email'];?></td>
                                 <td>
                                    <a class="btn btn-success btn-xs" href="admin_edit.php?id=<?php echo $pull_Admin['username'] ?>" >Edit</a>
                                    <a class="btn btn-danger btn-xs" href="?action=delete&id=<?php echo $pull_Admin['username'] ?>" onclick="return sure();">Delete</a>
                                 </td>
                              </tr><?php
                              //HTML表格列的結束標記
                              };//第一層迴圈結束
                              ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <h2>User Account</h2>
                     <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>ID</th>
                                 <th>Name</th>
                                 <th>Group</th>
                                 <th>EMail</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              //進入第一層迴圈
                              while($pull_User = @mysqli_fetch_assoc($datapool_User)){?>
                              <tr>
                                 <!--建立HTML表格的列-->
                                 <td>1</td>
                                 <td><?php echo $pull_User['username'];?></td>
                                 <td><?php echo $pull_User['name'];?></td>
                                 <td><?php echo $pull_User['name'];?></td>
                                 <td><?php echo $pull_User['email'];?></td>
                                 <td>
                                    <a class="btn btn-success btn-xs" href="admin_edit.php?id=<?php echo $pull_User['username'] ?>" >Edit</a>
                                    <a class="btn btn-danger btn-xs" href="?action=delete&id=<?php echo $pull_User['username'] ?>" onclick="return sure();">Delete</a>
                                    <!-- Modal -->
                                    <!--
                                    <div class="modal fade" id="myModal" role="dialog">
                                       <div class="modal-dialog modal-sm">
                                          <div class="modal-content">
                                             <div class="modal-body">
                                                <p>Are you sure to delete</p>
                                             </div>
                                             <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" href="admin_member.php?del=--><?php //print $pull_User['username'] ?><!--">Yes</a>
                                                <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    -->
                                    <!-- Modal -->
                                 </td>
                              </tr><?php
                              //HTML表格列的結束標記
                              };//第一層迴圈結束
                              ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <!-- /.row -->
               <div class="row">
                  <div class="col-lg-6">
                     <h2>Professor Account</h2>
                     <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>ID</th>
                                 <th>Name</th>
                                 <th>Group</th>
                                 <th>EMail</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              //進入第一層迴圈
                              while($pull_Professor = @mysqli_fetch_assoc($datapool_Professor)){?>
                              <tr>
                                 <!--建立HTML表格的列-->
                                 <td>1</td>
                                 <td><?php echo $pull_Professor['username'];?></td>
                                 <td><?php echo $pull_Professor['name'];?></td>
                                 <td><?php echo $pull_Professor['name'];?></td>
                                 <td><?php echo $pull_Professor['email'];?></td>
                                 <td>
                                    <a class="btn btn-success btn-xs" href="admin_edit.php?id=<?php echo $pull_Professor['username'] ?>">Edit</a>
                                    <a class="btn btn-danger btn-xs" href="?action=delete&id=<?php echo $pull_Professor['username'] ?>" onclick="return sure();">Delete</a>
                                 </td>
                              </tr><?php
                              //HTML表格列的結束標記
                              };//第一層迴圈結束
                              ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
         </div>
         <!-- /#wrapper -->
         <!-- jQuery -->
         <script src="js/jquery.js"></script>
         <!-- Bootstrap Core JavaScript -->
         <script src="js/bootstrap.min.js"></script>
      </body>
   </html>