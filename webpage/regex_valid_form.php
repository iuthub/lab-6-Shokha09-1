<?php

	$pattern="";
	$text="";
	$replaceText="";
	$replacedText="";

	$match="Not checked yet.";

if ($_SERVER["REQUEST_METHOD"]=="POST")
{
	$pattern=$_POST["pattern"];
	$text=$_POST["text"];

	if(preg_match($pattern, $text))
	{
	    $match="Match!";
        $removeWhitespace=preg_replace($pattern, $replacedText,$text); // '/\s+/' for removing whitespace
        $removeNonNumeric=preg_replace($pattern,$replacedText,$text); // /[^0-9,.]/ for removing non numeric
        $removeNewLine=preg_replace($pattern,$replacedText,trim($text));  // /\s+/ and trim() for removing
        $extractText=preg_match($pattern, $text, $match1); //   #\[(.*?)\]#
	} else {
	    $match="Does not match!";
	}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Valid Form</title>
</head>
<body>
	<form action="regex_valid_form.php" method="post">
		<dl>
			<dt>Pattern</dt>
			<dd><input type="text" name="pattern" value="<?= $pattern ?>"></dd>

			<dt>Text</dt>
			<dd><input type="text" name="text" value="<?= $text ?>"></dd>


			<dt>Output Text</dt>
			<dd><?=	$match ?></dd>
            <?php if($pattern=='/\s+/'){ ?>
                <dt>Removed whitespace</dt>
                <dd><?=$removeWhitespace ?></dd>
            <?php } ?>
            <?php if($pattern=='/[^0-9,.]/'){ ?>
                <dt>Removed nonnumeric</dt>
                <dd><?= $removeNonNumeric ?></dd>
            <?php } ?>
            <?php if($pattern=='/\s+/'){ ?>
                <dt>Removed new lines</dt>
                <dd><?=$removeNewLine ?></dd>
            <?php } ?>
            <?php if($pattern=='#\[(.*?)\]#'){ ?>
                <dt>Extract text</dt>
                <dd><?=$match1[1] ?></dd>
            <?php } ?>


            <dt>&nbsp;</dt>
			<dd><input type="submit" value="Check"></dd>
		</dl>

	</form>
</body>
</html>
