<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre>
<?php var_dump($data);
echo $data['rebookData1'][1]->id;?>
</pre>

<?php require APPROOT . '/views/includes/foot.php'; ?>
