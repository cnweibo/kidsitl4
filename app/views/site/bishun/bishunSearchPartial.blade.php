<div class="row">
<div id="bishuncontainerrow">
@if (get_class($bishuns) == "Illuminate\Database\Eloquent\Collection")
	@foreach ($bishuns as $bishun)
	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		<div id="flashContent{{$bishun->id}}" style="text-align:center">
					<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="200" height="220" id="bsShell" align="top">
						<param name="movie" value="utilities/bsShell.swf" />
						<param name="quality" value="high" />
						<param name="bgcolor" value="#ffffff" />
						<param name="play" value="true" />
						<param name="loop" value="true" />
						<param name="wmode" value="window" />
						<param name="scale" value="showall" />
						<param name="menu" value="true" />
						<param name="devicefont" value="false" />
						<param name="salign" value="" />
						<param name="allowScriptAccess" value="sameDomain" />
						<!--[if !IE]>-->
						<object type="application/x-shockwave-flash" data="utilities/bsShell.swf" width="200" height="220">
							<param name="movie" value="bsShell.swf" />
							<param name="quality" value="high" />
							<param name="bgcolor" value="#ffffff" />
							<param name="play" value="true" />
							<param name="loop" value="true" />
							<param name="wmode" value="window" />
							<param name="scale" value="showall" />
							<param name="menu" value="true" />
							<param name="devicefont" value="false" />
							<param name="salign" value="" />
							<param name="flashvars" value="filename={{url('/getBishun').'/'.$bishun->filename}}" />
							<param name="allowScriptAccess" value="sameDomain" />
						<!--<![endif]-->
							<a href="http://www.adobe.com/go/getflash">
								<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="获得 Adobe Flash Player" />
							</a>
						<!--[if !IE]>-->
						</object>
						<!--<![endif]-->
					</object>
		</div>

	</div>	
	@endforeach

@else

@if ($bishuns)
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-lg-offset-4">
	<div id="flashContent{{$bishuns->id}}" style="text-align:center">
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="200" height="220" id="bsShell" align="top">
					<param name="movie" value="utilities/bsShell.swf" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#ffffff" />
					<param name="play" value="true" />
					<param name="loop" value="true" />
					<param name="wmode" value="window" />
					<param name="scale" value="showall" />
					<param name="menu" value="true" />
					<param name="devicefont" value="false" />
					<param name="salign" value="" />
					<param name="allowScriptAccess" value="sameDomain" />
					<!--[if !IE]>-->
					<object type="application/x-shockwave-flash" data="utilities/bsShell.swf" width="200" height="220">
						<param name="movie" value="bsShell.swf" />
						<param name="quality" value="high" />
						<param name="bgcolor" value="#ffffff" />
						<param name="play" value="true" />
						<param name="loop" value="true" />
						<param name="wmode" value="window" />
						<param name="scale" value="showall" />
						<param name="menu" value="true" />
						<param name="devicefont" value="false" />
						<param name="salign" value="" />
						<param name="flashvars" value="filename={{url('/getBishun').'/'.$bishuns->filename}}" />
						<param name="allowScriptAccess" value="sameDomain" />
					<!--<![endif]-->
						<a href="http://www.adobe.com/go/getflash">
							<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="获得 Adobe Flash Player" />
						</a>
					<!--[if !IE]>-->
					</object>
					<!--<![endif]-->
				</object>
	</div>

</div>
@else
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong></strong>                                无搜索结果
</div>
@endif <!-- if it is a bishun sigle  -->
@endif <!-- if it is a collection  -->
</div><!-- end bishuncontainer -->
</div>