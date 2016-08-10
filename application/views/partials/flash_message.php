	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">

<div id="errors">
<?php
			$errors=$this->session->flashdata('errors');
			if(count($errors)>0)
			{
				foreach($errors as $error)
				{
					echo $error;
				}
			}		
?>
<?php
			$messages=$this->session->flashdata('messages');
			if(count($messages)>0)
			{
				foreach($this->session->flashdata('messages') as $message)
				{
					echo $message;
				}
			}
?>
</div>