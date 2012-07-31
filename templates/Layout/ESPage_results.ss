<div class="typography">

    <% if Results %>
<% control Results %>
Your query returned $TotalHits results.
    <ul id="SearchResults">
        <% control Results %>
        <li>
            <% if MenuTitle %>
            <h3><a class="searchResultHeader" href="$Link">$MenuTitle</a></h3>
            <% else %>
            <h3><a class="searchResultHeader" href="$Link">$Title</a></h3>
            <% end_if %>
            <% if Content %>
            $Content.FirstParagraph(html)
            <% end_if %>
            <a class="readMoreLink" href="$Link" title="Read more about &quot;{$Title}&quot;">Read more about &quot;{$Title}&quot;...</a>
        </li>
        <% end_control %>
    </ul>
<% end_control %>

    <% else %>

    <p>Sorry, your search query did not return any results.</p>

    <% end_if %>

    
    <div id="PageNumbers">

        <% if PreviousResults %>
        <a class="prev" href="$PrevLink" title="View the previous page">Previous Page</a>
        <% end_if %>
        | 
        <% if NextResults %>
        <a class="next" href="$NextLink" title="View the next page">Next Page</a>
        <% end_if %>

       

    </div>

</div>
