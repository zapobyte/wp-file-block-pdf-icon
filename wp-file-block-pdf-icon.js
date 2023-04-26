/**
 * Plugin Name: WP-File-Block-Pdf-Icon
 * Description: A custom WordPress plugin that adds a PDF icon to the `Download` button for native `File Blocks` in Wordpress.
 * Version: 0.0.1
 * Plugin URI: https://github.com/zapobyte/wp-file-block-pdf-icon
 * Author: Victor
 * Author URI: https://github.com/zapobyte
 * 
 */

const PDF_ICON = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V304H176c-35.3 0-64 28.7-64 64V512H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM176 352h32c30.9 0 56 25.1 56 56s-25.1 56-56 56H192v32c0 8.8-7.2 16-16 16s-16-7.2-16-16V448 368c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24H192v48h16zm96-80h32c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H304c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H320v96h16zm80-112c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v32h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V432 368z"/></svg>';

function addIconToDownloadElement( class_name ) {

    if(class_name !== ''){
        const body = document.body;
        const classSearch = body.querySelector(`.${class_name}`);
        const isLinkPdf = classSearch?.href.includes('.pdf');
        if(classSearch && isLinkPdf) {
            classSearch.style.display = 'inline-flex';
            classSearch.style.alignItems = 'center';

            const icon = document.createElement('div');
            icon.style.width = '24px';
            icon.style.display = 'inline-flex';
            icon.style.marginRight = '5px'
            icon.innerHTML = PDF_ICON; 

            classSearch.prepend(icon);
        }
    }
}

window.addEventListener("DOMContentLoaded", (event) => {
    let class_name = ''; // Set the default class names
    if ( typeof MyClassCheckerSettings !== 'undefined' ) {
        class_name = MyClassCheckerSettings.class_name;
    }
    addIconToDownloadElement( class_name )
});