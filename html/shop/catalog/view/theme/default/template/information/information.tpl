<?=$header;?><?=$column_left;?><?=$column_right;?>
<div id="content"><?=$content_top;?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) {?>
    <?=$breadcrumb['separator'];?><a href="<?=$breadcrumb['href'];?>"><?=$breadcrumb['text'];?></a>
    <?php }?>
  </div>
  <h1><?=$heading_title;?></h1>
  <?=$description;?>
  <div class="buttons">
    <div class="right"><a href="<?=$continue;?>" class="button"><?=$button_continue;?></a></div>
  </div>
  <?=$content_bottom;?></div>
<?=$footer;?>