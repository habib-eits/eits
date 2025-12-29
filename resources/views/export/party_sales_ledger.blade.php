          <?php 
            $DrTotal=0;
            $CrTotal=0;
          
           ?>

       <table width="100%" border="1">
          
          <tr>
          <th bgcolor="#CCCCCC"><strong>VHNO</strong></th>
          <th bgcolor="#CCCCCC"><strong>DATE</strong></th>
          <th bgcolor="#CCCCCC"><strong>C.O</strong></th>
          <th bgcolor="#CCCCCC"><strong>Description</strong></th>
          <th bgcolor="#CCCCCC"><strong>DR</strong></th>
          <th bgcolor="#CCCCCC"><strong>CR</strong></th>
          <th bgcolor="#CCCCCC"><strong>Balance</strong></th>
          </tr>
          
          <tr> 

          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td> 
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;">Opending Balance</td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black;"></td>
          <td style="border: 1px solid black; color: red; font-weight: bolder;" align="right">{{$sql[0]->Balance}}</td>
          </tr>

      @if(!$journal->isEmpty())
          @foreach ($journal as $key =>$value)
        <?php 
        $invoice_master = DB::table('invoice_master')->where('InvoiceMasterID',$value->InvoiceMasterID)->get();
         ?>
           <tr valign="top">
           <td style="border: 1px solid black;" valign="top">{{$value->VHNO}}  </td>
           <td style="border: 1px solid black;" valign="top">{{dateformatman($value->Date)}}</td>
           <td style="border: 1px solid black;" valign="top">{{(count($invoice_master)>0 ? $invoice_master[0]->Subject : '')}}</td>
           <td align="left" style="border: 1px solid black;  " valign="top" >{{$value->Narration}}</td>
           <td  style="border: 1px solid black;" valign="top" align="right"> {{($value->Dr==0) ? '' : number_format($value->Dr,2)}}</td>
           <td style="border: 1px solid black;" valign="top" align="right" > {{($value->Cr==0) ? '' : number_format($value->Cr,2)}}</td>
           <td style="border: 1px solid black;" valign="top" align="right" >
               
                
                 <?php 

if(!isset($balance)) { 

             $balance  =  $sql[0]->Balance + ($value->Dr-$value->Cr);
             $DrTotal = $DrTotal+$value->Dr;
             $CrTotal = $CrTotal+$value->Cr;
             echo number_format($balance,2);

}
else
{
  $balance = $balance + ($value->Dr-$value->Cr);
  $DrTotal = $DrTotal+$value->Dr;
             $CrTotal = $CrTotal+$value->Cr;
  echo number_format($balance,2);
}
              ?>
             {{($balance>0) ? "DR" : "CR"}}  </td>
           </tr>






  @if((substr($value->VHNO,0,3)=='TAX') || (substr($value->VHNO,0,3)=='INV'))
<?php 

$invoice_detail = DB::table('v_invoice_detail')->where('InvoiceMasterID',$value->InvoiceMasterID)->get();

?>

      @if(!$invoice_detail->isEmpty())
 
             @foreach ($invoice_detail as $key =>$value1)
                  <tr>
  <td style="font-size: 8pt; border: 1px dashed #545454;"></td>
  <td style="font-size: 8pt; border: 1px dashed #545454;"></td>
  <td style="font-size: 8pt; border: 1px dashed #545454;"></td>
  <td align="left" style="font-size: 8pt; border: 1px dashed #BBBBBB; color: red;"  >{{$value1->ItemName}} {{$value1->Qty}} Qty x {{$value1->Rate}} Rate ={{$value1->Total}}</td>
      <td style="border: 1px dashed #545454;"></td>
  <td style="font-size: 8pt; border: 1px dashed #545454;"></td>
  <td style="font-size: 8pt; border: 1px dashed #545454;"></td>
</tr>              
                 
                  
                 @endforeach

                       
    @endif


    @endif

           @endforeach 

          <tr  >
              
           <td style="border: 1px double black; background-color: #CCCCCC;"></td>
           <td style="border: 1px double black; background-color: #CCCCCC;"></td>
           <td style="border: 1px double black; background-color: #CCCCCC;"></td>
           <td style="border: 1px double black; background-color: #CCCCCC;" align="center"><strong>TOTAL</strong></td>
           <td style="border: 1px double black; background-color: #CCCCCC;" align="right" ><strong>{{number_format($DrTotal,2)}}</strong></td>
           <td style="border: 1px double black; background-color: #CCCCCC;" align="right"><strong>{{number_format($CrTotal,2)}}</strong></td>
           <td style="border: 1px double black; background-color: #CCCCCC;" align="right"><strong>{{number_format(($DrTotal+$sql[0]->Balance)-$CrTotal,2)}}</strong></td>
          </tr>
           

           @else
             <tr>
              
           <td colspan="7" align="center" style="border: 1px double black; background-color: #CCCCCC;"><strong>No Date Found</strong></td>
        
          </tr>
           @endif
       
 </table>