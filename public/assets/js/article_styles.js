CKEDITOR.stylesSet.add( 'my_style', [
    /* Block Styles */

    // These styles are already available in the "Format" combo ("format" plugin),
    // so they are not needed here by default. You may enable them to avoid
    // placing the "Format" combo in the toolbar, maintaining the same features.
    /*
     { name: 'Paragraph',		element: 'p' },
     { name: 'Heading 1',		element: 'h1' },
     { name: 'Heading 2',		element: 'h2' },
     { name: 'Heading 3',		element: 'h3' },
     { name: 'Heading 4',		element: 'h4' },
     { name: 'Heading 5',		element: 'h5' },
     { name: 'Heading 6',		element: 'h6' },
     { name: 'Preformatted Text',element: 'pre' },
     { name: 'Address',			element: 'address' },
     */

    { name: 'Italic aaa Title',		element: 'h2', styles: { 'font-style': 'italic' } },
    { name: 'Subtitle',			element: 'h3', styles: { 'color': '#aaa', 'font-style': 'italic' } },
    {
        name: 'Special Container',
        element: 'div',
        styles: {
            padding: '5px 10px',
            background: '#eee',
            border: '1px solid #ccc'
        }
    },{
        name: 'Article Main Image',
        element: 'img',
        styles: {
            display: 'block',
            width: '100%',
            'max-width': '100%',
            'height': 'auto',
            'margin-bottom': '20px',
        }
    },{
        name: 'Article Image Left',
        element: 'img',
        styles: {
            'margin-bottom': '10px',
            'margin-left': '20px',
            'float': 'left',
        }
    },{
        name: 'Article Image Right',
        element: 'img',
        styles: {
            'margin-bottom': '10px',
            'margin-right': '20px',
            'float': 'right',
        }
    },{
        name: 'Article Image Center',
        element: 'img',
        styles: {
            'margin': 'auto',
            'margin-bottom': '10px',
            'display': 'block',
        }
    }, {
        name: 'Article Alert',
        element: 'span',
        styles: {
            'padding': '15px',
            'margin-bottom': '25px',
            'border': '1px solid #ebccd1',
            'background': '#f2dede',
            'color': '#a94442',
        }
    }, {
        name: 'Article Success',
        element: 'span',
        styles: {
            'padding': '15px',
            'margin-bottom': '25px',
            'border': '1px solid #d6e9c6',
            'background': '#dff0d8',
            'color': '#cf39',
        }
    }, {
        name: 'Blockquote',
        element: 'span',
        styles: {
            'padding': '12.5px 25px',
            'margin': '0 0 25px',
            'border-left': '17.5px',
            'font-size': '#dff0d8'
        }
    }
]);