<?php

$clipid = $interview->clip_id;
if ($interview->kembed == "" && $interview->media_url != "") {
    $height = ($interview->clip_format == 'audio' ? 95 : 279);
    $video_id = str_replace('https://vimeo.com/', '', str_replace('http://vimeo.com/', '', $interview->media_url));
    $embedcode = '<iframe id="vimeo_widget" src="https://player.vimeo.com/video/' . $video_id . '?color=ffffff&badge=0&portrait=false&title=false&byline=false" width="500" height="'.$height.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
} else if ($interview->kembed != "") {
    $embedcode = str_replace('<iframe ', '<iframe id="vimeo_widget"', $interview->kembed);
}

if (isset($_GET['time']) && is_numeric($_GET['time'])) {
    $playScript = 'widget.play();';
    $extraScript = 'widget.setCurrentTime(' . ($_GET['time']) . ');';
} else {
    $playScript = '';
    $extraScript = '';
}

echo <<<VIMEO
<div class="video">
  <p>&nbsp;</p>
  {$embedcode}
  <script src="https://player.vimeo.com/api/player.js"></script>
  <script>
var widget = null;
jQuery(document).ready(function () {
  widget = new Vimeo.Player(document.getElementById('vimeo_widget'));
  widget.on('ready', function(event) {
  {$playScript}
  {$extraScript}
});
});
</script>
</div>
VIMEO;
