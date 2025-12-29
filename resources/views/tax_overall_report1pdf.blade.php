<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{$pagetitle}}</title>
<style>
    
              @page {
                margin-top: 20px;
                margin-bottom: 20px;
                margin-left: 0.4cm;
                margin-right: 0.4cm;
            }

            body,td,th {
  font-size: 10px;
  font-family: Arial, Helvetica, sans-serif;
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

</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
	
<div align="center">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="noborder_table">
    <tr>
      <td colspan="2"><div align="center" class="style1"><H4>{{$company[0]->Name}}</H4> </div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><strong>VAT Return </strong></div></td>
    </tr>
    <tr>
      <td width="50%">From <strong>{{dateformatman2(request()->StartDate)}}</strong> To <strong>{{dateformatman2(request()->EndDate)}}</strong></td>
    <td width="50%"><div align="right">DATED: {{date('d-m-Y')}}</div></td>
    
    </tr>
  </table>
    <?php 
            $SubTotal=0;
            $Tax=0;
            $GrandTotal=0;
             ?>
<br>
  <h5>VAT on Sales</h5>
  <table width=100%>
    <tr class="bg-light">
      <td width="10%" bgcolor="#CCCCCC"><div align="center"><strong>DATE</strong></div></td>
      <td width="10%" bgcolor="#CCCCCC"><div align="center"><strong>INVOICE#</strong></div></td>
      <td width="8%" bgcolor="#CCCCCC"><div align="center"><strong>REF # </strong></div></td>
      <td width="30%" bgcolor="#CCCCCC"><div align="center"><strong>CUSTOMER/SUPPLIER</strong></div></td>
      
      <td width="8%" bgcolor="#CCCCCC"><div align="center"><strong>SUBTOTAL</strong></div></td>
      <td width="9%" bgcolor="#CCCCCC"><div align="right"><strong>TAX </strong></div></td>
       <td width="9%" bgcolor="#CCCCCC"><div align="right"><strong>GRAND TOTAL </strong></div></td>
      
    </tr>
   @foreach ($output_vat as $key => $value)
    
   <?php  $SubTotal = $SubTotal + $value->SubTotal;
    $Tax = $Tax + $value->Tax;
    $GrandTotal = $GrandTotal + $value->GrandTotal;

    ?>
    
    <tr class="{{($value->PartyID!=NULL) ? 'text-success':'text-danger' }}">
      <td><div align="center">{{dateformatman($value->Date)}}</div></td>
      <td><div align="center">{{$value->InvoiceNo}}</div></td>
      <td><div align="center">{{$value->ReferenceNo}}</div></td>
      <td>{{($value->PartyID!=NULL) ? $value->PartyName:$value->SupplierName }}</td>
       <td><div align="center">{{number_format($value->SubTotal,2)}}</div></td>
      <td><div align="right">{{number_format($value->Tax,2)}}</div></td>
      <td><div align="right">{{number_format($value->GrandTotal,2)}}</div></td>
      
    </tr>
@endforeach
<tr>
      <td></td>
      <td></td>
      <td><strong></strong></td>
      <td><strong>Total [A1]</strong></td>
      <td><div align="center">{{number_format($SubTotal,2)}}</div></td>
      <td><div align="right">{{number_format($Tax,2)}}</div></td>
      <td><div align="right">{{number_format($GrandTotal,2)}}</div></td>
      
    </tr>
  </table>  

  <?php 
            $inputSubTotal=0;
            $inputTax=0;
            $inputGrandTotal=0;
             ?>



             <br>
  <h5>VAT on Expenses</h5>
  <table width=100%>
    <tr class="bg-light">
      <td width="10%" bgcolor="#CCCCCC"><div align="center"><strong>DATE</strong></div></td>
      <td width="10%" bgcolor="#CCCCCC"><div align="center"><strong>INVOICE#</strong></div></td>
      <td width="8%" bgcolor="#CCCCCC"><div align="center"><strong>REF # </strong></div></td>
      <td width="30%" bgcolor="#CCCCCC"><div align="center"><strong>CUSTOMER/SUPPLIER</strong></div></td>
      
      <td width="8%" bgcolor="#CCCCCC"><div align="center"><strong>SUBTOTAL</strong></div></td>
      <td width="9%" bgcolor="#CCCCCC"><div align="right"><strong>TAX </strong></div></td>
       <td width="9%" bgcolor="#CCCCCC"><div align="right"><strong>GRAND TOTAL </strong></div></td>
      
    </tr>
   @foreach ($input_vat as $key => $value)
    
   <?php  $inputSubTotal = $inputSubTotal + $value->SubTotal;
    $inputTax = $inputTax + $value->Tax;
    $inputGrandTotal = $inputGrandTotal + $value->GrandTotal;

    ?>
    
    <tr class="{{($value->PartyID!=NULL) ? 'text-success':'text-danger' }}">
      <td><div align="center">{{dateformatman($value->Date)}}</div></td>
      <td><div align="center">{{$value->InvoiceNo}}</div></td>
      <td><div align="center">{{$value->ReferenceNo}}</div></td>
      <td>{{($value->PartyID!=NULL) ? $value->PartyName:$value->SupplierName }}</td>
       <td><div align="center">{{number_format($value->SubTotal,2)}}</div></td>
      <td><div align="right">{{number_format($value->Tax,2)}}</div></td>
      <td><div align="right">{{number_format($value->GrandTotal,2)}}</div></td>
      
    </tr>
@endforeach
<tr>
      <td></td>
      <td></td>
      <td><strong></strong></td>
      <td><strong>Total [A2]</strong></td>
      <td><div align="center">{{number_format($inputSubTotal,2)}}</div></td>
      <td><div align="right">{{number_format($inputTax,2)}}</div></td>
      <td><div align="right">{{number_format($inputGrandTotal,2)}}</div></td>
      
    </tr>
  </table>   



 <br>
  <h5>Net VAT due</h5>
 

<table width=100%>
  <thead>
  <tr class="bg-light">
    <th>S.No</th>
    <th>Description</th>
    <th>VAT Amount</th>
  </tr>
</thead>
   <tr >
    <td>1.</td>
    <td>Total value of due tax for the period <span class="badge bg-info  " >  A1 </span></td>
    <td>{{number_format($Tax,2)}}</td>
  </tr>

    <tr>
    <td>2.</td>
    <td>Total value of recoverable tax for the period <span class="badge bg-info  " >  A2 </span></td>
    <td>{{number_format($inputTax,2)}}</td>
  </tr>


      <tr style="font-weight: bolder;">
    <td></td>
    <td>Net VAT payable (or reclaimable) for the period <span class="badge bg-info  " > A3 </span> = <span class="badge bg-info  " > A1 </span> - <span class="badge bg-info  " > A2 </span></td>
    <td>{{number_format($Tax-$inputTax,2)}}</td>
  </tr>
</table>

<br>
<br>
**Amount is displayed in your base currency <strong>AED</strong>
</div>
</body>
</html>