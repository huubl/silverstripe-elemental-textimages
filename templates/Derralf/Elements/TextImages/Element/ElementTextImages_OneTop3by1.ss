    <% if $ShowTitle %>
        <% include Derralf\\Elements\\TextImages\\Title %>
    <% end_if %>

    <% if $SortedImages %>
        <div class="image-wrap image-wrap-top">
            <% with $SortedImages.First %>
                    <a href="$Me.URL" class="lightbox" data-sub-html="$Legend.ATT" data-exthumbimage="$Me.Fill(96,76).Link">
                        <img class="img-responsive forced"
                             src="$Me.FocusFill(1140,380).Link"
                             srcset="$Me.FocusFill(290,96).Link 290w,
                                     $Me.FocusFill(360,120).Link 360w,
                                     $Me.FocusFill(450,150).Link 450w,
                                     $Me.FocusFill(720,240).Link 720w,
                                     $Me.FocusFill(940,313).Link 940w,
                                     $Me.FocusFill(1140,380).Link 1140w"
                             sizes="(min-with: 1200px) 1140px,
                                    (min-with: 992px) 940px,
                                    (min-with: 768px) 720px,
                                    calc(100vw - 30px)"
                             alt="$Me.AltText.ATT"
                             title="$Me.TitleTag.ATT">
                        <% if $Top.OtherImages && $Top.ImageViewMode == HiddenGallery %>
                            <div class="more-images btn btn-primary btn-sm"><i class="fa fa-camera" aria-hidden="true"></i> +{$Top.OtherImages.Count}</div>
                        <% end_if %>
                    </a>
            <% end_with %>
        </div>
    <% end_if %>


    <% if $HTML %>
        <div class="element__content">$HTML</div>
    <% end_if %>

    <% if $ReadMoreLink.LinkURL %>
        <div class="element__readmorelink"><p><a href="$ReadMoreLink.LinkURL" class="{$ReadmoreLinkClass}" {$ReadMoreLink.TargetAttr} ><% if $ReadMoreLink.Title %>$ReadMoreLink.Title<% else %> mehr<% end_if %></a></p></div>
    <% end_if %>

$OtherImagesLayout(1)
