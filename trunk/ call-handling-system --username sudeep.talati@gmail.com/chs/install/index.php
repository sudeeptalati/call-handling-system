
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="../css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="/stock_system/ims/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<link rel="stylesheet" type="text/css" href="../css/form.css" />
	
	
	<script type="text/javascript" src="/stock_system/ims/assets/fcebde54/jquery.js"></script>
<script type="text/javascript" src="/stock_system/ims/assets/fcebde54/jquery.yiiactiveform.js"></script>
<title>INSTALLATION</title>
</head>

<body>

<div class="container" id="page">
	
	<table><tr>
		<td style="margin:20px; vertical-align:middle;" ><div id="logo" >ISE&nbsp;Call Handling System</div></td>
		<td style="margin:20px; text-align:right;" >
	<img width="200" height="75" src="/stock_system/ims/images/company_logo.png" alt="ballpop" />	</td>
	<tr>
	</table>
	
	
	<div id="header">
		</div><!-- header -->

	<div id="mainmenu">
		<ul id="yw0">
<li><a href="/stock_system/ims/items/freeSearch">Items</a></li>
<li><a href="/stock_system/ims/items/inboundSearch">Inbound</a></li>
<li><a href="/stock_system/ims/items/outboundSearch">Outbound</a></li>
<li><a href="/stock_system/ims/suppliers/admin">Suppliers</a></li>
<li><a href="/stock_system/ims/purchaseOrder/admin">Purchase Order</a></li>
<li><a href="/stock_system/ims/itemOnOrder/admin">Items on Order</a></li>
<li ><a href="/stock_system/ims/site/login">Login</a></li>
</ul>	</div><!-- mainmenu -->


	<div class="container">
	<div id="content">
<p>Please fill out the following form to configure system to your needs:</p>

<div class="form">

<form id="install" action="install.php" enctype="multipart/form-data" method="post">
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<table>
	<tr>
		<td><h4>Company Details</h4>
		<small>This will be appearing on the purchase order send to supplier</small>
		</td>
		<td><h4>Email Configuration</h4>
		<small>This will be used for sending emails</small>
		</td>
	</tr>
	
	
	<tr><td>
		<div class="row">
				<label class="required">Company Name<span class="required">*</span></label>		
				<input name="company_name" id="company_name" type="text" size ='40'/>
		</div>
		<div class="row">
				<label class="required">Company Address<span class="required">*</span></label>		
				<textarea name="company_address" id="company_address" cols="35" rows="5"></textarea>
		</div>		
		<div class="row">
				<label class="required">Telephone<span class="required">*</span></label>		
				<input name="telephone" id="telephone" type="text" size ='40'/>
		</div>
				<div class="row">
				<label class="required">Mobile<span class="required">*</span></label>		
				<input name="mobile" id="mobile" type="text" size ='40'/>
		</div>
				<div class="row">
				<label class="required">Fax<span class="required">*</span></label>		
				<input name="fax" id="fax" type="text" size ='40'/>
		</div>
		
		
		</td>
		<td>
		<div class="row">
				<label class="required">E-mail<span class="required">*</span></label>		
				<input name="company_email" id="company_email" type="text" size ='40'/>
		</div>
		
		<div class="row">
				<label class="required">Outgoing Mail (SMTP) Server<span class="required">*</span></label>		
				<input name="smtp_host" id="smtp_host" type="text" size ='40'/>
		</div>
		<div class="row">
				<label class="required">User Name<span class="required">*</span></label>		
				<input name="smtp_username" id="smtp_username" type="text" size ='40'/>
		</div>
		<div class="row">
				<label class="required">Password<span class="required">*</span></label>		
				<input name="smtp_password" id="smtp_password" type="text" size ='40'/>
		</div>
		<div class="row">
				<label class="required">Port<span class="required">*</span></label>		
				<input name="smtp_port" id="smtp_port" type="text" size ='40'/>
		</div>
		
		<h4>Tax</h4>
		<div class="row">
				<label class="required">VAT(tax)<span class="required">*</span></label>		
				<input name="vat" id="vat" type="text" size ='40'/>
		</div>
		
		
		<h4>Upload your company Logo</h4>
		<small>Ideal size is 200 x 75 (in pixels)</small><br>
		<input type="file" name='logo_url'/>
		
		</td>		
		</tr>
		<tr><td colspan="2" style="text-align:center">
		
		
		<div class="row buttons">
		<input type="submit" name="finish" value="Finish" />	</div>
		
		</td></tr>		
		</table>
		

</form></div><!-- form -->
</div><!-- content -->
</div>

	<div id="footer">
	
	<table><tr><td>
	<img width="170" height="56.6" src="/stock_system/ims/images/rapport_stock_logo.png" alt="ballpop" />	</td>
	<td style="text-align:right;">
		Copyright &copy; 2012 by UK Whitegoods Ltd.<br/>
		All Rights Reserved.<br/>
		System Designed by Sudeep Talati, Kruthika &amp; Team
		
	
	</td></tr></table>
</div><!-- footer -->

</div><!-- page -->

</body>
</html>