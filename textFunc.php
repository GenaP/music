<?php 
function textFunc( $str, $maxLen )
	{
	if ( mb_strlen( $str ) > $maxLen )
		{
		preg_match( '/^.{0,'.$maxLen.'} .*?/ui', $str, $match );
		return $match[0].' ';
		}
	else {
		return $str;
		}
	}
?>
