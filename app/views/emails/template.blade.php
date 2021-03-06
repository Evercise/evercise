<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<!-- NAME: 1:2 COLUMN - BANDED -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title}}</title>
        
    <style type="text/css">
		body,#bodyTable,#bodyCell{
			height:100% !important;
			margin:0;
			padding:0;
			width:100% !important;
		}
		table{
			border-collapse:collapse;
		}
		img,a img{
			border:0;
			outline:none;
			text-decoration:none;
		}
		h1,h2,h3,h4,h5,h6{
			margin:0;
			padding:0;
		}

		p{
			margin:1em 0;
			padding:0;
		}
		a{
			word-wrap:break-word;
		}
		.ReadMsgBody{
			width:100%;
		}
		.ExternalClass{
			width:100%;
		}
		.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{
			line-height:100%;
		}
		table,td{
			mso-table-lspace:0pt;
			mso-table-rspace:0pt;
		}
		#outlook a{
			padding:0;
		}
		img{
			-ms-interpolation-mode:bicubic;
		}
		body,table,td,p,a,li,blockquote{
			-ms-text-size-adjust:100%;
			-webkit-text-size-adjust:100%;
		}
		#bodyCell{
			padding:0;
		}
		.mcnImage{
			vertical-align:bottom;
		}
		.mcnTextContent img{
			height:auto !important;
		}
		.columnsContainer{
			float: left;
		}
	/*
	 Page
	d style
	 Set the background color and top border for your email. You may want to choose colors that match your company's branding.
	*/
		body,#bodyTable{
			background-color:#F2F2F2;
		}
	/*
	 Page
	d style
	 Set the background color and top border for your email. You may want to choose colors that match your company's branding.
	*/
		#bodyCell{
			border-top:0;
		}

		h1{
			color:#606060 !important;
			display:block;
			font-family:Helvetica;
			font-size:40px;
			font-style:normal;
			font-weight:bold;
			line-height:125%;
			letter-spacing:-1px;
			margin:0;
			margin-bottom: 10px;
			text-align:left;
		}

		h2{
			color:#404040 !important;
			display:block;
			font-family:Helvetica;
			font-size:26px;
			font-style:normal;
			font-weight:bold;
			line-height:125%;
			letter-spacing:-.75px;
			margin:0;
			text-align:left;
		}

		h3{
			color:#606060 !important;
			display:block;
			font-family:Helvetica;
			font-size:18px;
			font-style:normal;
			font-weight:bold;
			line-height:125%;
			letter-spacing:-.5px;
			margin:0;
			text-align:left;
		}
	/*
	 Page
	 heading 4
	 Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
	@style heading 4
	*/
		h4{
			color:#808080 !important;
			display:block;
			font-family:Helvetica;
			font-size:16px;
			font-style:normal;
			font-weight:bold;
			line-height:125%;
			letter-spacing:normal;
			margin:0;
			text-align:left;
		}
	/*
	 Preheader
	 preheader style
	 Set the background color and borders for your email's preheader area.
	*/
		#templatePreheader{
			background-color:#FFFFFF;
			border-top:0;
			border-bottom:0;
		}
	/*
	 Preheader
	 preheader text
	 Set the styling for your email's preheader text. Choose a size and color that is easy to read.
	*/
		.preheaderContainer .mcnTextContent,.preheaderContainer .mcnTextContent p{
			color:#606060;
			font-family:Helvetica;
			font-size:11px;
			line-height:125%;
			text-align:left;
		}
	/*
	 Preheader
	preheader link
	 Set the styling for your email's header links. Choose a color that helps them stand out from your text.
	*/
		.preheaderContainer .mcnTextContent a{
			color:#606060;
			font-weight:normal;
			text-decoration:underline;
		}
	
		#templateHeader{
			background-color:#ffffff;
			border-top:0;
			border-bottom:0;
		}
	
		.headerContainer .mcnTextContent,.headerContainer .mcnTextContent p{
			color:#606060;
			font-family:Helvetica;
			font-size:15px;
			line-height:150%;
			text-align:left;
		}
	
		.headerContainer .mcnTextContent a{
			color:#6DC6DD;
			font-weight:normal;
			text-decoration:underline;
		}
	
		#templateBody{
			background-color:#FFFFFF;
			border-top:0;
			border-bottom:0;
		}

		.bodyContainer .mcnTextContent,.bodyContainer .mcnTextContent p{
			color:#606060;
			font-family:Helvetica;
			font-size:15px;
			line-height:150%;
			text-align:left;
		}
	
		.bodyContainer .mcnTextContent a{
			color:#6DC6DD;
			font-weight:normal;
			text-decoration:underline;
		}

		#templateColumns{
			background-color:#ffffff;
			border-top:0;
			border-bottom:0;
		}

		.leftColumnContainer .mcnTextContent,.leftColumnContainer .mcnTextContent p{
			color:#606060;
			font-family:Helvetica;
			font-size:15px;
			line-height:150%;
			text-align:left;
		}

		.leftColumnContainer .mcnTextContent a{
			color:#6DC6DD;
			font-weight:normal;
			text-decoration:underline;
		}

		.rightColumnContainer .mcnTextContent,.rightColumnContainer .mcnTextContent p{
			color:#606060;
			font-family:Helvetica;
			font-size:15px;
			line-height:150%;
			text-align:left;
		}

		.rightColumnContainer .mcnTextContent a{
			color:#6DC6DD;
			font-weight:normal;
			text-decoration:underline;
		}

		#templateFooter{
			background-color:#fff;
			border-top:0;
			border-bottom:0;
		}

		.footerContainer .mcnTextContent,.footerContainer .mcnTextContent p{
			color:#b3b3b3;
			font-family:Helvetica;
			font-size:12px;
			line-height:125%;
			text-align:left;
		}


		.footerContainer .mcnTextContent a{
			color:#606060;
			font-weight:normal;
			text-decoration:underline;
		}
		#templateFooter .templateContainer{
			background-color: #180b0b;
		}
	@media only screen and (max-width: 480px){
		body,table,td,p,a,li,blockquote{
			-webkit-text-size-adjust:none !important;
		}


		body{
			width:100% !important;
			min-width:100% !important;
		}


		table[class=mcnTextContentContainer]{
			width:100% !important;
		}


		table[class=mcnBoxedTextContentContainer]{
			width:100% !important;
		}


		table[class=mcpreview-image-uploader]{
			width:100% !important;
			display:none !important;
		}


		img[class=mcnImage]{
			width:100% !important;
		}


		table[class=mcnImageGroupContentContainer]{
			width:100% !important;
		}


		td[class=mcnImageGroupContent]{
			padding:9px !important;
		}


		td[class=mcnImageGroupBlockInner]{
			padding-bottom:0 !important;
			padding-top:0 !important;
		}


		tbody[class=mcnImageGroupBlockOuter]{
			padding-bottom:9px !important;
			padding-top:9px !important;
		}


		table[class=mcnCaptionTopContent],table[class=mcnCaptionBottomContent]{
			width:100% !important;
		}


		table[class=mcnCaptionLeftTextContentContainer],table[class=mcnCaptionRightTextContentContainer],table[class=mcnCaptionLeftImageContentContainer],table[class=mcnCaptionRightImageContentContainer],table[class=mcnImageCardLeftTextContentContainer],table[class=mcnImageCardRightTextContentContainer]{
			width:100% !important;
		}


		td[class=mcnImageCardLeftImageContent],td[class=mcnImageCardRightImageContent]{
			padding-right:18px !important;
			padding-left:18px !important;
			padding-bottom:0 !important;
		}


		td[class=mcnImageCardBottomImageContent]{
			padding-bottom:9px !important;
		}


		td[class=mcnImageCardTopImageContent]{
			padding-top:18px !important;
		}


		td[class=mcnImageCardLeftImageContent],td[class=mcnImageCardRightImageContent]{
			padding-right:18px !important;
			padding-left:18px !important;
			padding-bottom:0 !important;
		}


		td[class=mcnImageCardBottomImageContent]{
			padding-bottom:9px !important;
		}


		td[class=mcnImageCardTopImageContent]{
			padding-top:18px !important;
		}


		table[class=mcnCaptionLeftContentOuter] td[class=mcnTextContent],table[class=mcnCaptionRightContentOuter] td[class=mcnTextContent]{
			padding-top:9px !important;
		}


		td[class=mcnCaptionBlockInner] table[class=mcnCaptionTopContent]:last-child td[class=mcnTextContent]{
			padding-top:18px !important;
		}


		td[class=mcnBoxedTextContentColumn]{
			padding-left:18px !important;
			padding-right:18px !important;
		}


		td[class=columnsContainer]{
			display:block !important;
			max-width:600px !important;
			width:100% !important;
		}


		td[class=mcnTextContent]{
			padding-right:18px !important;
			padding-left:18px !important;
		}




		h1{
			font-size:24px !important;
			line-height:125% !important;
		}



		h2{
			font-size:20px !important;
			line-height:125% !important;
		}



		h3{
			font-size:18px !important;
			line-height:125% !important;
		}



		h4{
			font-size:16px !important;
			line-height:125% !important;
		}



		table[class=mcnBoxedTextContentContainer] td[class=mcnTextContent],td[class=mcnBoxedTextContentContainer] td[class=mcnTextContent] p{
			font-size:18px !important;
			line-height:125% !important;
		}



		table[id=templatePreheader]{
			display:block !important;
		}



		td[class=preheaderContainer] td[class=mcnTextContent],td[class=preheaderContainer] td[class=mcnTextContent] p{
			font-size:14px !important;
			line-height:115% !important;
		}



		td[class=headerContainer] td[class=mcnTextContent],td[class=headerContainer] td[class=mcnTextContent] p{
			font-size:18px !important;
			line-height:125% !important;
		}


   
		td[class=bodyContainer] td[class=mcnTextContent],td[class=bodyContainer] td[class=mcnTextContent] p{
			font-size:18px !important;
			line-height:125% !important;
		}


		td[class=leftColumnContainer] td[class=mcnTextContent],td[class=leftColumnContainer] td[class=mcnTextContent] p{
			font-size:18px !important;
			line-height:125% !important;
		}



		td[class=rightColumnContainer] td[class=mcnTextContent],td[class=rightColumnContainer] td[class=mcnTextContent] p{
			font-size:18px !important;
			line-height:125% !important;
		}



		td[class=footerContainer] td[class=mcnTextContent],td[class=footerContainer] td[class=mcnTextContent] p{
			font-size:14px !important;
			line-height:115% !important;
		}


		td[class=footerContainer] a[class=utilityLink]{
			display:block !important;
		}

}</style></head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
                <tr>
                    <td align="center" valign="top" id="bodyCell">
                        <!-- BEGIN TEMPLATE // -->
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="center" valign="top">
                                    <!-- BEGIN PREHEADER // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templatePreheader">
                                        <tr>
                                        	<td align="center" valign="top">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="templateContainer">
                                                    <tr>
                                                        <td valign="top" class="preheaderContainer" style="padding-top:9px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner">
                
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="366" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:9px; padding-left:18px; padding-bottom:9px; padding-right:0;">
                        
                            {{ $title}}
                        </td>
                    </tr>
                </tbody>
                
            </td>
        </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </table>
                                            </td>                                            
                                        </tr>
                                    </table>
                                    <!-- // END PREHEADER -->
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                    <!-- BEGIN HEADER // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">
                                        <tr>
                                            <td align="center" valign="top">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="templateContainer">
                                                    <tr>
                                                        <td valign="top" class="headerContainer" style="padding-top:10px; padding-bottom:10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:0px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 0px; padding-left: 0px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                
                                    
                                       <a href="http://www.evercise.com" target="_blank" style="color: #336699;font-weight: normal;text-decoration: underline;">{{HTML::image('img/top_banner.jpg', 'Everybody exercise', array('width' => 600, 'id' => 'banner'));}}</a>
                                    
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END HEADER -->
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                    <!-- BEGIN BODY // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">
                                        <tr>
                                            <td align="center" valign="top">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="templateContainer">
                                                    <tr>
                                                        <td valign="top" class="bodyContainer" style="padding-top:10px; padding-bottom:10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock">
														    <tbody class="mcnTextBlockOuter">
														        <tr>
														            <td valign="top" class="mcnTextBlockInner">
														                
														                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="mcnTextContentContainer">
														                    <tbody>
														                    	<tr>
														                        
															                        <td valign="top" class="mcnTextContent" style="padding: 9px 18px; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
															                        
															                            <h1>{{ $mainHeader}}</h1>

																						<h3>{{ $subHeader}}</h3>

																						<p> {{ $body }}</p>

																						@if(isset( $link ))
																							<p>{{ isset($linkLabel) ? $linkLabel : null}} {{ $link }}</p>
																						@endif
																						

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
                                        </tr>
                                    </table>
                                    <!-- // END BODY -->
                                </td>
                            </tr>
                            @if(isset($sellups))
	                            <tr>
	                                <td align="center" valign="top">
	                                    <!-- BEGIN COLUMNS // -->
	                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateColumns">
	                                        <tr>
	                                            <td align="center" valign="top">
	                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="templateContainer">


	                                                   @include('emails.sellupBlock' , ['sellups' => $sellups])

	                                                </table>
	                                            </td>
	                                        </tr>
	                                    </table>
	                                    <!-- // END COLUMNS -->
	                                </td>
	                            </tr>
                            @endif
                            <tr>
                                <td align="center" valign="top">
                                    <!-- BEGIN signiture // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">
                                        <tr>
                                            <td align="center" valign="top">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="templateContainer">
                                                    <tr>
                                                        <td valign="top" class="bodyContainer" style="padding-top:10px; padding-bottom:10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock">
														    <tbody class="mcnTextBlockOuter">
														        <tr>
														            <td valign="top" class="mcnTextBlockInner">
														                
														                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="mcnTextContentContainer">
														                    <tbody>
														                    	<tr>
														                        
															                        <td valign="top" class="mcnTextContent" style="padding: 9px 18px; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">

															                        	<p>Feel free to call or email us with any questions. We&apos;re always happy to help.</p>
															                            <p><i>phone:</i> +44(0)2033 266216</p>
															                            <p><i>email: </i> contact@evercise.com</p>
																						<p>Best,</p>
																						<p>The evercise team</p>
																						{{ HTML::linkRoute('home', 'evercise.com'); }}

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
                                        </tr>
                                    </table>
                                    <!-- // END signiture -->
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                    <!-- BEGIN FOOTER // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter">
                                        <tr>
                                            <td align="center" valign="top">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="templateContainer">
                                                    <tr>
                                                        <td valign="top" class="footerContainer" style="padding-top:10px; padding-bottom:10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner">
                
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="mcnTextContentContainer">
                    <tbody><tr>
                        
                        <td valign="top" class="mcnTextContent" style="padding-top:9px; padding-right: 18px; padding-bottom: 9px; padding-left: 18px;">
                        
                            
                        </td>
                    </tr>
                </tbody></table>
                
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowBlock">
    <tbody class="mcnFollowBlockOuter">
        <tr>
        	<td valign="top" class="mcnTextContent" style="padding-top:33px; padding-left:18px; padding-bottom:9px; padding-right:0;">                        
                Copyright © 2014 Qin Technology, All rights reserved
            </td>
            <td align="center" valign="top" style="padding: 0 9px 9px" class="mcnFollowBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentContainer">
    <tbody><tr>
        <td align="right" style="padding-left:9px;padding-right:9px;">
            <table border="0" cellpadding="0" cellspacing="0" class="mcnFollowContent">
                <tbody><tr>
                    <td align="right" valign="top" style="padding-top:9px; padding-right:9px; padding-left:9px;">
						<table border="0" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td valign="top">
			                        
			                            
			                            
			                                <table align="left" border="0" cellpadding="0" cellspacing="0">
			                                    <tbody><tr>
			                                        <td valign="top" style="padding-right:0px; padding-bottom:9px;" class="mcnFollowContentItemContainer">
			                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
			                                                <tbody><tr>
			                                                    <td align="left" valign="middle" style="padding-top:5px; padding-right:0px; padding-bottom:5px; padding-left:9px;">
			                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
			                                                            <tbody><tr>
			                                                                
			                                                                    <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
			                                                                       <a target="_blank" href="https://www.facebook.com/evercise" style="margin: 0px 5px 0px 0px">
					        		    {{HTML::image('img/facebook.png', 'facebook', array('id' => 'facebook'));}}
					       		 	</a>
			                                                                    </td>
			                                                                
			                                                                
			                                                            </tr>
			                                                        </tbody></table>
			                                                    </td>
			                                                </tr>
			                                            </tbody></table>
			                                        </td>
			                                    </tr>
			                                </tbody></table>
			                            
								<!--[if gte mso 6]>
								</td>
						    	<td align="left" valign="top">
								<![endif]-->
			                        
			                            
			                            
			                                <table align="left" border="0" cellpadding="0" cellspacing="0">
			                                    <tbody><tr>
			                                        <td valign="top" style="padding-right:0px; padding-bottom:9px;" class="mcnFollowContentItemContainer">
			                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
			                                                <tbody><tr>
			                                                    <td align="left" valign="middle" style="padding-top:5px; padding-right:9px; padding-bottom:5px; padding-left:9px;">
			                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
			                                                            <tbody><tr>
			                                                                
			                                                                    <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
			                                                                        <a target="_blank" href="https://twitter.com/LetsEvercise"  style="margin: 0px 5px 0px 0px">
					        		    {{HTML::image('img/twitter.png', 'twitter', array('id' => 'twitter'));}}
					        		</a>
			                                                                    </td>
			                                                                
			                                                                
			                                                            </tr>
			                                                        </tbody></table>
			                                                    </td>
			                                                </tr>
			                                            </tbody></table>
			                                        </td>
			                                    </tr>
			                                </tbody></table>
			                            
								<!--[if gte mso 6]>
								</td>
						    	<td align="left" valign="top">
								<![endif]-->
			                        
			                            
			                            
			                                <table align="left" border="0" cellpadding="0" cellspacing="0">
			                                    <tbody><tr>
			                                        <td valign="top" style="padding-right:0; padding-bottom:9px;" class="mcnFollowContentItemContainer">
			                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
			                                                <tbody><tr>
			                                                    <td align="left" valign="middle" style="padding-top:5px; padding-right:0px; padding-bottom:5px; padding-left:0px;">
			                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
			                                                            <tbody><tr>
			                                                                
			                                                                    <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
			                                                                        <a target="_blank" href="https://google.com/+Evercisefitness">
					        		    {{HTML::image('img/googleplus.png', 'googleplus', array('id' => 'googleplus'));}}
					        		</a>
			                                                                    </td>
			                                                                
			                                                                
			                                                            </tr>
			                                                        </tbody></table>
			                                                    </td>
			                                                </tr>
			                                            </tbody></table>
			                                        </td>
			                                    </tr>
			                                </tbody></table>
			                            
								<!--[if gte mso 6]>
								</td>
						    	<td align="left" valign="top">
								<![endif]-->
			                        
								</td>
							</tr>
						</tbody></table>
                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

            </td>
        </tr>
    </tbody>
</table>
                
            </td>
        </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END FOOTER -->
                                </td>
                            </tr>
                        </table>
                        <!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>