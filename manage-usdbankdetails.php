<?php 
	include("../codelibrary/connection.php"); 
	include("../codelibrary/functions.php"); 
	adminChklogin();
	$client_id=$_SESSION['sess_admin_id'];
	
if(isset($_GET['mode']) && ($_GET['mode']=='del'))
{
	mysql_query("delete from tbl_pdf where id='".$_GET['id']."'");
	$_SESSION['MESSAGE']="PDF Deleted Successfully.";
	header("location:manage-pdf.php");
	exit();
}
//Multiple CheckboxDelete
if(isset($_POST['delete']))
{
	$cnt=array();
	 $cnt=count($_POST['chkbox']);
 //print_r($_POST['chkbox']);die;
 for($i=0;$i<$cnt;$i++)
  {
     $del_id=$_POST['chkbox'][$i];
     mysql_query("delete from tbl_pdf where id='".$del_id."'");
  }
  $_SESSION['MESSAGE']="PDF(s) Deleted Successfully.";
	header("location:manage-pdf.php");
	exit();
}
if($_GET['mode']=='change_status')
	{
		if($_GET['status']==1)
		{
			$status=0;
		}
		else
		{
			$status=1;
		}
		mysql_query("UPDATE tbl_pdf SET status='".$status."' where id='".$_GET['id']."'");
		$_SESSION['MESSAGE']="Status Updated Successfully.";
		header("location:manage-pdf.php");
		exit();
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
        <title>Adminpage</title>
        <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
            WebFont.load({
                google: {
                    families: ['Alegreya+Sans:100,100i,300,300i,400,400i,500,500i,700,700i,800,800i,900,900i', 'Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', 'Open Sans']
                }
            });
			
        </script>
        <!-- START GLOBAL MANDATORY STYLE -->
        <link href="assets/dist/css/base.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- START PAGE LABEL PLUGINS -->
        <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
        <!-- START THEME LAYOUT STYLE -->
        <link href="assets/dist/css/component_ui.min.css" rel="stylesheet" type="text/css"/>
        <link id="defaultTheme" href="assets/dist/css/skins/skin-dark-1.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/dist/css/custom.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
             <?php include("includes/navigation.php"); ?>  
			<!-- /.Navigation -->
          <?php include("includes/sidebar.php"); ?>  
			<!-- /.Left Sidebar-->
            <!-- /.Right Sidebar -->
            <!-- /.Navbar  Static Side -->
            <div class="control-sidebar-bg"></div>
            <!-- Page Content -->
            <div id="page-wrapper">
                <!-- main content -->
                <div class="content">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
					<?php if($_SESSION['MESSAGE']!=""){?>
					<div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <strong>Success!</strong> <?php echo $_SESSION['MESSAGE'];$_SESSION['MESSAGE']="";?>
                                            </div>
						<?php }?>
                        <div class="header-icon">
                            <i class="pe-7s-box1"></i>
                        </div>
						
                        <div class="header-title">
                            <h1>Manage Bank Details<h1>
                        </div>
                    </div> <!-- /. Content Header (Page header) -->
					 <!-- /.main content -->
                            <div class="row">
									<div class="col-sm-12">
										<div class="panel panel-primary lobidisable">
											<div class="panel-heading">
												<div class="panel-title">
													</div>
											</div>
										<div class="panel-body">
										<br/>
											
											<br/>
										<form action="" method="POST">	
										<div class="table-responsive">
                                        <table id="dataTableExample1" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
													<th>Bank Name</th>
                                                    <th>Account No</th>                                                 
                                                    <th>Account Name</th>								
                                                    <th>Routing Number</th>								
                                                    								
                                                    <th>Address</th>								
                                                    <th>Action</th>								
                                                </tr>
                                            </thead>
											
											<tbody>
											<?php 
											
													$comp_qry=mysql_query("SELECT * FROM  tbl_USDbank  order by id asc");
												
											$numrows=mysql_num_rows($comp_qry);
											if($numrows >0)
											{
											$i=1;
											$chkbox=array();
											while($data=mysql_fetch_array($comp_qry))
											{
												?>
                                                <tr>
                                                    <td><?php echo $data["bankname"];?></td>
                                                    <td><?php echo $data["accountnumber"];?></td>
                                                    <td><?php echo $data["accountname"];?></td>
                                                    <td><?php echo $data["routingnumber"];?></td>
                                                    
                                                    <td><?php echo $data["address"];?></td>
                                                    
                                                    <td>
                                                        <a class="btn btn-info btn-sm" href="edit-usdbankdetails.php?id=<?php echo $data["id"];?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        </td>
                                                </tr>
											<?php $i++;} 
											}
											else
											{?>
											<tr>
                                                    <td colspan="7">No Record Exist</td>
                                                    
                                                    
                                                </tr>
											<?php } ?>
											</tbody>									
                                        </table>
										
                                    </div>
									</form>
                                </div>
							</div>
                        </div>
                    </div> <!-- /.main content -->
				</div><!-- /#page-wrapper -->
			</div><!-- /#wrapper -->
			
       <!-- START CORE PLUGINS -->
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/plugins/metisMenu/metisMenu.min.js" type="text/javascript"></script>
        <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
        <script src="assets/plugins/animsition/js/animsition.min.js" type="text/javascript"></script>
        <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
        <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- STRAT PAGE LABEL PLUGINS -->
        <script src="assets/plugins/datatables/dataTables.min.js" type="text/javascript"></script>
        <!-- START THEME LABEL SCRIPT -->
        <script src="assets/dist/js/app.min.js" type="text/javascript"></script>
        <script src="assets/dist/js/jQuery.style.switcher.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {

                "use strict"; // Start of use strict

                $('#dataTableExample1').DataTable({
                    "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                    "lengthMenu": [[6, 25, 50, -1], [6, 25, 50, "All"]],
                    "iDisplayLength": 6
                });

                $("#dataTableExample2").DataTable({
                    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    buttons: [
                        {extend: 'copy', className: 'btn-sm'},
                        {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'},
                        {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'},
                        {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                        {extend: 'print', className: 'btn-sm'}
                    ]
                });

            });
        </script>
    
	</body>
</html>
<script language="javascript">
    function asktodelete(path)
    {
        var ans=confirm("Do you really want to delete this?");
        if(ans==true)
        {
            document.location.href=path;
            return true;
        }
        else
        {
            return false;
        }
    }
</script>