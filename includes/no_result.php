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
    <tr class="no-results">
        <td colspan="6" style="text-align: center;">
            <div class="img_no_result" style="display: block; text-align: center;">
                <img src="/ADMIN_DTR/images/Searchnotfound.png" 
                     alt="No results found" 
                     style="width: 30%; 
                            height: 30%; 
                            margin: 30px auto; 
                            display: block;">
            </div>
        </td>
    </tr>';
}
?>