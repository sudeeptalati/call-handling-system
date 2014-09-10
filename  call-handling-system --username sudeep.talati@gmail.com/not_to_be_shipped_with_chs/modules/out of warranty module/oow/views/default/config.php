<?php include('oow_menu.php'); ?>  

<style>
ul {
    background-color: #A7D6F0;
	padding:15px;
	 
}

</style>



<h2>How to Activate this module</h2>

<li>Open the Following File</li>
<ul><b><?php echo getcwd().'\protected\views\layouts\main.php';?></b></ul>
 


<li>Now find the following Code (should be at the bottom of the page at last lines)</li>
 
<ul>

 <b>
&lt;/body&gt;<br />
 
</b>
</ul>
 

<li>Now add the following Code before closing of body tag</li>
<ul>
<b>
 &lt;?php 
	<br>
	&nbsp; &nbsp;if (is_dir(Yii::getPathOfAlias('application.modules.oow.assets')))	
	<br>
	&nbsp;&nbsp;&nbsp;{
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;	$oow_url =	Yii::app()-&gt;getAssetManager()-&gt;publish(Yii::getPathOfAlias('application.modules.oow.assets'));	
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;	Yii::app()-&gt;getClientScript()-&gt;registerScriptFile($oow_url.'/js/oow.js', CClientScript::POS_END); 
	<br>
	&nbsp;&nbsp;&nbsp;	}
	<br>
 ?&gt;
</b>
</ul>
 
 

<li>It Should look as Following</li>	

<ul>
<b>
<b>
 &lt;?php 
	<br>
	&nbsp; &nbsp;if (is_dir(Yii::getPathOfAlias('application.modules.oow.assets')))	
	<br>
	&nbsp;&nbsp;&nbsp;{
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;	$oow_url =	Yii::app()-&gt;getAssetManager()-&gt;publish(Yii::getPathOfAlias('application.modules.oow.assets'));	
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;	Yii::app()-&gt;getClientScript()-&gt;registerScriptFile($oow_url.'/js/oow.js', CClientScript::POS_END); 
	<br>
	&nbsp;&nbsp;&nbsp;	}
	<br>
 ?&gt;
</b>	<br />
&lt;/body&gt;<br />
</b></ul>

 
<p>
Now whenever you will add a serial number in servicecall or customer page, which is out of warranty, it will flag up as serial number out of warranty.
</p>