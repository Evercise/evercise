@foreach( $sellups as $key => $sellup)
	<td align="left" valign="top" class="columnsContainer" width="50%">
	    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateColumn">
	        <tr>
	            <td valign="top" class="leftColumnContainer">
	            	<table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnCaptionBlock">
					    <tbody class="mcnCaptionBlockOuter">
					        <tr>
					            <td class="mcnCaptionBlockInner" valign="top" style="padding:9px 9px 39px;">
					                

									<table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnCaptionBottomContent" width="false">
									    <tbody>
										    <tr>
										        <td class="mcnCaptionBottomImageContent" align="center" valign="top" style="padding:0 9px 9px 9px;">
										        
										            

										            {{ $sellup['image']}}
										            
										        
										        </td>
										    </tr>
										    <tr>
										        <td class="mcnTextContent" valign="top" style="padding:0 9px 0 9px;" width="264">
										            {{ $sellup['body'] }}
										        </td>
										    </tr>
										</tbody>
									</table>
					            </td>
					        </tr>
					    </tbody>
					</table>
				</td>
	        </tr>
	    </table>
	</td>

@endforeach