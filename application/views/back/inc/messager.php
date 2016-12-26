<?php if(!empty($type_messager)){?>
<div class="note note-success" id="message-fadeout">
<?php 
	switch ( mb_strtolower( $type_messager ) )
	{
		/*
		 * THAO TAC THANH CONG
		 */
		case 'success' : echo 'Thao tác thành công.';break;
		/*
		 * THAO TAC THAT BAI
		 */
		case 'error' : echo 'Thao tác thất bại';
		break;				
		/*
		 * CANH BAO
		 */	
		case 'warning' : echo 'Không thể thao tác với dữ liệu này.';
		break;
		
		
	}

?>
</div>

<script language="javascript">	
	setTimeout( function(){
		$("div#message-fadeout").fadeOut();
	}, 5000);
</script>
<?php }?>



