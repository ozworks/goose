<?php
if(!defined("GOOSE")){exit();}

$path = ROOT.'/plugins/editor/'.$nest['editor'];
$extPath = ROOT.'/libs/ext';
?>

<link rel="stylesheet" href="<?=$extPath?>/UploadInterface/UploadInterface.css" />
<link rel="stylesheet" href="<?=$extPath?>/Jcrop/jquery.Jcrop.min.css" />

<input type="hidden" name="addQueue" value="" />
<input type="hidden" name="thumnail_srl" value="<?=$article['thumnail_srl']?>" />
<input type="hidden" name="thumnail_coords" value="<?=$article['thumnail_coords']?>" />
<input type="hidden" name="thumnail_image" value="" />

<fieldset>
	<dl>
		<dt><label for="fileUpload">파일첨부</label></dt>
		<dd>
			<div class="box">
				<input type="file" name="fileUpload" id="fileUpload" multiple />
				<button type="button" id="fileUploadButton">업로드</button>
			</div>
		</dd>
	</dl>
	<div class="queuesManager" id="queuesManager"></div>
</fieldset>

<script>function log(o){console.log(o);}</script>
<script src="<?=$jQueryAddress?>"></script>
<script src="<?=$extPath?>/Jcrop/jquery.Jcrop.min.js"></script>
<script src="<?=$extPath?>/UploadInterface/FilesQueue.class.js"></script>
<script src="<?=$extPath?>/UploadInterface/FileUpload.class.js"></script>
<script src="<?=$extPath?>/UploadInterface/Thumnail.class.js"></script>
<script src="<?=$extPath?>/UploadInterface/UploadInterface.class.js"></script>
<script>
jQuery(function($){
	var uploadInterface = new UploadInterface($('#fileUpload'), {
		form : document.writeForm
		,$queue : $('#queuesManager')
		,uploadAction : '<?=ROOT?>/files/upload/'
		,removeAction : '<?=ROOT?>/files/remove/'
		,fileDir : '<?=ROOT?>/data/original/'
		,auto : false
		,limit : 3
		,thumnailType : '<?=$nest['thumnailType']?>'
		,thumnailSize : '<?=$nest['thumnailSize']?>'
		,$insertTarget : $('#content')
		,insertFunc : null // function(value){}
	});

	var attachFiles = '<?=$pushData?>';
	var attachFilesData = (attachFiles) ? JSON.parse(attachFiles) : null;
	if (attachFilesData)
	{
		uploadInterface.pushQueue(attachFilesData);
	}

	// upload button click event
	$('#fileUploadButton').on('click', function(){
		uploadInterface.upload();
	});

	// onsubmit event
	$(document.writeForm).on('submit', function(){
		if (uploadInterface.thumnailImageCheck())
		{
			return false;
		}
	});
});
</script>



<hr />
<textarea name="content" id="content" rows="10" class="block"><?=$article[content]?></textarea>