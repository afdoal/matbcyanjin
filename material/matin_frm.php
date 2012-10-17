<?php
require_once "../models/abspath.php";
require_once "sessions.php";
require_once "pdocon.php";

$NmMenu=$_REQUEST["NmMenu"];
$TpBarang=$_REQUEST["TpBarang"];

$q="SELECT matin_id FROM mat_inchdr ORDER BY matin_id DESC";
$run = $pdo->query($q);
$rs = $run->fetchAll(PDO::FETCH_ASSOC);
if ($rs){
	$newId=$rs[0]['matin_id']+1;
} else {
	$newId="1";				
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>themes/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>themes/icon.css">
<link type="text/css" href="<?php echo $basedir; ?>themes/redmond/jquery-ui-1.8.4.custom.css" rel="Stylesheet" />
<style type="text/css">
.hdr {
	padding-bottom:28px;
}
.kolom1 {
	float:left;
	width:80px;	
}
.kolom2 {
	float:left;
	width:120px;	
}
.kolom3 {
	float:left;
	width:100px;	
}
.kolom4 {
	float:left;
	width:160px;	
}
.kolom5 {
	float:left;
	width:100px;	
}
.kolom6 {
	float:left;
	width:130px;	
	/*border:1px solid #000;*/
}

.fkolom1 {
	float:left;
	width:130px;	
}
.fkolom2 {
	float:left;
	width:180px;
}
.fkolom3 {
	float:left;
	width:110px;	
}
.fkolom4 {
	float:left;
	width:200px;
}
</style>

<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir ?>models/js/jquery-ui-1.8.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/jquery.grid.min.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/jquery.edatagrid.js"></script>
<script type="text/javascript" src="<?php echo $basedir; ?>models/js/global.format.js">disableSelection(document.body); 
</script>
<?php 
require_once "matin_frm.mjs.php";
require_once "matin_frm.cjs.php";
?>
</head>
<body oncontextmenu="return false;" leftmargin="20" rightmargin="20" topmargin="15" bottommargin="20"> 
<div id="w" style="padding:10px">      
<form id="fm" method="post" onSubmit="return false">
	<input type="hidden" id="aksi" name="aksi">
    <div class="hdr">
      <span class="kolom1">Incoming  No. </span><span class="kolom2">
      <input type="hidden" id="matin_id" name="matin_id">
      <input type="text" id="matin_no" name="matin_no" style="width:100px">    
      </span>
      <span class="kolom3">Incoming Type </span>
      <span class="kolom4">
      <select name="matin_type" id="matin_type" style="width:100px">
        <option value=""></option>
        <?php
            $run = $pdo->query("SELECT * FROM mst_in_type ORDER BY matin_type");
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['matin_type']."\">".$r['matin_name']."</option>";
        ?>
      </select>  
      </span>
      <span class="kolom5">Incoming Date</span>
      <span class="kolom6">
      <input type="hidden" id="po_id" name="po_id">
      <input type="text" id="matin_date" name="matin_date" class="easyui-datebox" required="true" maxlength="10" tabindex="10" style="width:100px">
      </span>
    </div>    
    <div class="hdr">
      <span class="kolom1">PO No.</span>
      <span class="kolom2">
      <input type="text" id="po_no" name="po_no" style="width:100px">
      </span>
      <span class="kolom3">Seller</span>
      <span class="kolom4">
      <select name="supplier" id="supplier" style="width:150px">
        <option value=""></option>
        <?php
            $run = $pdo->query("SELECT NmPrshn FROM mst_perusahaan WHERE TpPrshn='s' ORDER BY NmPrshn");
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['NmPrshn']."\">".$r['NmPrshn']."</option>";
        ?>
      </select>
      </span>
      <span class="kolom5">Seller DO No.</span>
      <span class="kolom6">
      <input type="text" id="supl_do" name="supl_do" style="width:100px">
      </span>      
    </div>
    <div class="hdr">
      <span class="kolom1">Seller Inv. No.</span>
      <span class="kolom2">
      <input type="text" id="supl_inv" name="supl_inv" style="width:100px">
      </span>
      <span class="kolom3">Currency</span>
      <span class="kolom4">
      <select name="currency" id="currency" style="width:80px">
        <option value=""></option>
        <?php
            $run = $pdo->query("SELECT * FROM valuta WHERE KdVal IN ('Rp','USD') ORDER BY KdVal");
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['KdVal']."\">".$r['KdVal']."</option>";
        ?>
      </select>
      </span>
      <span class="kolom5">Jenis BC</span>
      <span class="kolom6">
      <select name="KdJnsDok" id="KdJnsDok" style="width:80px">
        <option value=""></option>
        <?php
            $run = $pdo->query("SELECT * FROM jenis_dok WHERE KdJnsDok IN ('5','6') ORDER BY KdJnsDok");
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['KdJnsDok']."\">".$r['UrJnsDok']."</option>";
        ?>
      </select>
      </span>
    </div>  
    <!--
    <div class="hdr">
      <span class="kolom1">
        Total Qty.
      </span>
      <span class="kolom2">
      <input type="text" id="tot_qty" name="tot_qty" style="width:100px" readonly>
      </span>
      <span class="kolom3"> Total Amount</span>
      <span class="kolom4">
      <input type="text" id="tot_amount" name="tot_amount" style="width:100px" readonly></span>
    </div>-->

<div id="toolbar1">  
    <a href="javascript:void(0)" id="tl1Tbh" class="easyui-linkbutton" iconCls="icon-add" plain="true" title="Add">Add</a>  
    <a href="javascript:void(0)" id="tl1Ubh" class="easyui-linkbutton" iconCls="icon-edit" plain="true" title="Edit">Edit</a> 
    <a href="javascript:void(0)" id="tl1Hps" class="easyui-linkbutton" iconCls="icon-remove" plain="true" title="Delete">Delete</a>
    <a href="javascript:void(0)" id="tl1Btl" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" title="Cancel">Cancel</a>  
    <a href="javascript:void(0)" id="tl1Sim" class="easyui-linkbutton" iconCls="icon-save" plain="true" title="Save">Save</a> 
    <a href="javascript:void(0)" id="tl1Cri" class="easyui-linkbutton" iconCls="icon-search" plain="true" title="Search">Search</a>  
</div>

<table id="dg" singleSelect="true"></table> 
<div id="toolbar2">  
    <a href="javascript:void(0)" id="tl2Tbh" class="easyui-linkbutton" iconCls="icon-add" plain="true" title="Tambah">Add</a>  
    <a href="javascript:void(0)" id="tl2Ubh" class="easyui-linkbutton" iconCls="icon-edit" plain="true" title="Hapus">Edit</a> 
    <a href="javascript:void(0)" id="tl2Hps" class="easyui-linkbutton" iconCls="icon-remove" plain="true" title="Hapus">Delete</a>  
</div>        
<div class="hdr" style="padding-top:10px">
 Notes: 
  <textarea id="notes" name="notes" style="width:700px; height:70px;"></textarea>
</div>
  
<input type="submit" id="btnSubmit1" name="btnSubmit1" style="display:none">
</form>     

<div id="dlg" style="padding:10px">	    
	<form name="fm2" id="fm2" method="post" onSubmit="return false">
 	<table>
    <tr>
      <td width="115">Mat. Code</td>
      <td width="319"><input name="KdBarang3" type="hidden" id="KdBarang3" class="easyui-validatebox" value=""><input id="KdBarang2" name="KdBarang2" type="text" style="width:100px"></td>
    </tr>
    <tr>
      <td>Desc.</td>
      <td><input name="NmBarang2" type="text" id="NmBarang2" style="width:150px" readonly></td>
    </tr>
    <tr>
      <td>Unit</td>
      <td>
        <select name="Sat2" id="Sat2" style="width:50px">
          <option value=""></option>
          <?php
            $run = $pdo->query('SELECT KdSat,UrSat FROM satuan ORDER BY KdSat');
            $rs = $run->fetchAll(PDO::FETCH_ASSOC);
            foreach($rs as $r)
                echo "<option value=\"".$r['KdSat']."\">".$r['KdSat']." - ".$r['UrSat']."</option>";
        ?>
          </select>
      </td>
    </tr>
    <tr>
      <td>Quantity</td>
      <td><input name="qty" type="text" id="qty" value="" style="width:100px"></td>
    </tr>
    <tr>
      <td>Price</td>
      <td><input name="price" type="text" id="price" value="" style="width:100px"></td>
    </tr>
    <tr>
      <td>Amount</td>
      <td><input name="amount" type="text" id="amount" value="" style="width:100px" readonly></td>
    </tr>
    </table>
    <input type="submit" id="btnSubmit2" name="btnSubmit2" style="display:none">
    </form>
    <div id="dlg-buttons">
        <a href="#" id="tl2Sim" class="easyui-linkbutton" iconCls="icon-ok">Save</a>
        <a href="#" id="tl2Ubh2" class="easyui-linkbutton" iconCls="icon-ok">Update</a>
        <a href="javascript:void(0)" id="tl2Reset" class="easyui-linkbutton" iconCls="icon-cancel">Reset</a>
    </div>
</div>

<div id="wCari"><table id="dgCari" singleSelect="true"></table></div>
<div id="toolCari">  
    Search
    <select id="pilcari" name="pilcari">
    	<option value="matin_no">Incoming No.</option>
        <option value="matin_date">Incoming Date</option>
        <option value="matin_name">Incoming Type</option>
    </select> 
    <input type="text" id="txtcari" name="txtcari" style="width:100px">
    <a href="#" id="dtlCri" class="easyui-linkbutton" iconCls="icon-search"></a>
</div>
           
</div> <!-- akhir div w -->
</body> 
</html>