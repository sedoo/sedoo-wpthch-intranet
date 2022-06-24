/***
 * global JS 
 * 
 */
'use strict';

/**
 * replace url fb2.sedoo.fr by api.sedoo.fr 
 */
// const regex = /https:\/\/fb2.sedoo.fr\/files\//ig;
// console.log(p.replaceAll(regex, 'https://api.sedoo.fr/intranet-omp-service-rest/data/v1_0/getfile?product=intranet-filetree&campaign=intranetomp&file='));

jQuery(document).ready(function ($) {
    'use strict';
    $('a[href^="https://fb2.sedoo.fr/files/"]').each(function(){ 
        var oldUrl = $(this).attr("href"); // Get current url
        var newUrl = oldUrl.replace("https://fb2.sedoo.fr/files/", "https://api.sedoo.fr/intranet-omp-service-rest/data/v1_0/getfile?product=intranet-filetree&campaign=intranetomp&file="); // Create new url
        $(this).attr("href", newUrl); // Set herf value
    });
});