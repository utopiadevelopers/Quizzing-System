<?php

function print_val($array)
{
	foreach($array as $a)
	{
		echo $a.'<br />';
	}
}

function getSessionParam()
{
	if(sizeof($_SESSION)>0)
	{
		$message ='';
		foreach ($_SESSION as $key=>$val)
		{
			$message .= '$_SESSION[\''.$key.'\'] = '.$val.' <br />';
		}
		echo $message;
		die();
	}
}


function getSession($value = false)
{
	if(sizeof($_POST)>0)
	{
		$div = 5;
		if(sizeof($_POST)%$div ==0)
		{
			$div = 4;
		}
		$count = 1;
		$message = 'if(isset(';
		foreach ($_POST as $key=>$val)
		{
			$message .= '$_POST[\''.$key.'\'],';
			if($count++%$div==0)
			{
				$message .= '<br />';
			}
		}
		
		$message = substr($message, 0 ,strlen($message)-1).'))<br />{<br />';
		$count = 1;
		$message .= 'if(';
		foreach ($_POST as $key=>$val)
		{
			$message .= '!empty($_POST[\''.$key.'\']) &&';
			if($count++%$div==0)
			{
				$message .= '<br />';
			}
		}
		
		$message = substr($message, 0 ,strlen($message)-3).')<br />{<br/><br/> ';
		foreach ($_POST as $key=>$val)
		{
			if($value == true)
			{
				$message .= 'echo ';
			}
			$message .= '$'.$key.' = htmlentities($_POST[\''.$key.'\'])';
			if($value == true)
			{
				$message .= '.\'<code>&lt;br &#47;&gt;</code>\' ';
			}
			$message .= ';<br />';
		}
			
		
		$message .= '<br/><br/>// Variable ->  ';
		foreach ($_POST as $key=>$val)
		{
			$message .= '$'.$key.',';
		}
		$message .= '<br /><br />// Write Your Code Here<br/>}<br />}<br />';
		echo $message;
		
		die();
	}
}

?>