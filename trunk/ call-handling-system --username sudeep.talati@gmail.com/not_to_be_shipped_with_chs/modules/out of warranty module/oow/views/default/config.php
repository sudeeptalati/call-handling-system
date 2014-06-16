<?php include('oow_menu.php'); ?>  

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
&lt;script src=&quot;&lt;?php echo Yii::app()-&gt;request-&gt;baseUrl; ?&gt;/js/oow/oow.js&quot;&gt;&lt;/script&gt;
</b>
</ul>
 
 

<li>It Should look as Following</li>	

<ul>
<b>
&lt;script src=&quot;&lt;?php echo Yii::app()-&gt;request-&gt;baseUrl; ?&gt;/js/oow/oow.js&quot;&gt;&lt;/script&gt;<br />
&lt;/body&gt;<br />
</b></ul>

<hr>
<p>
Now whenever you will add a serial number in servicecall or customer page, which is out of warranty, it will flag up as serial number out of warranty.
</p>