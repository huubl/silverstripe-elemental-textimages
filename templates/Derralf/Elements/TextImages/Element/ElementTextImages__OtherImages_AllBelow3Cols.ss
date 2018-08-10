<%-- <p><code>AllBelow3Cols</code></p> --%>
	<div class="image-wrap image-wrap-below">
		<div class="row">
			<% loop $Me %>
			<div class="col-xs-4 image-below">
                <a href="$Me.URL" class="lightbox" data-sub-html="$Legend.ATT" data-exthumbimage="$Me.Fill(96,76).Link">
                    <img width="360" height="360" class="img-responsive" src="$Me.FocusFill(360,360).URL" alt="$AltText.ATT" title="$TitleTag.ATT"></a>
                <% if $Me.ShowImageCaptions && $Me.Legend %><div class="image-caption">$Me.Legend.XML</div><% end_if %>
			</div>
			<% end_loop %>
		</div>
	</div>
