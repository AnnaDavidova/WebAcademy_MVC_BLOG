<form method="post">

    <p>Post Title:</p>
    <input name="name" type="text" value="<?=$name;?>">
    <br>
    <p>Post Author:</p>
    <input name="author" type="text" value="<?=$author;?>">
    <br>
    <p>Post Text:</p>
    <textarea name="text" cols="60" rows="30">
        <?=$text;?>
    </textarea>
    <hr>
    <input type="submit" value="Save">
</form>