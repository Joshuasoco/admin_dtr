<?php
function generateNoResultsHtml($searchQuery) {
    return '
    <tr class = "no-results">
            <td colspan ="6">
            <div class="no_results" style="display: block; text-align: center;">
                No results found for "<span class="search_term">' . htmlspecialchars($searchQuery) . '</span>"
            </div>
            </td>
            </tr>
    <tr class = "no-results">
        <td colspan="6" style="align-items: center;
         text-align:center;
         background-color: white;"
         >
                <img src="/ADMIN_DTR/images/Searchnotfound.png" 
                     alt="No results found" >
        </td>
    </tr>';
}
?>