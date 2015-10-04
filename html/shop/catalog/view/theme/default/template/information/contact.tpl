<?=$header;?><?=$column_left;?><?=$column_right;?>
<div id="content"><?=$content_top;?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) {?>
    <?=$breadcrumb['separator'];?><a href="<?=$breadcrumb['href'];?>"><?=$breadcrumb['text'];?></a>
    <?php }?>
  </div>
  <h1><?=$heading_title;?></h1>
  <form action="<?=$action;?>" method="post" enctype="multipart/form-data">
    <h2><?=$text_location;?></h2>
    <div class="contact-info">
      <div class="content"><div class="left"><b><?=$text_address;?></b><br />
        <?=$store;?><br />
        <?=$address;?></div>
      <div class="right">
        <?php if ($telephone) {?>
        <b><?=$text_telephone;?></b><br />
        <?=$telephone;?><br />
        <br />
        <?php }?>
        <?php if ($fax) {?>
        <b><?=$text_fax;?></b><br />
        <?=$fax;?>
        <?php }?>
      </div>
    </div>
    </div>
    <h2><?=$text_contact;?></h2>
    <div class="content">
    <b><?=$entry_name;?></b><br />
    <input type="text" name="name" value="<?=$name;?>" />
    <br />
    <?php if ($error_name) {?>
    <span class="error"><?=$error_name;?></span>
    <?php }?>
    <br />
    <b><?=$entry_email;?></b><br />
    <input type="text" name="email" value="<?=$email;?>" />
    <br />
    <?php if ($error_email) {?>
    <span class="error"><?=$error_email;?></span>
    <?php }?>
    <br />
    <b><?=$entry_enquiry;?></b><br />
    <textarea name="enquiry" cols="40" rows="10" style="width: 99%;"><?=$enquiry;?></textarea>
    <br />
    <?php if ($error_enquiry) {?>
    <span class="error"><?=$error_enquiry;?></span>
    <?php }?>
    <br />
    <b><?=$entry_captcha;?></b><br />
    <input type="text" name="captcha" value="<?=$captcha;?>" />
    <br />
    <img src="index.php?route=information/contact/captcha" alt="" />
    <?php if ($error_captcha) {?>
    <span class="error"><?=$error_captcha;?></span>
    <?php }?>
    </div>
    <div class="buttons">
      <div class="right"><input type="submit" value="<?=$button_continue;?>" class="button" /></div>
    </div>
  </form>
  <?=$content_bottom;?></div>
<?=$footer;?>