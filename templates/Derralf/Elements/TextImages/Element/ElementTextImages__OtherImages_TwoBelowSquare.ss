    <%-- <p><code>TwoBelowSquare</code></p> --%>
	<div class="image-wrap image-wrap-below">
		<div class="row">
			<% loop $Me.Limit(2) %>
			<div class="col-xs-6 image-below">
				<a href="$Me.URL" class="lightbox" data-sub-html="$Legend.ATT" data-exthumbimage="$Me.Fill(96,76).Link">
                    <img width="555" height="550" class="img-responsive" src="$Me.FocusFill(555,550).URL" alt="$AltText.ATT" title="$TitleTag.ATT">
                </a>
                <% if $Me.ShowImageCaptions && $Me.Legend %><div class="image-caption">$Me.Legend.XML</div><% end_if %>
			</div>
			<% end_loop %>
		</div>
	</div>
