<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo base_url().'images/HORIZONS-LOGO-2.png';?>" type="image/ico" />

    <title>Better Bound House</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('bootstrap/vendors/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="<?php echo base_url('bootstrap/vendors/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('bootstrap/vendors/nprogress/nprogress.css');?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('bootstrap/vendors/iCheck/skins/flat/green.css');?>" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('bootstrap/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css');?>" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('bootstrap/vendors/jqvmap/dist/jqvmap.min.css');?>" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url(); ?>datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('bootstrap/build/css/custom.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('css/croppie.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('datepicker/css/daterangepicker.css');?>" rel="stylesheet">

    <style type="text/css">
        #addleadmodal .modal-content, #updateleadmodal .modal-content, #viewleadmodal .modal-content, #payleadmodal .modal-content{padding: 0px 20px; width: 200%; margin-left: -160px;}
    table.dataTable thead > tr > th.sorting{padding-right: 0px !important;}
    #payleadmodal .modal-content{ width: 300% !important; margin-left: -415px !important;}
    .hide_initialpayment, .hide_amount_paid, .alert-success{display: none;}
    #viewleadhistorymodal .modal-content{padding: 0px 20px; width: 280%; margin-left: -405px;}
    #viewleadremarkhistorymodal .modal-content{ width: 200% !important; margin-left: -415px !important;}

.daterangepicker .ranges li.active, .daterangepicker .ranges li:hover {
      background-color: #08c;
    border: 1px solid #08c;
    color: #fff;}
    
 </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url().'dashboard/';?>" class="site_title"><div class="image"> <span>Better Bound House</div></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
          <!--      <form id="uploadForm"  method="POST" enctype="multipart/form-data">
                  <div class="profile_pic">
                    <img id="image_preview" style="width: 150px; height: 150px; margin: 20px auto;" src="<?=(!empty($this->session->userdata['userlogin']['avatar']) ? base_url('images/'.$this->session->userdata["userlogin"]["avatar"].''): 'test') ; ?>"  alt="..." class="img-circle profile_img">
                  </div>
                     <div style="clear: both; margin: 128px 0px 0px 0px; text-align: center;">
                       <input type="file" id="uploadfile" name="file" style="margin:20px auto;" />
                       <button type="button" id="upload" class="btn btn-primary" >Upload</button>
                     </div>
                </form> -->
              <div class="profile_info">
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

               <!-- sidebar menu -->
             <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> All Leads Bucket <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url("dashboard/dashboard")?>">Leads</a></li>
                      <li><a href="<?php echo site_url("dashboard/sold_leads")?>">Sold Leads</a></li>
                      <li><a href="<?php echo site_url("dashboard/contract")?>">For Contract Leads</a></li>
                      <li><a href="<?php echo site_url("dashboard/collection_lead")?>">For Collection Leads</a></li>
                      <li><a href="<?php echo site_url("account/users")?>">All Users</a></li>  
                    </ul>
                  <?php if ($this->session->userdata['userlogin']['usertype'] != 'Manager'): ?>

                  <!--<li><a href="<?php echo site_url("dashboard/contract")?>"><i class="fa fa-edit"></i> Contract Leads</a>-->
                 <?php endif; ?>
                  <?php if ($this->session->userdata['userlogin']['usertype'] == 'Admin'): ?>
                    <!--<li><a href="<?php echo site_url("account/users")?>"><i class="fa fa-users"></i>All Users</a></li>-->
                  <?php endif?>
                  <!--<li><a href="<?php echo site_url("dashboard/email")?>"><i class="fa fa-envelope"></i> Email Authors</a></li>-->
                  <!--<li><a href="<?php echo site_url("dashboard/signature")?>"><i class="fa fa-file"></i>Add Signature</a></li>-->

                <?php if ($this->session->userdata['userlogin']['usertype'] != 'Manager'): ?>
                <li><a href="<?php echo site_url("account/assign_user")?>"><i class="fa fa-users"></i> Assign to Manager</a></li>
                  
                <li><a href="<?php echo site_url("account/assign_agent")?>"><i class="fa fa-users"></i> Assign to Agent</a></li>
                  
                <li><a href="<?php echo site_url("dashboard/collection_payment")?>"><i class="fa fa-users"></i>Leads Transaction</a></li>
                  <!--<li><a><i class="fa fa-users"></i> Transaction Leads <span class="fa fa-chevron-down"></span></a>-->
                  <!--   <ul class="nav child_menu">-->
                  <!--    <li><a href="<?php echo site_url("dashboard/collection_payment")?>">Collection Payment</a></li>-->
                  <!--  </ul>-->
                  <!--</li>-->
               <?php endif; ?>
               <?php if ($this->session->userdata['userlogin']['usertype'] == 'Manager'): ?>
                 <!--<li><a href="<?php echo site_url("account/assign_user")?>"><i class="fa fa-users"></i> Assign Agent</a></li>-->
               <?php endif; ?>
                   <li><a><i class="fa fa-history"></i> History Leads <span class="fa fa-chevron-down"></span></a>
                     <ul class="nav child_menu">    
                       <li><a href="<?php echo site_url("dashboard/lead_history")?>">Leads</a></li>
                       <li><a href="<?php echo site_url("dashboard/collection_history")?>">Collection Payment Leads</a></li>
                       <li><a href="<?php echo site_url("dashboard/contract_history")?>">Contract Author</a></li>
                       <li><a href="<?php echo site_url("dashboard/contract_author_approval_history")?>">Contract Approval Author</a></li>
                       <li><a href="<?php echo site_url("dashboard/author_report_history")?>">Report Author Relation</a></li>
                      <li><a href="<?php echo site_url("dashboard/email_user_history")?>">Email Users</a></li>

                    </ul>
                      <?php if ($this->session->userdata['userlogin']['usertype'] == 'Manager' || $this->session->userdata['userlogin']['usertype'] == 'Admin'): ?>
                          <li><a href="<?php echo site_url("dashboard/report")?>"><i class="fa fa-file"></i> Report </a>
                    <?php endif; ?>

                  </li>
                </ul>
             </div>

            </div>
            <!-- /sidebar menu -->
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?=site_url('account/logout');?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <?=ucfirst($this->session->userdata['userlogin']['firstname']) .' '. ucfirst($this->session->userdata['userlogin']['lastname']);?>
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item view_accountprofile" aria-hidden="true" data-toggle="modal" data-target="#editUserModal" data-backdrop="static" data-keyboard="false" data-userid=<?=ucfirst($this->session->userdata['userlogin']['user_id']);?>> Profile</a>
                    <a class="dropdown-item view_account_password" aria-hidden="true" data-toggle="modal" data-target="#editUserPasswordModal" data-backdrop="static" data-keyboard="false" data-userid=<?=ucfirst($this->session->userdata['userlogin']['user_id']);?>> Change Password</a>
                    <a class="dropdown-item"  href="<?=site_url('account/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row" style="display: inline-block;" >
          <div class="tile_count">
            
          </div>
        </div>
          <!-- /top tiles -->
            <!-- Date Picker Input -->
         
<div id="reportrange" style="background: #fff; cursor: pointer; padding: 10px 15px; border: 1px solid #ccc; width: 50%;margin: 30px 0px 0px 0px;" >
    <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
    <span></span> <b class="caret"></b>
</div><!-- DEnd ate Picker Input -->
<br>
  <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i>List of Leads
<!--  -->
  </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="leaddataTableFixed" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Project ID</th>
                  <th>Package Name</th>
                  <th>Author Name</th>
                  <th>Book Title</th>
                  <th>Email Address</th>
                  <th>Contact #</th>
                  <th>Lead Type</th>
                  <th>Status and Date</th>
                  <th>User Charge</th>
                  <th>Remark</th>
                  <th style="display:none;"></th>
                </tr>
              </thead>
              <tbody>
              <?php
                  $get_count_payment =0;
                  $replace_comma = "";
                  if ($leads > 0){
                       foreach ($leads as $lead){
                         
                         echo "<tr>";
                               echo "<td>".modules::run("dashboard/setindex_prefix",$lead['project_id'])."</td>"; 
                               echo "<td>".$lead['product_name']."</td>";
                               echo "<td><a href='#' class='view_leadhistory' data-toggle='modal' data-target='#viewleadhistorymodal' data-backdrop='static' data-keyboard='false' data-author_name='".$lead['author_name']."' data-project_id=".$lead['project_id']." data-userid=".$this->session->userdata['userlogin']['user_id']."</a>".$lead['author_name']."</td>";
                               echo "<td>".$lead['book_title']."</td>";
                               echo "<td>".$lead['email_address']."</td>";
                               echo "<td>".$lead['contact_number']."</td>";
                               echo "<td>".$lead['collection_status']."</td>";
                               echo "<td>".$lead['alter_collection_status']. ' - '. date("d/m/Y h:i:s a", strtotime($lead  ['date_create'])).  "</td>";
                               echo "<td>".ucfirst($lead['collection_user_charge'])."</td>";
                               echo "<td><button type='button' class='btn btn-primary view_lead_remark' data-toggle='modal' data-target='#vewleadreamarkmodal' data-backdrop='static' data-keyboard='false' data-collection_id='".$lead['collection_id']."'>View</button></td>";
                               echo "<td style='display:none;'>".date("Y-m-d", strtotime($lead['date_create']))."</td>";
                          echo "</tr>";
                     }
                  }  
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
          <br />

          <div class="row">

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Horizons <a href="https://colorlib.com"></a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>


            <!-- The payment  Remark-->
                <div class="modal fade" id="vewleadreamarkmodal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    
                      <!-- Modal Header -->
                           <div class="modal-header">
                            <h4 class="modal-title">Remark</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                               <div class="alert alert-success"><p></p></div>
                                 <div class="col mb-3">
                                       <label for="validationCustom05">Remark</label>
                                         <textarea class="form-control remark"  disabled rows="3"  name="remark"></textarea>

                                 </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                  </div>
                          </div>
                          
                    </div>
                  </div>
                </div>
            <!-- end of Remark modal -->

                     <!-- Edit User -->
         <div class="modal fade" id="editUserModal">
            <div class="modal-dialog">
              <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                 <div class="modal-body">
                      <div class="signup-form">
                      <form id="editUserform" method="post">
                          <div class="alert alert-success"><p></p></div>
                        <h2>Your Profile</h2>
                        <p class="hint-text">Edit your account.</p>
                            <div class="form-group">
                              <input type="text" class="form-control" name="firstname" placeholder="First Name" required="required">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name="lastname" placeholder="Last Name" required="required">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name="username" placeholder="User Name" required="required">
                            </div>
                            <div class="form-group">
                              <input type="email" class="form-control" name="email_address" placeholder="Email Address" required="required">
                            </div>
                            <div class="form-group">
                              <input type="hidden" class="form-control" name="email_address_confirm" placeholder="Email Address" required="required">
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name="contact" placeholder="Contact Number" required="required">
                            </div>

                         <div class="form-group">
                            <select class="form-control usertype" name="usertype">
                                <option value="">Please Select An UserType</option>
                                <option value="Admin">Admin</option>
                                <option value="IT">IT</option>
                                <option value="Manager">Manager</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Finance">Finance</option>
                                <option value="Human Resources">Human Resources</option>
                                <option value="Agent">Agent</option>
                              </select>
                           </div>

                        <div class="form-group">
                                <button type="button" id="update_account" class="btn btn-success btn-lg btn-block">Update</button>
                            </div>
                        </form>
                    </div>
                  </div>
               </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
          </div>
      </div>

<!-- Password User -->
         <div class="modal fade" id="editUserPasswordModal">
            <div class="modal-dialog">
              <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                 <div class="modal-body">
                      <div class="signup-form">
                      <form id="editUserPasswordform" method="post">
                          <div class="alert alert-success"><p></p></div>
                        <h2>Change Password</h2>
                        <p class="hint-text">Change your password.</p>
                            <div class="form-group">
                              <input type="password" class="form-control" name="current_password" placeholder="Enter your Current Password" required="required">
                            </div>
                            <div class="form-group">
                              <input type="password" class="form-control" name="new_password" placeholder="Enter your New Password" required="required">
                            </div>
                            <div class="form-group">
                              <input type="password" class="form-control" name="confirm_password" placeholder="Enter your Confirm your Password" required="required">
                            </div>
                        <div class="form-group">
                                <button type="button" id="change_password" class="btn btn-success btn-lg btn-block">Update</button>
                            </div>
                        </form>
                    </div>
                  </div>
               </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
          </div>
      </div>

         <!-- The History Leas  Remark-->
                <div class="modal fade" id="viewleadhistorymodal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    
                      <!-- Modal Header -->
                           <div class="modal-header">
                            <h4 class="modal-title">Your Lead History </h4> 
                           <a  class="btn btn-success btn-block viewleadremark_history" style="width: 220px; margin-left:50px; color:#ffffff;" data-toggle='modal' data-target='#viewleadremarkhistorymodal' data-backdrop='static' data-keyboard='false' data-author_name="">Lead Communications</a>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                                <div class="table-responsive">
                                      <table class="table table-bordered" id="historyleadtable" width="100%" cellspacing="0">
                                        <thead>
                                          <tr>
                                            <th>Project ID</th>
                                            <th>Package Name</th>
                                            <th>Author Name</th>
                                            <th>Book Title</th>
                                            <th>Email Address</th>
                                            <th>Contact #</th>
                                            <th>Lead Type</th>
                                            <th>Status and Date</th>
                                            
                                          </tr>
                                        </thead>
                                        <tbody class="viewleadhistory">

                                        </tbody>
                                      </table>
                              </div>
                                <form id="leadremarkform">
                                  <div class="col mb-1 w-50 p-3 align-middle" style="margin:0px auto;">
                                        <div class="alert alert-success"><p></p></div>
                                        <input type="hidden" readonly class="form-control" name="project_id" placeholder="Project ID" required="required">
                                        <input type="hidden" readonly class="form-control" name="author_name" placeholder="Author Name" required="required">
                                        <label for="validationCustom05">Add Remark</label>
                                        <textarea class="form-control remark" rows="4" name="remark"></textarea>
                                          <div class="form-group" style='margin-top:10px;'>
                                            <button type="button" id="add_remark" class="btn btn-success btn-lg btn-block">Save</button>
                                          </div>
                                    </div>
                                </form> 
                            </div>
                               <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                 </div>
                          </div>
                          
                    </div>
                  </div>
                </div>
            <!-- end of Remark modal -->

                        <!-- The History Leas  Remark-->
                <div class="modal fade" id="viewleadremarkhistorymodal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    
                      <!-- Modal Header -->
                           <div class="modal-header">
                            <h4 class="modal-title">Remark History </h4> 
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>

                          <!-- Modal body -->
                          <div class="modal-body">
                                <div class="table-responsive">
                                      <table class="table table-bordered" id="historyleadtable" width="100%" cellspacing="0">
                                        <thead>
                                          <tr>
                                            <th>From User</th>
                                            <th>User Type</th>
                                            <th>Remark</th>
                                            <th>Date Remark</th>
                                          </tr>
                                        </thead>
                                        <tbody class="viewleadremarkhistory">

                                        </tbody>
                                      </table>
                              </div>
                            </div>
                          </div>
                          
                    </div>
                  </div>
                </div>
            <!-- end of Remark modal -->



    <script>var base_url = "<?php echo base_url(); ?>";</script>
    <!-- jQuery -->
    <script src="<?php echo base_url('js/jquery.min.js');?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('bootstrap/vendors/bootstrap/dist/js/bootstrap.bundle.min.js');?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('bootstrap/vendors/fastclick/lib/fastclick.js');?>"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('bootstrap/vendors/nprogress/nprogress.js');?>"></script>
    <!-- Chart.js');?> -->
    <script src="<?php echo base_url('bootstrap/vendors/Chart.js/dist/Chart.min.js');?>"></script>
    <!-- gauge.js');?> -->
    <script src="<?php echo base_url('bootstrap/vendors/gauge.js/dist/gauge.min.js');?>"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url('bootstrap/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js');?>"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('bootstrap/vendors/iCheck/icheck.min.js');?>"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url('bootstrap/vendors/skycons/skycons.js');?>"></script>
    <!-- Flot -->
    <script src="<?php echo base_url('bootstrap/vendors/Flot/jquery.flot.js');?>"></script>
    <script src="<?php echo base_url('bootstrap/vendors/Flot/jquery.flot.pie.js');?>"></script>
    <script src="<?php echo base_url('bootstrap/vendors/Flot/jquery.flot.time.js');?>"></script>
    <script src="<?php echo base_url('bootstrap/vendors/Flot/jquery.flot.stack.js');?>"></script>
    <script src="<?php echo base_url('bootstrap/vendors/Flot/jquery.flot.resize.js');?>"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url('bootstrap/vendors/flot.orderbars/js/jquery.flot.orderBars.js');?>"></script>
    <script src="<?php echo base_url('bootstrap/vendors/flot-spline/js/jquery.flot.spline.min.js');?>"></script>
    <script src="<?php echo base_url('bootstrap/vendors/flot.curvedlines/curvedLines.js');?>"></script>
    <script src="<?php echo base_url(); ?>datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>datatables/dataTables.bootstrap4.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url('bootstrap/vendors/DateJS/build/date.js');?>"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url('bootstrap/vendors/jqvmap/dist/jquery.vmap.js');?>"></script>
    <script src="<?php echo base_url('bootstrap/vendors/jqvmap/dist/maps/jquery.vmap.world.js');?>"></script>
    <script src="<?php echo base_url('bootstrap/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js');?>"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url('datepicker/js/moment.min.js');?>"></script>
    <script src="<?php echo base_url('datepicker/js/daterangepicker.js');?>"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('bootstrap/build/js/custom.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('js/croppie.js');?>"></script>


     <script src="<?php echo base_url('js/validateuser.js');?>"></script>
     <script src="<?php echo base_url('js/validatelead.js');?>"></script>

 <script>  
 var oTable = $('#leaddataTableFixed').DataTable({"autoWidth": false, columnDefs: [
            { width: '10%', targets: 2 }
        ],
        fixedColumns: true});

 $(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);


  $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
   var start = picker.startDate.format('YYYY-MM-DD');
   var end = picker.endDate.format('YYYY-MM-DD');

  

  $.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
      var min = new Date(start);
      var max = new Date(end);
      var startDate = new Date(data[10]);
      console.log(startDate +  " <= " + max  + " --- "  + (startDate <= max));
      
      if (min == null && max == null) {
        return true;
      }
      if (min == null && startDate <= max) {
        return true;
      }
      if (max == null && startDate >= min) {
        return true;
      }
      if (startDate <= max && startDate >= min) {
        return true;
      }
      return false;
    }
  );
  oTable.draw();
  $.fn.dataTable.ext.search.pop();
});
    
});

 </script>
  </body>
</html>
	