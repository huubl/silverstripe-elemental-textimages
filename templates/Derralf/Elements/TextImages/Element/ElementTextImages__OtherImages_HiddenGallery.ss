        <div class="hidden">
            <% loop $Me %>
                <a class="lightbox" href="$Me.Link" data-sub-html="$Legend.ATT" data-exthumbimage="$Me.Fill(96,76).Link">$Me.Link</a>
            <% end_loop %>
        </div>