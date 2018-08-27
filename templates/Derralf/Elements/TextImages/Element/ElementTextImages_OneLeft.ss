
<% if $SortedImages %>
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-push-4">
            <% if $ShowTitle %>
                <% include Derralf\\Elements\\TextImages\\Title %>
            <% end_if %>

            <% if $HTML %>
                <div class="element__content">$HTML</div>
            <% end_if %>

            <% if $ReadMoreLink.LinkURL %>
                <div class="element__readmorelink"><p><a href="$ReadMoreLink.LinkURL" class="{$ReadmoreLinkClass}" {$ReadMoreLink.TargetAttr} ><% if $ReadMoreLink.Title %>$ReadMoreLink.Title<% else %> mehr<% end_if %></a></p></div>
            <% end_if %>
        </div>
        <div class="col-xs-12 col-sm-4 col-sm-pull-8 image-wrap image-wrap-left">
            <% with $SortedImages.First %>
                <div class="image-aside">
                    <a href="$Me.URL" class="lightbox" data-sub-html="$Legend.ATT" data-exthumbimage="$Me.Fill(96,76).Link">
                        <img class="img-responsive forced"
                             src="$Me.ScaleWidth(722).Link"
                             srcset="$Me.ScaleWidth(220).Link 220w,
                                 $Me.ScaleWidth(294).Link 294w,
                                 $Me.ScaleWidth(360).Link 360w,
                                 $Me.ScaleWidth(720).Link 720w"
                             sizes="(min-with: 1200px) 360px,
                                (min-with: 992px) 294px,
                                (min-with: 768px) 220px,
                                calc(100vw - 30px)"
                             alt="$Me.AltText.ATT"
                             title="$Me.TitleTag.ATT">
                        <% if $Top.OtherImages && $Top.ImageViewMode == HiddenGallery %>
                            <div class="more-images btn btn-primary btn-sm"><i class="fa fa-camera" aria-hidden="true"></i> +{$Top.OtherImages.Count}</div>
                        <% end_if %>
                    </a>
                    <% if $Top.ShowImageCaptions && $Me.Legend %><div class="image-caption">$Me.Legend.XML</div><% end_if %>
                </div>
            <% end_with %>
        </div>
    </div>
<% else %>
    <% if $ShowTitle %>
        <% include Derralf\\Elements\\ElementTitleStyled %>
    <% end_if %>

    <% if $HTML %>
        <div class="element__content">$HTML</div>
    <% end_if %>

    <% if $ReadMoreLink.LinkURL %>
        <div class="element__readmorelink"><p><a href="$ReadMoreLink.LinkURL" class="{$ReadmoreLinkClass}" {$ReadMoreLink.TargetAttr} ><% if $ReadMoreLink.Title %>$ReadMoreLink.Title<% else %> mehr<% end_if %></a></p></div>
    <% end_if %>
<% end_if %>

$OtherImagesLayout(1)
