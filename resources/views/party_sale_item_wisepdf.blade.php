<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Itemwise Sale by Saleman</title>
    <style type="text/css">
<!--
.style1 {font-size: 20px}
body,td,th {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}

  @page {
                margin-top: 0.5cm;
                margin-bottom: 0.5cm;
                margin-left: 0.5cm;
                margin-right: 0.5cm;
            }

      table {
    border-left: 0.01em solid #ccc;
    border-right: 0;
    border-top: 0.01em solid #ccc;
    border-bottom: 0;
    border-collapse: collapse;
}
table td,
table th {
    border-left: 0;
    border-right: 0.01em solid #ccc;
    border-top: 0;
    border-bottom: 0.01em solid #ccc;
}  

.noborder_table {
    border-left: 0;
    border-right: 0;
    border-top: 0.;
    border-bottom: 0;
    border-collapse: collapse;
}

.noborder_table  td,
.noborder_table   th {
    border-left: 0;
    border-right: 0;
    border-top: 0;
    border-bottom: 0;
}    


-->
    </style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
	

<div align="center">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="noborder_table">
    <tr>
      <td colspan="2"><div align="center" class="style1">
        <div align="center">{{session::get('CompanyName')}} </div>
      </div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><strong>Itemwise Sale Report  </strong></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="50%">From {{dateformatman2(request()->StartDate)}} to {{dateformatman2(request()->EndDate)}}</td>
      <td width="50%"><div align="right">DATED: {{date('d-m-Y')}}</div></td>
    </tr>
  </table>
</div>
 
<p></p>

<?php 

$GrandQty=0; 
$GrandGross=0;


?>

@foreach($city as $value)

 <?php 

$itemwise = DB::table('v_itemwise_sale')
->select( 'ItemName', DB::raw('Sum(Qty) as Qty, sum(Gross) as Gross'))
 ->where('City',$value->City)

->whereBetween('date',array(request()->StartDate,request()->EndDate))
->groupby('ItemName')
 ->get();

// dd($itemwise);

 ?>

<span style="color: red; font-size: 16px;">{{$value->City}}</span>


  <table width="100%"  >
    
<thead>
    <tr>
      <th width="6%" bgcolor="#CCCCCC"><div align="center"><strong>S.NO</strong></div></th>
       <th width="40%" bgcolor="#CCCCCC"><div align="left"><strong>NAME</strong></div></th>
      <th width="12%" bgcolor="#CCCCCC"><div align="center"><strong>Qty</strong></div></th>
        <th width="12%" bgcolor="#CCCCCC"><div align="center"><strong>Gross</strong></div></th>
    </tr>
</thead>
    
<?php 
$TotalGross = 0; 
$TotalQty = 0; 


?>
@foreach($itemwise as $key =>$value3)


<?php 
  $TotalGross = $TotalGross+$value3->Gross;
  $TotalQty = $TotalQty+$value3->Qty;
  
  $GrandQty = $GrandQty + $value3->Qty;
  $GrandGross = $GrandGross + $value3->Gross;



 ?>
 
<tr>

  <td align="center">{{$key+1}}</td>
   
  <td>{{$value3->ItemName}}</td>
  <td align="center">{{$value3->Qty}}</td>
   <td align="center">{{ number_format($value3->Gross)}}</td>
  </tr>
  

 
 

@endforeach


 

<tr style="border: 2px dotted  black; background-color: #e9e9e9;">

  <td></td>
   
  <td  align="left" style=" color: red;"><strong>Total</strong></td>
  <td align="center" style=" color: red;">{{ number_format($TotalQty)}}</td>
  
  <td align="center" style=" color: red;">{{ number_format($TotalGross)}}</td>
  </tr>

 

  </table>  


<div style="page-break-after: always;"></div>

@endforeach


<Br>
<strong>Total Qty</strong> :  {{ number_format($GrandQty)}} <br>

<strong>Total Gross</strong> : {{ number_format($GrandGross)}}
    


  


 
 
            
  
</body>
</html>