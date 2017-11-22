<% if $MoreThanOnePage %>
    <nav id="pagination" aria-label="Pagination navigation" class="mx-auto mt-3">
        <ul class="pagination justify-content-center">
            <% if $NotFirstPage %>
                <li class="page-item">
                    <a class="page-link" href="$PrevLink" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            <% end_if %>

            <% loop $Pages %>
                <li class="page-item <% if $CurrentBool %>active<% end_if %>">
                    <a class="page-link" href="$Link">$PageNum</a>
                </li>
            <% end_loop %>

            <% if $NotLastPage %>
                <li class="page-item">
                    <a class="page-link" href="$NextLink" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            <% end_if %>
        </ul>
    </nav>
<% end_if %>
