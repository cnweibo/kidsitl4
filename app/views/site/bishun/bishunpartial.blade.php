<div class="row">
<div id="bishuncontainer">
@foreach ($bishuns as $bishun)
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<div class="bishunwrapper">
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
					<param name="flashvars" value="filename={{url('/getBishun').'/'.$bishun->filename}}" />
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
							<img src="{{asset('bootstrap/img/get_flash_player.gif')}}" alt="获得 Adobe Flash Player" />
						</a>
					<!--[if !IE]>-->
					</object>
					<!--<![endif]-->
				</object>
	</div>
	</div>
</div>
@endforeach
</div><!-- end bishuncontainer -->
</div>