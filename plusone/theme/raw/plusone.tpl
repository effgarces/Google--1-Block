{if $page == 'edit'}
<div id="plusone" class="{$align}">
	<div class="description">{str tag=previewonly section=blocktype.plusone}</div>
	<img src="{$WWWROOT}blocktype/plusone/theme/raw/static/images/preview.png">
</div>
{else}
<div id="plusone" class="{$align}">
	<g:plusone size="{$size}" count="{$counter}"></g:plusone>
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"> 
	{literal}{lang: '{/literal}{$lang}{literal}'}{/literal}
	</script>
</div>
{/if}